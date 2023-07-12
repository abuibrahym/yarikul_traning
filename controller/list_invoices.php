<?php

require 'autoloader.php';
$config = require('config.php');
$invoiceController = new InvoiceController($config);
$response = $invoiceController->getAllInvoices();

echo $response;

?>
