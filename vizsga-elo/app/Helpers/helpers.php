<?php

use Carbon\Carbon;

if (!function_exists('tenDaysFromNow')) {
    /**
     * Visszaadja a dátumot ami 10 nap múlva lesz
     *
     * @return Carbon
     */
    function tenDaysFromNow(): Carbon
    {
        return Carbon::now()->addDays(10);
    }
}
