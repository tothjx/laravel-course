<?php

use Carbon\Carbon;

if (!function_exists('tenDaysFromNow')) {
    /**
     * visszadja a mai naphoz kepest
     * 10 nappal kesobbi datumot
     *
     * @return Carbon
     */
    function tenDaysFromNow(): Carbon
    {
        return Carbon::now()->addDays(10);
    }
}
