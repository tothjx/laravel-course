<?php

use App\Helpers\PhoneHelper;

if (!function_exists('formatNumber')) {
    /**
     * telefonszam formazasa +11(11)1111111 formatumra
     *
     * @param string $phoneNumber
     * @return string
     */
    function formatNumber($phoneNumber)
    {
        return PhoneHelper::formatNumber($phoneNumber);
    }
}