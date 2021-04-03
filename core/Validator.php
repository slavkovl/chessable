<?php

namespace App\Core;

class Validator {

    private $_errors = [];

    public function validate($src, $rules = []) {

        foreach ($src as $item => $item_value) {
            if (key_exists($item, $rules)) {
                foreach ($rules[$item] as $rule => $rule_value) {

                    if (is_int($rule)) {
                        $rule = $rule_value;
                    }

                    switch ($rule) {
                        case 'required':
                            if (empty($item_value) && $rule_value) {
                                $this->addError($item, ucwords(str_replace('_', ' ', $item)) . ' required');
                            }
                            break;
                        case 'maxLen':
                            if (strlen($item_value) > $rule_value) {
                                $this->addError($item, ucwords(str_replace('_', ' ', $item)) . ' should be maximum ' . $rule_value . ' characters');
                            }
                            break;
                        case 'amount':
                            if (is_bool($item_value) || preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/', $item_value) == '0') {
                                $this->addError($item, ucwords(str_replace('_', ' ', $item)) . ' is not a correct amount value');
                            }
                            break;
                        case 'in':
                            if (!in_array($item_value, $rule_value)) {
                                $this->addError($item, ucwords(str_replace('_', ' ', $item)) . ' is not a correct value');
                            }
                            break;
                        case 'notequal':
                            if ($item_value == $rule_value) {
                                $this->addError($item, ucwords(str_replace('_', ' ', $item)) . ' is not a correct value');
                            }
                            break;
                        case 'min':
                            if (!is_numeric($item_value) || $item_value < $rule_value) {
                                $this->addError($item, ucwords(str_replace('_', ' ', $item)) . ' is less then ' . $rule_value);
                            }
                            break;
                    }
                }
            }
        }
    }

    private function addError($item, $error) {
        $this->_errors[$item][] = $error;
    }

    public function error() {
        if (empty($this->_errors)) {
            return false;
        }
        return $this->_errors;
    }

}
