<?php
spl_autoload_register(function ($className) {
    $filePath = __DIR__ . '/' . $className . '.php';
    if (file_exists($filePath)) {
        require_once($filePath);
    }
});
// require 'Database.php';
require 'functions.php';
$config = require('config.php');
// Connect to the MySQL database
$id = intval($_GET["id"]);
// $id = 6;

$db = new Database($config);
$sql = "SELECT *  FROM invoice where id= :id";

$result =  $db->query($sql, ['id'=>$id]); 
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    //dd($row);
    echo json_encode($row);
} else {
    echo "No invoice found with ID: $id";
}

$db->close();

?>