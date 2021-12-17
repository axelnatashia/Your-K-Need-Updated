<?php

use Carbon\Carbon;

    function format_datetime($date) {
        return Carbon::parse($date)->translatedFormat('d F Y H:i:s')." WIB";
    }

    function format_rupiah($str) {
        if ( ! is_numeric($str)) return false;
        return "IDR ".number_format($str,0,',','.');
    }
?>
