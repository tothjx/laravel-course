<?php

if (!function_exists('getAppName')) {
    function getAppName() {
        return config('app.name');
    }
}
