<?php
require 'autoloader.php';
$config = require('config.php');

$invoiceNum = intval($_POST['invoice_num']);
$name = $_POST['name'];
$address = $_POST['address'];

$invoiceController = new InvoiceController($config);
$response = $invoiceController->createInvoice($invoiceNum, $name, $address);
echo $response;
?>
