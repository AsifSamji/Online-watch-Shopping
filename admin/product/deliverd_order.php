<?php
include("connection.php");
include("../header2.php");

$date_filter = isset($_GET['date']) ? $_GET['date'] : '';

$query = "SELECT purchases.id, registration.fname AS user_name, product.P_NAME AS product_name, product.P_IMAGE AS product_image,
                 purchases.quantity, purchases.price, purchases.address, purchases.purchase_date
          FROM purchases
          INNER JOIN registration ON purchases.user_id = registration.id
          INNER JOIN product ON purchases.product_id = product.ID
          WHERE purchases.order_status = 'Delivered'";

if (!empty($date_filter)) {
    $query .= " AND DATE(purchases.purchase_date) = '$date_filter'";
}

$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivered Orders</title>
    <link rel="stylesheet" href="http://localhost/mobile_shopping/css/purchase.css">
    <style>
        .search-container {
            text-align: right;
            margin-bottom: 20px;
        }
        input[type="date"], button {
            padding: 8px;
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Delivered Orders</h2>
    
    <div class="search-container">
        <form method="GET" action="">
            <label for="date">Search by Date:</label>
            <input type="date" id="date" name="date" value="<?= $date_filter; ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Address</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['user_name']; ?></td>
                    
                    <td><?= $row['product_name']; ?></td>
                    <td>
                        <img src="../product/<?= $row['product_image']; ?>" alt="<?= $row['product_name']; ?>" width="80" height="80">
                    </td>
                    <td><?= $row['quantity']; ?></td>
                    <td>Rs. <?= number_format($row['price'], 2); ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['purchase_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
