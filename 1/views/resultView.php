<?php

require_once './core/views.php';

class Validator {

    private $value;
    private $isValid;
    private $errors;

    public function __construct($value) {
        $this->errors = array();
        $this->isValid = true;
        $this->value = $value;
    }

    public function isEmpty(string $ErrorMessage) {
        $this->isValid = $this->isValid & $this->value != "";
        if (!$this->isValid) {
            array_push($this->errors, $ErrorMessage);
        }
        return $this;
    }

    public function isNumeric(string $ErrorMessage) {
        $this->isValid = $this->isValid & is_numeric($this->value);
        if (!$this->isValid) {
            array_push($this->errors, $ErrorMessage);
        }
        return $this;
    }

    public function isValid() {
        return $this->isValid;
    }

    public function getErrorsMessages() {
        return $this->errors;
    }

}

class SummaForm {

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

class ResultView extends TwigView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("result.html");
    }

    public function post() {
        $summaForm = new SummaForm();
        $summaForm->setA($_POST["1"]);
        $summaForm->setB($_POST["2"]);
        if ($summaForm->isValid()) {
            $this->context["result"] = $summaForm->getA() + $summaForm->getB();
        } else {

            $this->context["result"] = $summaForm->getErrors()["a"][0];
        }
        echo $this->twig->render($this->template, $this->context);
    }

}
