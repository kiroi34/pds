<?php
session_start();
$id = $_GET['id'];
echo $id;

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Step 3: Delete document from MongoDB
$collection = 'clinic.record';
$filter = ['id_record' => $id];

$bulkWrite = new MongoDB\Driver\BulkWrite();
$bulkWrite->delete($filter);

$result = $manager->executeBulkWrite($collection, $bulkWrite);

// Check if the delete operation was successful
if ($result->getDeletedCount() > 0) {
    header('location:adminpage_record.php');
}
?>
