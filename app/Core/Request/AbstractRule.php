<?php

namespace App\Core\Request;

/**
 * The interface for the rules
 * PHP version >= 7.0
 *
 * @category Core
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
abstract class AbstractRule
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @var string
     */
    protected string $ruleName;

    /**
     * @var string
     */
    private string $fieldName;

    /**
     * AbstractRule constructor.
     *
     * @param string $fieldName
     * @param string $ruleName
     */
    public function __construct(string $fieldName, string $ruleName)
    {
        $this->ruleName = $ruleName;
        $this->fieldName = $fieldName;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function addError(string $message): AbstractRule
    {
        if (!isset($this->errors[$this->fieldName])) {
            $this->errors[$this->fieldName] = [];
        }
        $this->errors[$this->fieldName] = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    public function isNotValid($ruleValue, $valueToCompare): bool
    {
        return !$this->isValid($ruleValue, $valueToCompare);
    }

    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    abstract public function isValid($ruleValue, $valueToCompare): bool;
}
