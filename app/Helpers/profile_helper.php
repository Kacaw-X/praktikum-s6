<?php

function inisial_nama($namaLengkap)
{
    $kata = explode(' ', trim($namaLengkap));
    $inisial = '';

    foreach ($kata as $k) {
        $inisial .= strtoupper(substr($k, 0, 1));
    }

    return $inisial;
}

function avatar_url($nama)
{
    $namaEncode = urlencode($nama);
    return "https://ui-avatars.com/api/?name={$namaEncode}&background=0D6EFD&color=fff&size=128";
}