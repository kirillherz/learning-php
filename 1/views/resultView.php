<?php

require_once './core/views.php';

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
