<?php

use Illuminate\Support\Facades\Log;

function parseText(string $text)
{
    $texts = explode('||', $text);
    foreach ($texts as $key => $text) {
        $texts[$key] = trim($text);
    }
    return implode("\n", $texts);
}

/**
 * @return string Rp 1.000
 */
function Rp($num)
{
    return "Rp. " . dotNum($num, 0, ',', '.');
}

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

function RandomString($length = 5)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function upperCase($text)
{
    $word = ucwords(str_replace('_', ' ', $text));
    return $word;
}


function getVariableOnText(string $text, string $format): array|false
{
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
    Log::info("tokenized_text: ", $tokenized_text);
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

            Log::info("- w1: $similiar_txt_assamble");
            Log::info("- w2: $word_input");
            Log::info("- percent: $percent");
            if ($percent < $minPercentExpected) {
                if (++$similiar_trying < count(explode(' ', $word_input))) {
                    continue;
                }
                Log::error("Not similar enough minimum");
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
            try {
                [$key, $value] = explode(':', $current_fmt);
            } catch (\Throwable $th) {
                Log::error('Invalid format', ['format' => $current_fmt, $th->getMessage(), $th->getCode()]);
                /// jika error undefined index 1, error code
                if($th->getMessage() === "Undefined array key 1") {
                    $key = 'value';
                    $value = '*';
                }
            }

            // jika key:*
            if ($value === '*') {
                Log::info('Value is * '. $wrd, [$current_fmt]);
                $value = $wrd;
            } else {
                // jika key:iya|tidak
                $value = explode('|', $value);

                if (!in_array($wrd, $value)) {
                    Log::error('Invalid value');
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
