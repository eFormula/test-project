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
interface NumberRoundInterface
{
    /**
     * @param float $number
     * @param int   $precision
     *
     * @return float
     */
    public function round(float $number, int $precision = 0): float;
}
