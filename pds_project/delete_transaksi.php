<?php
session_start();
$id = $_GET['id'];

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Step 3: Delete document from MongoDB
$collection = 'clinic.transaksi';
$filter = ['transaction_id' => $id];

$bulkWrite = new MongoDB\Driver\BulkWrite();
$bulkWrite->delete($filter);

$result = $manager->executeBulkWrite($collection, $bulkWrite);

// Check if the delete operation was successful
if ($result->getDeletedCount() > 0) {
    header('location:adminpage_transaksi.php');
}
?>