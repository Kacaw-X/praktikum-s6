<?php

function truncate_text($text, $limit = 100)
{
    if (strlen($text) <= $limit) {
        return $text;
    }
    return substr($text, 0, $limit) . '...';
}