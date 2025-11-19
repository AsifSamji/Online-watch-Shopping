<?php
include("connection.php");
include("../header2.php");

$date_filter = isset($_GET['date']) ? $_GET['date'] : '';

$query_pending = "SELECT purchases.id, registration.fname AS user_name, product.P_NAME AS product_name, 
                          purchases.quantity, purchases.price, purchases.address, purchases.purchase_date, purchases.order_status
                   FROM purchases
                   INNER JOIN registration ON purchases.user_id = registration.id
                   INNER JOIN product ON purchases.product_id = product.ID
                   WHERE purchases.order_status NOT IN ('Delivered')";

if (!empty($date_filter)) {
    $date_parts = explode('-', $date_filter);
    $year = $date_parts[0] ?? '';
    $month = $date_parts[1] ?? '';
    $day = $date_parts[2] ?? '';
    
    if ($year !== '00' && !empty($year)) {
        $query_pending .= " AND YEAR(purchases.purchase_date) = '$year'";
    }
    if ($month !== '00' && !empty($month)) {
        $query_pending .= " AND MONTH(purchases.purchase_date) = '$month'";
    }
    if ($day !== '00' && !empty($day)) {
        $query_pending .= " AND DAY(purchases.purchase_date) = '$day'";
    }
}

$result_pending = $con->query($query_pending);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="http://localhost/mobile_shopping/css/purchase.css">
    <style>
        .search-container {
            text-align: right;
            margin-bottom: 20px;
        }
        input[type="text"], button {
            padding: 8px;
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Pending Orders</h2>
    
    <div class="search-container">
        <form method="GET" action="">
            <label for="date">Search by Date (YYYY-MM-DD or 00 for wildcard):</label>
            <input type="text" id="date" name="date" value="<?= $date_filter; ?>" placeholder="YYYY-MM-DD">
            <button type="submit">Search</button>
        </form>
    </div>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
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
            <?php while ($row = $result_pending->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['user_name']; ?></td>
                    <td><?= $row['product_name']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td>Rs. <?= number_format($row['price'], 2); ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['purchase_date']; ?></td>
                    <td><?= $row['order_status']; ?></td>
                    <td>
                        <form method="GET" action="pending_order_detail.php">
                            <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                            <button type="submit">Details</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>