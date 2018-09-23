<?php

namespace summaView;

use PDO;

require_once '././models/result.php';

use Result;

class QuerySave {

    private $connection;

    public function __construct() {
        $this->connection = new PDO("sqlite:database.db");
    }

    public function save(Result $model) {
        $this->connection->exec("
            CREATE TABLE IF NOT EXISTS results (
                    id INTEGER PRIMARY KEY, 
                    result TEXT)");
        $insert = "INSERT INTO results (result) VALUES (:result)";
        $stmt = $this->connection->prepare($insert);
        $stmt->bindParam(":result", $model->result);
        $stmt->execute();
    }

}
