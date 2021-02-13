<?php

namespace App\Services\NumberRound;

use App\Core\Exception\Exceptions\NotFoundException;

/**
 * This class will create an instance of a NumberRound
 * PHP version >= 7.0
 *
 * @category Services
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class NumberRoundFactory
{
    /**
     * @param string $rule
     *
     * @return NumberRoundInterface
     * @throws NotFoundException
     */
    public static function create(string $rule)
    {
        $namespace = "App\Services\NumberRound\NumberRound$rule";
        if (class_exists($namespace)) {
            return new $namespace();
        }
        throw new NotFoundException();
    }
}
