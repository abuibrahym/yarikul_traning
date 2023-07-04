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
// $id = 11;

$db = new Database($config);
$sql = "DELETE FROM invoice where id= :id";
$result = $db->query($sql, ['id'=>$id]);//$conn->query($sql);

// dd($result->rowCount());
if ($result->rowCount() >0){
    $response = 'Invoice Deleted Successfully';
}else{
    $response = 'Invalid Id';
}
$db->close();
echo json_encode($response);
?>