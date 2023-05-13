<?php

namespace App\Services;

class NumberFormatService
{

    public static function money(int $price)
    {
        return number_format($price, 0, ' ', ' ');
    }
}
