<?php

require_once './core/views.php';
require_once './models/summa.php';
require_once './queries/ResultQueries/save.php';
require_once '././models/result.php';

use summaView\QuerySave;

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
            $this->context["result"] = $summaForm->getA() + $summaForm->getB();
            $result = new Result();
            $result->result = (string) $this->context["result"];
            (new QuerySave())->save($result);
            header('Location: /result ');
        } else {
            $this->context["a"] = $_POST["1"];
            $this->context["b"] = $_POST["2"];
            $this->context["errors"] = $summaForm->getErrors();
        }
        echo $this->twig->render($this->template, $this->context);
    }

}
