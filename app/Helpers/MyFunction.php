<?php

use App\Models\ListAddon;
use App\Models\ListUserEcourse;
use App\Models\RequestAddon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

/**
 * Mengembalikan phone number yang sudah diformat
 */
function format_phone(?string $phone, string $prefix = '62'): ?string
{
    // Jika phone adalah JID
    if (str_contains($phone, '@g')) return $phone;

    $phone = preg_replace('/[^0-9]/', '', $phone); // get numeric chars
    if ($phone === '') return null;

    if (substr($phone, 0, 1) == '0') {
        $phone = $prefix . substr($phone, 1);
    }
    return $phone;
}

function SpinText($text)
{
    return preg_replace_callback('/{(.*?)}/', function ($match) {
        $words = explode('|', $match[1]);

        return $words[array_rand($words)];
    }, $text);
}

function  ReplaceArray($array, $string)
{
    $pjg = substr_count($string, "[");
    for ($i = 0; $i < $pjg; $i++) {
        $col1 = strpos($string, "[");
        $col2 = strpos($string, "]");
        $find = strtolower(substr($string, $col1 + 1, $col2 - $col1 - 1));
        $relp = substr($string, $col1, $col2 - $col1 + 1);
        if (isset($array[$find])) {
            $string = str_replace($relp, $array[$find], $string);     //asli       
        } else {
            $string = str_replace('[' . $find . ']', '', $string);
        }
    }
    // return $string;
    return SpinText(salam($string));
}

function availLocale()
{
    return [
        'en' => 'en',
        'id' => 'id'
    ];
}

function dotNum($num): string
{
    if (is_numeric($num)) {
        return number_format($num, 0, ',', '.');
    }
    return '-';
}

/**
 * @return string Rp 1.000
 */
function Rp($num)
{
    return "Rp. " . dotNum($num, 0, ',', '.');
}

function upperCase($text)
{
    $word = ucwords(str_replace('_', ' ', $text));
    return $word;
}

/**
 * Make a directory recursively
 * 
 * @param string $path location of new folder
 * @param string $permsions permission of new folder
 */
function mkdir_R(String $path, $permsions = 0755): void
{
    if (!file_exists($path)) {
        $old_umask = umask(0);
        mkdir($path, $permsions, true);
        umask($old_umask);
    }
}


function storage_url($storage_file)
{
    return url(Storage::url($storage_file));
}

function saldoUser($id)
{
    $user       = User::where('id', $id)->first();
    if ($user->saldo != null) {
        $decrypt    = Crypt::decrypt($user->saldo);
        return $decrypt;
    } else {
        return 0;
    }
}

function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return "<b>" . $hari_ini . "</b>";
}

function salam($text)
{
    $b = Carbon\Carbon::now()->format('H');
    $hour = (int) $b;
    $hasil = "";
    if ($hour >= 0 && $hour < 10) {
        $hasil = "Pagi";
    } elseif ($hour >= 10 && $hour < 15) {
        $hasil = "Siang";
    } elseif ($hour >= 15 && $hour <= 17) {
        $hasil = "Sore";
    } else {
        $hasil = "Malam";
    }

    $text = str_replace(['Pagi', 'Siang', 'Sore', 'Malam'], $hasil, $text);
    return $text;
}


function addZero($number, int $length = 3)
{
    return str_pad($number, $length, '0', STR_PAD_LEFT);
}

function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
{

    // mengambil nilai kode ex: KNS0015 hasil KNS
    $kode = substr($id_terakhir, 0, $panjang_kode);

    // mengambil nilai angka
    // ex: KNS0015 hasilnya 0015
    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);

    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);

    // menggabungkan kode dengan nilang angka baru
    $id_baru = $kode . $angka_baru;

    return $id_baru;
}

function permissionOfAccess(string $access_name): array
{
    $data = collect(config('access_permission.permissions'));
    $data = $data->pluck($access_name)->filter(fn ($value, $key) => gettype($value) == 'array');
    return array_merge(...$data->toArray());
}


function getDescriptionFromPermission(string $permission_name): ?string
{
    $permsions = [];
    foreach (listAccess() as $name) {
        $permsions = array_merge($permsions, permissionOfAccess($name));
        if (($permsions[$permission_name] ?? null)) {
            return $permsions[$permission_name];
        }
    }
    return null;
}


function listAccess(): array
{
    $permissions_list = collect(config('access_permission.permissions'));
    $roles = $permissions_list->map(fn ($value, $key) => array_keys($value))->toArray();
    return array_unique(array_merge(...$roles));
}

function access(...$access_name): array
{
    $permsions = [];
    foreach ($access_name as $name) {
        $permsions = array_merge($permsions, array_keys(permissionOfAccess($name)));
    }
    return $permsions;
}

function listPermission(): array
{
    return access(...listAccess());
}

function getRolesName()
{
    return array_keys(getRoles());
}

function getRoles($role_name = null): array
{
    $roles = config('access_permission.roles');
    if ($role_name) {
        return $roles[$role_name];
    }
    return $roles;
}

function ifAbort(bool $condition, int $code = 403, string $message = '', array $headers = [])
{
    if ($condition) {
        return abort($code, $message, $headers);
    }
}

function s3_path(string $url): string
{
    return explode(env('AWS_BUCKET'), $url)[1] ?? '';
}

function roleMaster()
{
    return config('access_permission.role_master');
}

function font_path($path): string
{
    $path = ltrim($path, '/');
    return public_path("assets/fonts/{$path}");
}

function kmToMil(int $km): float
{
    return $km * 0.6213689;
}

/**
 * Standart untuk membuat nama role dengan scope web
 */
function formatRoleWeb(string $role_name): string
{
    return "{$role_name}-" . web()->route;
}

/**
 * Mendapatkan nama column di tabel users yang sesuai 
 * dengan web yang sedang aktif
 */
function getColumnNameHost(): string
{
    // NOTE:  kalo error penulisan domain salah
    $host = request()->host();
    $column_hosts = [
        'terminal_umroh' => 'terminalumroh.com',
        'qblat' => 'qblat.com',
    ];
    return array_search($host, $column_hosts);
}

function web()
{
    return app('currentWeb');
}

function html_view($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function makeSlugPaket(string $nama_paket, string $kode_cloning_paket): string
{
    return str_replace(' ', '-', preg_replace("/[^A-Za-z0-9.!?[:space:]]/", '', $nama_paket)) . "-{$kode_cloning_paket}";
}

function makeSlug(string $nama_travel): string
{
    return str_replace(' ', '-', preg_replace("/[^A-Za-z0-9.!?[:space:]]/", '', $nama_travel));
}


function blockOpenRedirect($url)
{
    $domain = parse_url($url, PHP_URL_HOST);
    $whitelist = [
        'terminalumroh.com',
        'qblat.com',
        'localhost',
    ];
    if (!in_array($domain, $whitelist)) {
        return abort(403, 'Redirect to external domain is not allowed');
    }
}

function hitungPersen($nilai, $total)
{
    if ($total <= 0) return null;
    return (int) ($nilai / $total) * 100;
}

function valOfPercent($persen, $nilai)
{
    return (int) round(($persen / 100) * $nilai);
}


if (!function_exists('str')) {
    function str()
    {
        return new \Illuminate\Support\Str();
    }
}

function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}


function getTextWidth($text, $font, $font_size)
{
    try {
        $drawing_text = iconv('UTF-8', 'UTF-8', $text);
        $characters    = array();
        for ($i = 0; $i < strlen($drawing_text); $i++) {
            $characters[] = ord($drawing_text[$i]);
        }
        $glyphs        = $font->glyphNumbersForCharacters($characters);
        $widths        = $font->widthsForGlyphs($glyphs);
        $text_width   = (array_sum($widths) / $font->getUnitsPerEm()) * $font_size;
        return $text_width;
    } catch (\Exception $e) {
        return $e;
    }
}

function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count - 1)];
    }
    return $str;
}

function get_initial_of_name(string $name)
{
    $name = explode(' ', $name, 2);
    $initial = '';
    foreach ($name as $value) {
        $initial .= $value[0];
    }
    return ucwords($initial);
}
