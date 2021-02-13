<?php

namespace App\Services\NumberRound;

/**
 * This class will round a price
 * PHP version >= 7.0
 *
 * @category Services
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class NumberRound00 implements NumberRoundInterface
{
    /**
     * @param float $number
     * @param int   $precision
     *
     * @return float
     */
    public function round(float $number, int $precision = 0): float
    {
        $baseNumber = floor($number);
        $afterPoint = $baseNumber - $number;
        if ($afterPoint > 0.40) {
            return ceil($number);
        }
        return floor($number);
    }
}
