<?php

namespace app\models\utils;

class NumberFormatter
{
    private function __construct()
    {
    }

    public static function truncateTwoDecimal($floatValue)
    {
        $value = intval($floatValue * 100);
        $value = $value / 100;
        return $value;
    }
}