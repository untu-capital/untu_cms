<?php
// Get the JSON data from the hidden input field
$jsonData = $_POST['objectList'];

// Decode the JSON data into a PHP array
$objectList = json_decode($jsonData, true);

// Now you can use $objectList in your PHP code
// For example, you can loop through the objects and do something with them
foreach ($objectList as $object) {
    // Do something with each object
    // For example:
    echo "ID: " . $object['id'] . ", Comment: " . $object['comment'] . ", Approval Status: " . $object['approvalStatus'] . "<br>";
}
?>
