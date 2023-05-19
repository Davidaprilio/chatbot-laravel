<?php 

function parseText(string $text)
{
    $texts = explode('||', $text);
    foreach ($texts as $key => $text) {
        $texts[$key] = trim($text);
    }
    return implode("\n", $texts);
}