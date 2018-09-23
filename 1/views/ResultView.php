<?php

require_once './models/result.php';

class QueryGetAll {

    private $connection;

    public function __construct() {
        $this->connection = new PDO("sqlite:database.db");
    }

    public function getAll(): array {
        $sql = 'SELECT result FROM Results';
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Result");
    }

}

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
