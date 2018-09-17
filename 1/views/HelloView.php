<?php

require_once './core/views.php';

class HelloView extends TwigView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("index.html");
    }

    function getContext(): array {
        $this->context["msg"] = $this->params[0];
        return $this->context;
    }

}
