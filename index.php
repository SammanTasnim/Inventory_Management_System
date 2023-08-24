<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
</head>
<style>
    .low-stock {
        color: red;
        font-weight: bold;
    }
</style>
<body>
    <h1>Inventory Items</h1>

    <?php
    require_once 'config.php';

    $sql = "SELECT * FROM Items";
    $result = $conn->query($sql);

    $totalValue = 0; 

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            $rowClass = "";
            if ($row['Quantity'] < 10) {
                $rowClass = "low-stock";
            }

            echo "<tr class='$rowClass'>
                    <td>{$row['ID']}</td>
                    <td>{$row['ItemName']}</td>
                    <td>{$row['Quantity']}</td>
                    <td>{$row['Price']}</td>
                </tr>";

            $totalValue += $row['Quantity'] * $row['Price'];
        }
        echo "</table>";

        echo "<p>Total Inventory Value: $" . number_format($totalValue, 2) . "</p>";
    } else {
        echo "No items in the inventory.";
    }

    $conn->close();
    ?>

    <h2>Add New Item</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="itemName">Item Name:</label>
        <input type="text" name="itemName" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required><br>

        <input type="submit" value="Add Item">
    </form>
</body>
</html>
