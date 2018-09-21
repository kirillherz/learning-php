<?php

require_once './core/views.php';

class TestDbView extends ContextView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("test.html");
    }

    public function get() {
        $connection = new PDO("sqlite:database.db");
        $connection->exec(
                "CREATE TABLE IF NOT EXISTS myTable (
                    id INTEGER PRIMARY KEY, 
                    title TEXT, 
                    value TEXT)");
        $insert = "INSERT INTO myTable (title, value) VALUES (:title, :value)";
        $stmt = $connection->prepare($insert);
        $stmt->bindValue(":title", "Asdasda");
        $stmt->bindValue(":value", "dasdasdas");
        $stmt->execute();
        $sql = 'SELECT title, value FROM myTable';
        $stmt = $connection->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->context["result"] = $result;
        echo $this->twig->render($this->template, $this->context);
    }

}
