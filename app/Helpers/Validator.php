<?php

namespace App\Helpers;

class Validator
{
    protected $errors = [];

    public function validate($inputs, $rules)
    {
        foreach ($rules as $inputName => $inputRules) {
            $inputValue = $inputs[$inputName] ?? null;

            foreach ($inputRules as $rule) {
                if (is_string($rule)) {
                    $rule = explode(':', $rule);
                }

                $ruleName = $rule[0];
                $ruleParams = isset($rule[1]) ? explode(',', $rule[1]) : [];

                $methodName = 'validate' . ucfirst($ruleName);
                if (!method_exists($this, $methodName)) {
                    throw new Exception("Validation rule not found: {$ruleName}");
                }

                if (!$this->{$methodName}($inputValue, ...$ruleParams)) {
                    $this->addError($inputName, $ruleName, $ruleParams);
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function addError($inputName, $ruleName, $ruleParams)
    {
        $message = str_replace(':attribute', $inputName, $this->getErrorMessage($ruleName));

        foreach ($ruleParams as $paramName => $paramValue) {
            $message = str_replace(":{$paramName}", $paramValue, $message);
        }

        $this->errors[$inputName][] = $message;
    }

    protected function getErrorMessage($ruleName)
    {
        $messages = [
            'required' => ':attribute is required',
            'email' => ':attribute must be a valid email',
            'min' => ':attribute must be at least :min characters',
            'max' => ':attribute may not be greater than :max characters',
            'in' => ':attribute must be one of the following: :values',
            'numeric' => ':attribute must be a number',
            'integer' => ':attribute must be an integer',
            'alpha' => ':attribute may only contain letters',
            'alpha_num' => ':attribute may only contain letters and numbers',
            'url' => ':attribute must be a valid URL',
            'date' => ':attribute must be a valid date',
        ];

        return $messages[$ruleName] ?? "Invalid :attribute";
    }

    protected function validateRequired($value)
    {
        return !empty($value);
    }

    protected function validateEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    protected function validateMin($value, $min)
    {
        return strlen($value) >= $min;
    }

    protected function validateMax($value, $max)
    {
        return strlen($value) <= $max;
    }

    protected function validateIn($value, $values)
    {
        return in_array($value, $values);
    }

    protected function validateNumeric($value)
    {
        return is_numeric($value);
    }

    protected function validateInteger($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    protected function validateAlpha($value)
    {
        return ctype_alpha($value);
    }

    protected function validateAlphaNum($value)
    {
        return ctype_alnum($value);
    }

    protected function validateUrl($value)
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    protected function validateDate($value, $format)
    {
        $date = \DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }

    protected function validateDatetime($value, $format)
    {
        return $this->validateDate($value, $format);
    }


    protected function validateMime($value, $mimes)
    {
        if (!is_array($mimes)) {
            $mimes = explode(',', $mimes);
        }

        if (empty($value['type']) || !in_array($value['type'], $mimes)) {
            return false;
        }

        return true;
    }

    protected function validateExtension($value, $extensions)
    {
        if (!is_array($extensions)) {
            $extensions = explode(',', $extensions);
        }

        $extension = pathinfo($value['name'], PATHINFO_EXTENSION);

        if (empty($extension) || !in_array($extension, $extensions)) {
            return false;
        }

        return true;
    }


    protected function validateSize($value, $size)
    {
        if (empty($value['size']) || $value['size'] > $size) {
            return false;
        }

        return true;
    }
}
