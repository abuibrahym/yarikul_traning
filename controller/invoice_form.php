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

$invoiceNum = intval($_POST['invoice_num']);
$name = $_POST['name'];
$address = $_POST['address'];


$db = new Database($config);
$sql = "INSERT INTO invoice (invoice_number, invoice_name, address) VALUES (:num, :name, :address)";
$params = ['num' => $invoiceNum, 'name' => $name, 'address' => $address];
// $params = ['num' => 24, 'name' => 'test2', 'address' => 'xyz']; // for testing
$result = $db->query($sql, $params);

if ($result->errorCode() === '00000') {
    $response = 'Data saved successfully';
} else {
    $response = 'Error: ' . $result->errorInfo()[2];
}

// Close the database connection
$db->close();
// dd($response);
echo $response;
?>
