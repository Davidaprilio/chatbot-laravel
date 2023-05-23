<?php

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
