<?php

use Carbon\Carbon;

    function generateNumberTransaction($id){
        $date = Carbon::now()->format('Ymd');
        $number = ($id < 10) ? '00'.$id : ($id < 100 ? '0'.$id : $id);
        $notrans = 'TRCT' . $date . $number;
        return $notrans;
    }
?>