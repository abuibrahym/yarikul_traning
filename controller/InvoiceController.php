<?php
require 'autoloader.php';
require 'functions.php';
class InvoiceController
{
    private $db;

    public function __construct($config)
    {
        $this->db = new Database($config);
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function createInvoice($invoiceNum, $name, $address)
    {
        $sql = "INSERT INTO invoice (invoice_number, invoice_name, address) VALUES (:num, :name, :address)";
        $params = ['num' => $invoiceNum, 'name' => $name, 'address' => $address];
        $result = $this->db->query($sql, $params);

        if ($result->errorCode() === '00000') {
            $response = 'Data saved successfully';
        } else {
            $response = 'Error: ' . $result->errorInfo()[2];
        }

        return $response;
    }

    public function getInvoiceDetail($id)
    {
        $sql = "SELECT * FROM invoice WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            // dd($row);
            return json_encode($row);
        } else {
            return "No invoice found with ID: $id";
        }
    }

    public function getAllInvoices()
    {
        $sql = "SELECT * FROM invoice";
        $result = $this->db->query($sql);

        if (!$result) {
            die('Error executing the query');
        }

        $invoices = $result->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($invoices);
    }

    public function updateInvoice($id, $invoiceNum, $name, $address)
    {
        $sql = "UPDATE invoice SET invoice_number = :num, invoice_name = :name, address = :address WHERE id = :id";
        $params = ['id' => $id, 'num' => $invoiceNum, 'name' => $name, 'address' => $address];
        $result = $this->db->query($sql, $params);

        if ($result->errorCode() !== '00000') {
            $response = 'Error: ' . $result->errorInfo()[2];
        } elseif ($result->rowCount() > 0) {
            $response = 'Data saved successfully';
        } else {
            $response = 'No rows were updated';
        }
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        return $response;
    }

    public function deleteInvoice($id)
    {
        $sql = "DELETE FROM invoice WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);

        if ($result->rowCount() > 0) {
            $response = 'Invoice Deleted Successfully';
        } else {
            $response = 'Invalid Id';
        }

        return json_encode($response);
    }
}
