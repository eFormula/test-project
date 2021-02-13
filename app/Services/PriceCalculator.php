<?php

namespace App\Services;

use App\Core\Exception\Exceptions\NotFoundException;
use App\Exceptions\InvalidValueException;
use App\Services\NumberRound\NumberRoundFactory;

/**
 * This class will calculate the prices
 * PHP version >= 7.0
 *
 * @category Services
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class PriceCalculator
{
    public const PRICING_MODE = [
        "tax_exclusive" => 0,
        "tax_inclusive" => 1,
    ];

    /**
     * @var int
     */
    private int $markup = 52;

    /**
     * @var int
     */
    private int $taxRate = 7;

    /**
     * @var string
     */
    private string $roundingRule = "98";

    /**
     * @var int
     */
    private int $pricingMode;

    /**
     * PriceCalculator constructor.
     */
    public function __construct()
    {
        $this->pricingMode = self::PRICING_MODE["tax_exclusive"];
    }

    /**
     * @param int $markup
     *
     * @return PriceCalculator
     */
    public function setMarkup(int $markup): PriceCalculator
    {
        $this->markup = $markup;
        return $this;
    }

    /**
     * @param int $taxRate
     *
     * @return PriceCalculator
     */
    public function setTaxRate(int $taxRate): PriceCalculator
    {
        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     * @param string $roundingRule
     *
     * @return PriceCalculator
     */
    public function setRoundingRule(string $roundingRule): PriceCalculator
    {
        $this->roundingRule = $roundingRule;
        return $this;
    }

    /**
     * @param int $pricingMode
     *
     * @return PriceCalculator
     * @throws InvalidValueException
     */
    public function setPricingMode(int $pricingMode): PriceCalculator
    {
        if (!in_array($pricingMode, self::PRICING_MODE)) {
            throw new InvalidValueException();
        }
        $this->pricingMode = $pricingMode;
        return $this;
    }

    /**
     * @param float $cost
     *
     * @return float|int
     */
    private function getPrice(float $cost)
    {
        return $cost / (1 - ($this->markup / 100));
    }

    /**
     * @param float $cost
     *
     * @return float
     * @throws NotFoundException
     */
    public function getExclusiveTax(float $cost): float
    {
        $rawPrice = $this->getPrice($cost);
        if ($this->pricingMode == self::PRICING_MODE["tax_exclusive"]) {
            $roundedPrice = $this->numberRound($rawPrice);
        } else {
            $roundedPrice = round($rawPrice);
        }
//        $customerPays = round($roundedPrice * ($this->taxRate / 100));
        return round(($roundedPrice - $cost) / $roundedPrice, 2);
    }

    /**
     * @param float $cost
     *
     * @return float
     * @throws NotFoundException
     */
    public function getInclusiveTax(float $cost): float
    {
        $rawPrice = $this->getPrice($cost);
        if ($this->pricingMode == self::PRICING_MODE["tax_inclusive"]) {
            $roundedPrice = $this->numberRound($rawPrice);
        } else {
            $roundedPrice = round($rawPrice);
        }
        return round(($roundedPrice - $cost) / $roundedPrice, 2);
    }

    /**
     * @param float $exclusiveTax
     * @param float $cost
     *
     * @return float
     */
    public function getGrossProfitAmount(float $exclusiveTax, float $cost): float
    {
        return round($cost - $exclusiveTax, 2);
    }

    /**
     * @param float $exclusiveTax
     * @param float $cost
     *
     * @return float
     */
    public function getGrossProfitPercentage(float $exclusiveTax, float $cost): float
    {
        $grossProfit = $this->getGrossProfitAmount($exclusiveTax, $cost);
        return round(($exclusiveTax * 100) / $grossProfit, 2);
    }

    /**
     * @param float $rawPrice
     *
     * @return float
     * @throws NotFoundException
     */
    private function numberRound(float $rawPrice): float
    {
        $numberRound = NumberRoundFactory::create($this->roundingRule);
        $rawPrice = $numberRound->round($rawPrice);
        return $rawPrice;
    }
}
