<?php

require_once './core/views.php';

class SummaView extends ContextView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("summa.html");
    }
}
