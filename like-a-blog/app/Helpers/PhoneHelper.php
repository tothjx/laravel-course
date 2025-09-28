<?php

namespace App\Helpers;

class PhoneHelper
{
    /**
     * telefonszamot formaz
     * 
     * @param string $phoneNumber
     * @return string
     */
    public static function formatNumber(string $phoneNumber): string
    {
        $cleaned = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($cleaned) === 11 && substr($cleaned, 0, 2) === '36') {
            $countryCode = substr($cleaned, 0, 2);
            $areaCode = substr($cleaned, 2, 2);
            $number = substr($cleaned, 4);
        } elseif (strlen($cleaned) === 9) {
            $countryCode = '36';
            $areaCode = substr($cleaned, 0, 2);
            $number = substr($cleaned, 2);
        } else {
            // ha nem jo a szam formatuma
            return $phoneNumber;
        }

        $formattedNumber = substr($number, 0, 3) . substr($number, 3);

        return "+{$countryCode}({$areaCode}){$formattedNumber}";
    }
}
