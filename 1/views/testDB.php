<?php

require_once './core/views.php';

class MyTable {

    public $title;
    public $value;

}

class QuerySave {

    private $connection;

    public function __construct() {
        $this->connection = new PDO("sqlite:database.db");
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
class QueryGetAll {

    private $connection;

    public function __construct() {
        $this->connection = new PDO("sqlite:database.db");
    }

    public function getAll(): array {
        $sql = 'SELECT title, value FROM myTable';
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, "MyTable");
    }

}

        $this->context["result"] = $result;
        echo $this->twig->render($this->template, $this->context);
    }

}
