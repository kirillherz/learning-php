<?php

require_once './core/views.php';

class SummaView extends TwigView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("summa.html");
    }
}
