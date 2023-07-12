<?php

require 'autoloader.php';
$config = require('config.php');
$id = intval($_GET["id"]);
// $id = 11;

$invoiceController = new InvoiceController($config);
$response = $invoiceController->deleteInvoice($id);
echo json_encode($response);
?>