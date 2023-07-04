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
$db = new Database($config);

// Query to retrieve the list of invoices
$sql = "SELECT * FROM invoice";
$result = $db->query($sql);
if (!$result) {
    die('Error executing the query ' );
}
// Fetch the invoice data and store it in an array
// $invoices = [];
// while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
//     $invoices[] = $row;
// }
$invoices =  $result->fetchAll(PDO::FETCH_ASSOC);
// Close the database connection
$db->close();
// dd($invoices);
// Return the invoice data as JSON
header('Content-Type: application/json');
echo json_encode($invoices);

?>
