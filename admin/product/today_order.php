<?php
include("connection.php");
include("../header2.php");

// Fetch today's orders with product images
$query_today = "SELECT purchases.id, registration.fname AS user_name, product.P_NAME AS product_name, 
                       product.P_IMAGE AS product_image, purchases.quantity, purchases.price, 
                       purchases.address, purchases.purchase_date, purchases.order_status
                FROM purchases
                INNER JOIN registration ON purchases.user_id = registration.id
                INNER JOIN product ON purchases.product_id = product.ID
                WHERE DATE(purchases.purchase_date) = CURDATE()";

$result_today = $con->query($query_today);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="http://localhost/mobile_shopping/css/purchase.css">
</head>
<body>
   
    <h2>Today's Orders</h2>
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
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_today->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['user_name']; ?></td>
                    <td>
                        <img src="../product/<?= $row['product_image']; ?>" alt="<?= $row['product_name']; ?>" width="80" height="80">
                    </td>
                    <td><?= $row['product_name']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td>Rs. <?= number_format($row['price'], 2); ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['purchase_date']; ?></td>
                    <td><?= $row['order_status']; ?></td>
                    <td>
                        <form method="GET" action="pending_order_detail.php">
                            <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                            <button type="submit" <?= ($row['order_status'] === 'Delivered') ? 'disabled' : ''; ?>>Details</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
