<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Sandbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sandbox';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sandbox for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sandbox for testing');

        $formates = [
            '**baik kak**nanti aja**',
        ];

        $answer = "baik kak david nanti aa saya coba lagi ya kak";

        // step 1: cheking word match
        $format_mod1 = Str::of($formates[0])->replace('**', '(.*)')
                    ->__toString();

        $str = Str::of($answer)->isMatch("/{$format_mod1}/i");

        dd($str);

        // dd(Str::startsWith('custome.name', 'customer.'));

        // siapa nama kamu?
        $answer = "danu aja";

        $formats = [
            "{name:*} *{50:aja}* **",
            // '*{10:saja}* {name:*}',
            // 'panggil {value} saja **',
            // "** panggil {value} {_:saja|aja|ajah} **",
            // "** *{40:boleh nama}* saya {nama:*} **",
            // "** nama saya {nama:*} **",
            // "** saya {_:adalah|} {nama:*} **",
            // "saya {_:adalah|} {nama:*} **",
            // "{value} {_:aja|saja} kak **",
            // "boleh {value} {_:aja|saja} kak **",
            // "{value}",
        ];

        foreach ($formats as $format) {
            // $this->info($format);
            $ans = getVariableOnText($answer, $format);
            if (is_array($ans) && count($ans) > 0) {
                dd($ans);
            }
        }
        dd('not found', false);
        exit;


        dd(
            $this->getVariableOnText(
                'jangan dong kak, panggil david ajah kak ya', 
                "** panggil {value} {_:saja|aja|ajah} **",
            ),

            $this->getVariableOnText(
                'panggil heri saja kak sdfdsf', 
                "panggil {value} saja **",
            ),

            $this->getVariableOnText(
                'danu saja', 
                "{value} saja **",
            ),

            $this->getVariableOnText(
                'Hello all, my name is david and I am 20 years old.',
                "Hello *{50:all my name}* is {name:*} ** am {age:19|20|21} years **"
            ),

            $this->getVariableOnText(
                'Hello all, my name is david and I am 20 years old.',
                "Hello *{50:all my name}* is {name:*} ** am {age:19|20|21} years **"
            ),

            $this->getVariableOnText(
                'Iya kak boleh nama saya david dan saya 20 tahun.',
                "** *{40:boleh nama}* saya {nama:*} dan saya {umur:20|21|22} tahun.",
            ),
            $this->getVariableOnText(
                'Lha buat apa kan nama saya rahasia.',
                "** *{40:boleh nama}* saya {nama:*} dan saya {umur:20|21|22} tahun.",
            ),
        );
    }


    public function getVariableOnText(string $text, string $format): array|false
    {
        return getVariableOnText($text, $format);
        $text = strtolower($text);
        // remove all special characters
        // $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        $tokenized_text = explode(' ', $text);

        // getting the specific word
        $format = strtolower($format); // %1 is value of $name

        // explode space but not in {}
        $tokenized_format = preg_split('/\s+(?![^{}]*})/', $format);

        $values = [];

        $similiar_trying = 0;
        $similiar_txt_assamble = '';
        // note: array_shift($tokenized_format); to skip the next format token
        foreach ($tokenized_text as $wrd) {
            $current_fmt = $tokenized_format[0];
            
            if ($wrd === $current_fmt) { // word same
                array_shift($tokenized_format);
                continue;
            } 
            
            if ('*{' === substr($current_fmt, 0, 2) && '}*' === substr($current_fmt, -2)) {
                // getting expected text 
                if ($similiar_txt_assamble != '') {
                    $similiar_txt_assamble .= ' ';
                }
                $similiar_txt_assamble .= $wrd;

                $current_fmt = substr($current_fmt, 2, -2);
                [$minPercentExpected, $word_input] = explode(':', $current_fmt);
                $minPercentExpected = (int) $minPercentExpected;

                similar_text($similiar_txt_assamble, $word_input, $percent);

                $this->info("- w1: $similiar_txt_assamble");
                $this->info("- w2: $word_input");
                $this->info("- percent: $percent");
                if ($percent < $minPercentExpected) {
                    if (++$similiar_trying < count(explode(' ', $word_input))) {
                        continue;
                    }
                    $this->error("Not similar enough minimum");
                    return false;
                }

                array_shift($tokenized_format);
                continue;
            }

            if ('**' === $current_fmt) {
                array_shift($tokenized_format);
                continue;
            }

            // getting the variable value from the format
            if ('{' === $current_fmt[0] && '}' === $current_fmt[strlen($current_fmt) - 1]) {
                $current_fmt = substr($current_fmt, 1, -1);
                [$key, $value] = explode(':', $current_fmt);

                // jika key:*
                if ($value === '*') {
                    $value = $wrd;
                } else {
                    // jika key:iya|tidak
                    $value = explode('|', $value);
                    
                    if (!in_array($wrd, $value)) {
                        $this->error('Invalid value');
                        return false;
                    }

                    // save the value
                    $value = $value[array_search($wrd, $value)];
                }


                $values[$key] = $value;

                array_shift($tokenized_format);
                continue;
            }            
        }

        return $values;
    }
}
