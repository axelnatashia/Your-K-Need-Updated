<?php
    function returnPaymentMethod($key = null){
        $arr = [
                'pay_later' => 'Pay Later',
                'full_payment' => 'Full Payment',
            ];
        if ($key == null) return $arr;
        if (array_key_exists($key, $arr)) return $arr[$key];
        return "null";
    }

    function returnStatusCheckout($key = null){
        $arr = [
                'pay_later' => 'Pay Later',
                'full_payment' => 'Full Payment',
            ];
        if ($key == null) return $arr;
        if (array_key_exists($key, $arr)) return $arr[$key];
        return "null";
    }

    function returnStatusPaylater($key = null){
        $arr = [
                'checking' => 'Checking',
                'confirm' => 'Confirm',
                'decline' => 'Decline',
            ];
        if ($key == null) return $arr;
        if (array_key_exists($key, $arr)) return $arr[$key];
        return "null";
    }

    function returnStatusCheckoutDetail($key = null){
        $arr = [
                'in progress' => 'In Progress',
                'in delivery' => 'In Delivery',
                'arrived' => 'Arrived',
            ];
        if ($key == null) return $arr;
        if (array_key_exists($key, $arr)) return $arr[$key];
        return "null";
    }
?>
