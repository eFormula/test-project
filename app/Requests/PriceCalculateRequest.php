<?php

namespace App\Requests;

use App\Core\Request\RequestInterface;

/**
 * This class will hold the rules to validate the incoming data for calculation
 * PHP version >= 7.0
 *
 * @category Requests
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class PriceCalculateRequest implements RequestInterface
{

    public function rules(): array
    {
        return [
            "default_markup" => [
                "type" => "numeric",
                "regex" => "/^[0-9]{1,3}.?[0-9]{0,2}$/",
                "min" => 10,
                "max" => 200,
                "default" => 52,
            ],
            "cost" => [
                "required" => true,
                "type" => "numeric",
                "regex" => "/^[0-9]{1,15}.[0-9]{4}$/",
                "min" => 0,
            ],
            "tax_rate" => [
                "in" => [0, 7, 20],
                "default" => 7
            ],
            "rounding_rule" => [
                "in" => ["00", "95", "99"],
                "default" => "95"
            ],
            "pricing_mode" => [
                "in" => ["tax_inclusive_prices", "tax_exclusive_prices"],
                "default" => "tax_exclusive_prices"
            ]
        ];
    }
}
