<?php

require_once './core/views.php';

class Validator {

    private $value;
    private $isValid = true;

    public function __construct($value) {
        $this->value = $value;
    }

    public function isEmpty() {
        $this->isValid = $this->isValid & $this->value != "";
        return $this;
    }

    public function isNumeric() {
        $this->isValid = $this->isValid & is_numeric($this->value);
        return $this;
    }

    public function isValid() {
        return $this->isValid;
    }

}

class SummaForm {

    private $a;
    private $b;

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
        $isValidA = (new Validator($this->a))
                ->isEmpty()
                ->isNumeric()
                ->isValid();
        $isValidB = (new Validator($this->a))
                ->isEmpty()
                ->isNumeric()
                ->isValid();
        $is_valid = $isValidA & $isValidB;
        return $is_valid;
    }

}

class ResultView extends TwigView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("result.html");
    }

    function getContext(): array {
        $this->context["result"] = $_POST["1"] + $_POST["2"];
        $summaForm = new SummaForm();
        $summaForm->setA($_POST["1"]);
        $summaForm->setB($_POST["2"]);
        if ($summaForm->isValid()) {
            $this->context["result"] = $summaForm->getA() + $summaForm->getB();
        } else {

            $this->context["result"] = "ошибка";
        }
        return $this->context;
    }

}
