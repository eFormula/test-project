<?php

namespace App\Core\Request;

use App\Core\Exception\Exceptions\RuleNotFoundException;
use App\Core\Helpers\Request;

/**
 * This class will validate incoming request based on the received data
 * PHP version >= 7.0
 *
 * @category Requests
 * @package  Test Project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class RequestValidation
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @var int
     */
    private int $errorCount = 0;

    /**
     * @var array
     */
    private array $data = [];

    /**
     * RequestValidation constructor.
     *
     * @param RequestInterface $request
     *
     * @throws RuleNotFoundException
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
        $this->validate();
    }

    /**
     * @return void
     * @throws RuleNotFoundException
     */
    private function validate(): void
    {
        $rules = $this->request->rules();
        foreach ($rules as $fieldName => $fieldRules) {
            foreach ($fieldRules as $ruleName => $ruleValue) {
                $rule = RuleFactory::create($fieldName, $ruleName);
                $receivedValue = Request::get($fieldName);
                if (empty($receivedValue) && $this->hasDefaultValue($fieldRules)) {
                    $this->assignData($fieldName, $this->getDefaultValue($fieldRules));
                    break;
                }
                if ($rule->isNotValid($ruleValue, $receivedValue)) {
                    $this->appendErrors($rule);
                    break;
                } else {
                    $this->assignData($fieldName, $receivedValue);
                }
            }
        }
        $this->errorCount = count($this->errors);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->errorCount == 0;
    }

    /**
     * @return bool
     */
    public function isNotValid(): bool
    {
        return !$this->isValid();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param AbstractRule $rule
     */
    private function appendErrors(AbstractRule $rule): void
    {
        $this->errors = array_merge($this->errors, $rule->getErrors());
    }

    /**
     * @param array $fieldRules
     *
     * @return bool
     */
    private function hasDefaultValue(array $fieldRules): bool
    {
        return isset($fieldRules["default"]);
    }

    /**
     * @param array $fieldRules
     *
     * @return mixed
     */
    private function getDefaultValue(array $fieldRules)
    {
        return $fieldRules["default"];
    }

    /**
     * @param string $fieldName
     * @param mixed  $receivedValue
     *
     * @return string
     */
    public function assignData(string $fieldName, $receivedValue): string
    {
        return $this->data[$fieldName] = $receivedValue;
    }
}
