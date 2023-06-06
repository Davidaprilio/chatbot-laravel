<?php

namespace App\Http\Controllers;

use App\Helpers\Whatsapp;
use App\Models\Customer;
use App\Models\Device;
use App\Models\QaDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookBotController extends Controller
{
    // callback
    public function callback(Request $request)
    {
        if ($request->fromMe) return true;
        try {
            $device = Device::where('token', $request->token)->first();
            $phone = $request->phone;
            $message = $request->message;
            $name = $request->name;
            if (!$device) return false; // skip device not found        
            if (strpos($phone, '@g.us') > 0) return false; // skip group
            // hapus semua aq_last_at jika lebih dari 1 jam
            $last = Carbon::now()->subHour(1);
            Customer::where('qa_last_at', '<', $last)->update([
                'qa_last_at' => null,
                'qa_detail_id' => null,
                'parent_id' => null,
            ]);

            // cek customer
            $customer = Customer::firstOrCreate([
                'phone' => $phone,
            ], [
                'pushname' => $name,
                'more_data' => []
            ]);

            if ($customer->pushname != $name) {
                $customer->pushname = $name;
                $customer->save();
            }
            if (strtolower($message) == 'hapus') {
                // delete customer
                $customer->delete();
                return false;
            }
            if (strtolower($message) == 'selesai') {
                // reset customer
                $customer->qa_detail_id = null;
                $customer->qa_last_at = null;
                $customer->validasi = null;
                $customer->save();
                Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => 'Terima kasih telah menggunakan layanan kami.']);
                return false;
            }
            // $qa_detail_id = $customer->qa_detail_id ?? null;
            // $qa = QaDetail::where('id', $qa_detail_id)->first() ?? QaDetail::first();
            // if (!$qa) return false;
            // $kontak = (array)$customer;
            // $kontak['name'] = $customer->name; // ?? $customer->pushname;
            // $this->SendMessage($qa, $customer, $device, $phone, $qa_detail_id, $message);

            $this->SentBot($device, $customer, $message);
        } catch (\Throwable $th) {
            Log::info('Error :', [$th->getMessage()]);
        }
    }


    protected function SendMessage($qa, $customer, $device, $phone, $qa_detail_id = null, $message_masuk)
    {
        Log::info('QA : ' . $phone . '=' . $qa_detail_id);
        $kontak = (array)$customer;
        $kontak['nama'] = $customer->name;
        if (!$customer->qa_detail_id) {
            $message = Whatsapp::ReplaceArray($kontak, $qa->text);
            $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
        }
        $validasi = $customer->validasi ?? false;
        if ($validasi) {
            $customer[$customer->validasi] = $message_masuk;
            $customer->validasi = null;
            $customer->qa_detail_id = $qa->id;
            $customer->qa_last_at = now();
            $customer->save();
            $qa = QaDetail::where('id', '>', $qa->id)->whereNull('parent_id')->first();
            $this->SendMessage($qa, $customer, $device, $phone, $qa_detail_id, $message_masuk);
            return false;
        } else {
            $customer->validasi = $qa->validasi ?? null;
            $customer->qa_detail_id = $qa->id;
            $customer->qa_last_at = now();
            $customer->save();
        }
        if ($customer->qa_parent_id) {
            // $customer->qa_parent_id = null;
            // $customer->save();
            $qa = QaDetail::where('parent_id', $customer->qa_parent_id)->where('key', $message_masuk)->first();
            if (!$qa) {
                Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => 'Maaf, jawaban anda tidak sesuai dengan pertanyaan sebelumnya. Mohon jawab dengan benar.']);
                return false;
            }
            if ($qa->type == 'selesai') {
                $customer->qa_parent_id = null;
                $customer->qa_detail_id = null;
                $customer->qa_last_at = null;
                $customer->save();
                Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => 'Terima kasih telah menggunakan layanan kami.']);
                return false;
            }
            $child = $qa->has_children ?? false;
            if ($child) {
                Log::info('Punya anak :', [$child]);
                $qa_child = QaDetail::where('parent_id', $qa->id)->get();
                if (!$qa_child) {
                    $qa_child = QaDetail::where('parent_id', $customer->qa_parent_id)->get();
                }
                $message = $qa->description . "\n";
                foreach ($qa_child as $value) {
                    $message .= $value->key . '. ' . $value->text . "\n";
                }
                $message = Whatsapp::ReplaceArray($kontak, $message);
                $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
                $customer->qa_parent_id = $qa->id;
                $customer->save();
                Log::info('Kirim WA', [$kirim]);
                $message_masuk = null;
                return false;
            } else {
                $message = Whatsapp::ReplaceArray($kontak, $qa->description);
                Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
                Log::info('Menu pilihan :', [$message_masuk]);
                return false;
            }
        }
        $child = $qa->has_children ?? false;
        if ($child) {
            Log::info('Punya anak :', [$child]);
            $qa_child = QaDetail::where('parent_id', $qa->id)->get();
            $message = $qa->description . "\n";
            foreach ($qa_child as $value) {
                $message .= $value->key . '. ' . $value->text . "\n";
            }
            $message = Whatsapp::ReplaceArray($kontak, $message);
            $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
            $customer->qa_parent_id = $qa->id;
            $customer->save();
            Log::info('Kirim WA', [$kirim]);
            $message_masuk = null;
        } else {
            if ($qa->validasi) {
                if (!$customer[$qa->validasi]) {
                    Log::info('Validasi Ada :', [$qa->validasi]);
                    $message = Whatsapp::ReplaceArray($kontak, $qa->description ?? $qa->validasi_qa);
                    $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
                    Log::info('Kirim WA', [$kirim]);
                    $message_masuk = null;
                    return false;
                } else {
                    // $qa = QaDetail::where('id', '>', $customer->qa_detail_id)->whereNull('parent_id')->first();            
                    Log::info('Validasi Ada :', [$qa->validasi]);
                    $message = Whatsapp::ReplaceArray($kontak, $qa->text);
                    $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
                    Log::info('Kirim WA', [$kirim]);
                    $message_masuk = null;
                    return false;
                }
            }
            $qa = QaDetail::where('id', '>', $customer->qa_detail_id)->whereNull('parent_id')->first();
            Log::info('QA', [$qa]);
            if (!$qa) return false;
            $this->SendMessage($qa, $customer, $device, $phone, $qa_detail_id, $message_masuk);
            $message_masuk = null;
        }
    }

    protected function SentBot($device, $customer, $msg)
    {
        // haput qa_last_at jika lebih dari 1 jam
        if ($customer->qa_last_at) {
            $last = $customer->qa_last_at;
            $now = now();
            $diff = Carbon::parse($last)->diffInMinutes($now);
            if ($diff > 60) {
                $customer->qa_last_at = null;
                $customer->qa_detail_id = null;
                $customer->qa_parent_id = null;
                $customer->save();
            }
        }
        $this->FirstBot($device, $customer, $msg);
    }

    protected function FirstBot($device, $customer, $msg)
    {
        $kontak = (array)$customer;
        $kontak['nama'] = $customer->name;
        if (!$customer->qa_detail_id) {
            $qa = QaDetail::first();
            $kirim = $this->ProsesBot($qa, $customer, $device, $customer['phone']);
            Log::info('Kirim WA', [$kirim]);
            $customer->qa_detail_id = $qa->id;
            $customer->qa_last_at = now();
            $customer->save();
            if (!$qa->validasi) {
                $this->NextBot($device, $customer, $msg);
            }
        } else {
            $this->NextBot($device, $customer, $msg);
        }
    }
    protected function NextBot($device, $customer, $msg)
    {
        $kontak = (array)$customer;
        $kontak['nama'] = $customer->name;
        if ($customer->qa_detail_id) {
            $cek_parent = QaDetail::where('parent_id', $customer->qa_detail_id)->first();
            Log::info('Cek Parent :', [$cek_parent]);
            if ($cek_parent) {
                $qa = QaDetail::where('parent_id', $customer->qa_detail_id)->where('key', $msg)->first();
                if (!$qa) {
                    Whatsapp::send(['token' => $device->token, 'phone' => $customer['phone'], 'message' => 'Maaf, jawaban anda tidak sesuai dengan pertanyaan sebelumnya. Mohon jawab dengan benar.']);
                    return false;
                }
                if ($qa->type == 'selesai') {
                    $customer->qa_parent_id = null;
                    $customer->qa_detail_id = null;
                    $customer->qa_last_at = null;
                    $customer->save();
                    Whatsapp::send(['token' => $device->token, 'phone' => $customer['phone'], 'message' => 'Terima kasih telah menggunakan layanan kami.']);
                    return false;
                }
                $this->ProsesBot($qa, $customer, $device, $customer['phone']);
            }
        } else {
            $qa = QaDetail::where('id', '>', $customer->qa_detail_id)->whereNull('parent_id')->first();
            if (!$qa) return false;
            $kirim = $this->ProsesBot($qa, $customer, $device, $customer['phone']);
            Log::info('Kirim WA', [$kirim]);
            $customer->qa_detail_id = $qa->id;
            $customer->qa_last_at = now();
            $customer->save();
            if (!$qa->validasi) {
                $this->NextBot($device, $customer, $msg);
            } else {
                if ($customer[$qa->validasi]) {
                    $this->NextBot($device, $customer, $msg);
                }
            }
            return false;
        }
    }

    protected function ProsesBot($qa, $customer, $device, $phone)
    {
        $child = $qa->has_children ?? false;
        $kontak['nama'] = $customer->name;
        if ($child) {
            $qa_child = QaDetail::where('parent_id', $qa->id)->get();
            $message = $qa->description . "\n";
            foreach ($qa_child as $value) {
                $message .= $value->key . '. ' . $value->text . "\n";
            }
            $message = Whatsapp::ReplaceArray($kontak, $message);
            $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $phone, 'message' => $message]);
        } else {
            $message = Whatsapp::ReplaceArray($kontak, $qa->text);
            $kirim = Whatsapp::send(['token' => $device->token, 'phone' => $customer['phone'], 'message' => $message]);
        }
        return $kirim;
    }
}
