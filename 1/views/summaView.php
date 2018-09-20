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

require_once './models/summa.php';

class SummaView extends ContextView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("summa.html");
    }

    public function post() {
        $summaForm = new Summa();
        $summaForm->setA($_POST["1"]);
        $summaForm->setB($_POST["2"]);
        if ($summaForm->isValid()) {
            $this->setTemplate("result.html");
            $this->context["result"] = $summaForm->getA() + $summaForm->getB();
        } else {
            $this->context["a"] = $_POST["1"];
            $this->context["b"] = $_POST["2"];
            $this->context["errors"] = $summaForm->getErrors();
        }
        echo $this->twig->render($this->template, $this->context);
    }

}
