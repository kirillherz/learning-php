<?php

require_once './models/result.php';
require_once './queries/ResultQueries/queries.php';

class ResultView extends ContextView {

    public function __construct() {
        parent::__construct();
        $this->setTemplate("result.html");
    }

    public function getContext(): array {
        $result = (new QueryGetAll())->getAll();
        $this->context["result"] = $result;
        return $this->context;
    }

}
