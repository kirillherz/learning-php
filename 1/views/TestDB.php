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

    public function save(MyTable $model) {
        $this->connection->exec(
                "CREATE TABLE IF NOT EXISTS myTable (
                    id INTEGER PRIMARY KEY, 
                    title TEXT, 
                    value TEXT)");
        $insert = "INSERT INTO myTable (title, value) VALUES (:title, :value)";
        $stmt = $this->connection->prepare($insert);
        $stmt->bindParam(":title", $model->title);
        $stmt->bindParam(":value", $model->value);
        $stmt->execute();
    }

}

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

class TestDbView extends ContextView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("test.html");
    }

    public function get() {
        (new QuerySave())->save(new class extends MyTable {

            public $title = "Kirill2";
            public $value = "Herz2";
        });
        $result = (new QueryGetAll())->getAll();
        $this->context["result"] = $result;
        echo $this->twig->render($this->template, $this->context);
    }

}
