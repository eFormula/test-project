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
class NumberRound99 implements NumberRoundInterface
{
    /**
     * @param float $number
     * @param int   $precision
     *
     * @return float
     */
    public function round(float $number, int $precision = 0): float
    {
        return round($number, $precision, PHP_ROUND_HALF_UP) - 1 + 0.99;
    }
}
