<?php
include("connection.php");
include("../header2.php");

if (!isset($_GET['order_id'])) {
    echo "<script>alert('Invalid request!'); window.location.href='all_purchases.php';</script>";
    exit();
}

$order_id = $_GET['order_id'];

$query = "SELECT purchases.id, registration.fname AS user_name, product.P_NAME AS product_name, 
                 purchases.quantity, purchases.price, purchases.address, purchases.purchase_date, purchases.order_status
          FROM purchases
          INNER JOIN registration ON purchases.user_id = registration.id
          INNER JOIN product ON purchases.product_id = product.ID
          WHERE purchases.id = '$order_id'";

$result = $con->query($query);
$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="http://localhost/mobile_shopping/css/purchase.css">
</head>
<body>
    <h2>Order Details</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr><th>ID</th><td><?= $order['id']; ?></td></tr>
        <tr><th>User Name</th><td><?= $order['user_name']; ?></td></tr>
        <tr><th>Product Name</th><td><?= $order['product_name']; ?></td></tr>
        <tr><th>Quantity</th><td><?= $order['quantity']; ?></td></tr>
        <tr><th>Price</th><td>Rs. <?= number_format($order['price'], 2); ?></td></tr>
        <tr><th>Address</th><td><?= $order['address']; ?></td></tr>
        <tr><th>Purchase Date</th><td><?= $order['purchase_date']; ?></td></tr>
        <tr><th>Order Status</th>
            <td>
                <form method="POST" action="update_order_status.php">
                    <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                    <select name="order_status">
                        <option value="Processing" <?= $order['order_status'] == "Processing" ? "selected" : ""; ?>>Processing</option>
                        <option value="Shipped" <?= $order['order_status'] == "Shipped" ? "selected" : ""; ?>>Shipped</option>
                        <option value="Out for Delivery" <?= $order['order_status'] == "Out for Delivery" ? "selected" : ""; ?>>Out for Delivery</option>
                        <option value="Delivered" <?= $order['order_status'] == "Delivered" ? "selected" : ""; ?>>Delivered</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>
        </tr>
    </table>
</body>
</html>
