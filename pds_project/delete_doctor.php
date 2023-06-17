<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Step 2: Retrieve ID value from $_GET
$id = $_GET['dokter']; // Assuming the ID is passed as a query parameter named 'dokter'

// Step 3: Delete document from MongoDB
$collection = 'clinic.dokter';
$filter = ['id_dokter' => $id]; // Assuming 'id_dokter' is the field name in your collection

$bulkWrite = new MongoDB\Driver\BulkWrite();
$bulkWrite->delete($filter);

$result = $manager->executeBulkWrite($collection, $bulkWrite);

// Check if the delete operation was successful
if ($result->getDeletedCount() > 0) {
    header('location:adminpage_dokter.php');
}
?>