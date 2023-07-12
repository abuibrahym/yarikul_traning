<?php

require 'autoloader.php';
$config = require('config.php');


$id = intval($_POST['id']);
$invoiceNum = intval($_POST['invoice_num']);
$name = $_POST['name'];
$address = $_POST['address'];

$invoiceController = new InvoiceController($config);
$response = $invoiceController->updateInvoice($id, $invoiceNum, $name, $address);

echo json_encode($response) ;

?>