<?php

namespace App\Http\Controllers;

use App\Core\Controller\Controller;
use App\Core\Exception\Exceptions\NotFoundException;
use App\Core\Exception\Exceptions\RuleNotFoundException;
use App\Core\Helpers\Request;
use App\Core\Request\RequestValidation;
use App\Exceptions\InvalidValueException;
use App\Requests\PriceCalculateRequest;
use App\Services\PriceCalculator;

/**
 * The entry point for calculating Store Retail Price Based on user inputs of cost and initial markup
 * PHP version >= 7.0
 *
 * @category Controllers
 * @package  Test Project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class PriceCalculateController extends Controller
{
    /**
     * @throws InvalidValueException
     * @throws NotFoundException
     * @throws RuleNotFoundException
     */
    public function calculate()
    {
        if (Request::isPost()) {
            $this->calculateResult();
        } else {
            $this->renderForm();
        }
    }

    /**
     * @throws InvalidValueException
     * @throws NotFoundException
     * @throws RuleNotFoundException
     */
    private function calculateResult()
    {
        $validator = new RequestValidation(new PriceCalculateRequest());
        if ($validator->isNotValid()) {
            $this->renderForm(["errors" => $validator->getErrors()]);
            return;
        }
        $data = $validator->getData();
        $priceCalculator = new PriceCalculator();
        $priceCalculator->setMarkup((int)$data["default_markup"])
            ->setPricingMode((int)$data["pricing_mode"])
            ->setRoundingRule($data["rounding_rule"])
            ->setTaxRate((int)$data["tax_rate"]);
        $exclusiveTax = $priceCalculator->getExclusiveTax($data["cost"]);
        $inclusiveTax = $priceCalculator->getInclusiveTax($data["cost"]);
        $grossProfitAmount = $priceCalculator->getGrossProfitAmount($exclusiveTax, $data["cost"]);
        $grossProfitPercentage = $priceCalculator->getGrossProfitPercentage($exclusiveTax, $data["cost"]);
        $this->renderForm([
            "result" => [
                "exclusiveTax" => $exclusiveTax,
                "inclusiveTax" => $inclusiveTax,
                "grossProfitAmount" => $grossProfitAmount,
                "grossProfitPercentage" => $grossProfitPercentage,
            ]
        ]);
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function renderForm(array $data = []): void
    {
        $this->render("/calculate/form", $data);
    }
}
