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


$id = intval($_POST['id']);
$invoiceNum = intval($_POST['invoice_num']);
$name = $_POST['name'];
$address = $_POST['address'];

// Connect to the MySQL database
$db = new Database($config);

$sql = "UPDATE invoice SET invoice_number = :num, invoice_name = :name, address = :address WHERE id = :id";
$params = ['id' => $id,'num' => $invoiceNum, 'name' => $name, 'address' => $address];
// $params = ['id' => 9,'num' => 'w', 'name' => 'changed', 'address' => 'xyz']; // for testing
$result = $db->query($sql, $params);

// $result = $conn->query($sql);

if ($result->errorCode() !== '00000') {
    $response = 'Error: ' . $result->errorInfo()[2];
} elseif ($result->rowCount() > 0) {
    $response = 'Data saved successfully';
} else {
    $response = 'No rows were updated';
}
$db->close();
// dd($result->errorInfo());
dd($response);
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
echo json_encode($response)

?>