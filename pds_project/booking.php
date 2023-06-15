<?php
// punya brandon
// require '../vendor/autoload.php';
// punya alan
// require '../htdocs/vendor/autoload.php';


use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\BSON\Regex;

// Connection settings
$connectionString = "mongodb://localhost:27017";

// Create a manager instance
$manager = new Manager($connectionString);

// Specify the database and collection
$database = "forum_db";
$collection = "collection_db";

// Function to fetch and filter documents from the collection
function fetchFilteredDocuments($manager, $database, $collection, $filter)
{
    // Create a query object with the filter
    $query = new Query($filter);

    // Execute the query
    $cursor = $manager->executeQuery("$database.$collection", $query);

    // Fetch and return documents as an array
    return iterator_to_array($cursor);
}

// Function to fetch all documents from the collection
function fetchAllDocuments($manager, $database, $collection)
{
    // Create an empty filter to retrieve all documents
    $filter = [];

    // Create a query object with the filter
    $query = new Query($filter);

    // Execute the query
    $cursor = $manager->executeQuery("$database.$collection", $query);

    // Fetch and return documents as an array
    return iterator_to_array($cursor);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the filter values from the form
    $user = $_POST['user'];
    $thread = $_POST['thread'];
    $tags = $_POST['tags'];

    // Create regex patterns to perform partial matches on the filter values
    $userPattern = new Regex($user, 'i');
    $threadPattern = new Regex($thread, 'i');
    $tagPattern = new Regex($tags, 'i');

    // Construct the filter
    $filter = [];

    if (!empty($user)) {
        $filter['user'] = $userPattern;
    }

    if (!empty($thread)) {
        $filter['thread'] = $threadPattern;
    }

    if (!empty($tags)) {
        $filter['tags'] = ['$in' => [$tagPattern]];
    }

    // Fetch filtered documents from the collection
    $documents = fetchFilteredDocuments($manager, $database, $collection, $filter);
} elseif (isset($_POST['showAll'])) {
    // Fetch all documents from the collection
    $documents = fetchAllDocuments($manager, $database, $collection);
}

?>

<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <!-- Filter form -->
    <form method="POST">
        <!-- Show -->
        <button type="submit" name="showAll">Show all</button>
        <br><br>
        <!-- User -->
        <label for="user">User:</label>
        <input type="text" name="user" id="user" placeholder="Input user..">

        <!-- Thread -->
        <label for="thread">Thread:</label>
        <input type="text" name="thread" id="thread" placeholder="Input thread..">

        <!-- Tags -->
        <label for="tags">Tag:</label>
        <input type="text" name="tags" id="tags" placeholder="Input tags..">

        <button type="submit" name="filterData">Filter</button>

    </form>

    <!-- Display filtered documents -->
    <?php if (isset($documents)) : ?>
        <br>
        <h3>Result(s) : </h3>
        <table border='1' style='border-collapse:collapse'>
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document) :
                    foreach ($document as $property => $value) :
                        if (is_array($value)) :
                            foreach ($value as $index => $item) : ?>
                                <tr>
                                    <td><?php echo "{$property}[{$index}]"; ?></td>
                                    <td><?php echo $item; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td><?php echo $property; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                    <?php endif;
                    endforeach; ?>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>+