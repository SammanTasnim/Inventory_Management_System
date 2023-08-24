<?php
require_once 'config.php';

header('Content-Type: application/json');
$sql = "SELECT * FROM Items";
$result = $conn->query($sql);

$items = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = array(
            'ID' => $row['ID'],
            'ItemName' => $row['ItemName'],
            'Quantity' => $row['Quantity'],
            'Price' => $row['Price']
        );
    }
}

$conn->close();

echo json_encode($items);
?>
