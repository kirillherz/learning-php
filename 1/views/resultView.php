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

class ResultView extends TwigView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("result.html");
    }

    function getContext(): array {
        $this->context["result"] = $_POST["1"] + $_POST["2"];
        return $this->context;
    }

}
