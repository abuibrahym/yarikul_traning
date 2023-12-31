<?php

//namespace Core;

//use PDO;

//require 'functions.php';
//$config = require('config.php');
class Database{
    public $connection;

    public function __construct($config)
    {
        // echo 'insde construct!!';
        $dsn = 'mysql:' . http_build_query($config['database'], '', ';');
        $this->connection = new PDO($dsn, $config['username'], $config['password']);
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);

        $statement->execute($params);

        return $statement;
    }

    public function close(){
        $this->connection = null;
        // echo 'connection closed!!';
    }
}

// $sql = "INSERT INTO invoice (invoice_number, invoice_name, address) VALUES (:num, :name, :address)";
// $params = ['num' => 1, 'name' => 'test1', 'address' => 'xyz']; // for testing
// $db = new Database($config);
// $result = $db->query($sql, $params);

// $query = "select * from invoice where id = :id";
// $posts = $db->query($query, ['id'=>'5'])->fetch(PDO::FETCH_ASSOC);

// dd($posts);

?>