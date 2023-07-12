<?php

require 'autoloader.php';
$config = require('config.php');
// Connect to the MySQL database
$id = intval($_GET["id"]);
// $id = 19;


$invoiceController = new InvoiceController($config);
$response = $invoiceController->getInvoiceDetail($id);
echo $response;
?>