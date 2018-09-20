<?php

class Summa {

    private $a;
    private $b;
    private $errors;

    public function __construct() {

        $this->errors = array();
    }

    public function setA(string $a) {
        $input_text = strip_tags($a);
        $input_text = htmlspecialchars($input_text);
        $this->a = $input_text;
    }

    public function setB(string $a) {
        $input_text = strip_tags($a);
        $input_text = htmlspecialchars($input_text);
        $this->b = $input_text;
    }

    public function getA(): float {
        return (float) $this->a;
    }

    public function getB(): float {
        return (float) $this->b;
    }

    public function isValid(): bool {
        $validator = new Validator($this->a);
        $isValidA = $validator
                ->isEmpty("Поле пустое")
                ->isNumeric("Не число")
                ->isValid();
        $this->errors["a"] = $validator->getErrorsMessages();
        $validator = new Validator($this->b);
        $isValidB = $validator
                ->isEmpty("Поле пустое")
                ->isNumeric("Не число")
                ->isValid();
        $this->errors["b"] = $validator->getErrorsMessages();
        $is_valid = $isValidA & $isValidB;
        return $is_valid;
    }

    public function getErrors() {
        return $this->errors;
    }

}
