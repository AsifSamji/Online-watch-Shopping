<?php
include("connection.php");
include("header.php");

if (!isset($_SESSION['us_id'])) {
    echo "<script>window.location.href = '../html/login.html';</script>";
    exit();
}

$user_id = $_SESSION['us_id'];

// Fetch purchase details
$query = "SELECT purchases.id, product.P_NAME, product.P_IMAGE, purchases.quantity, purchases.price, 
                 purchases.address, purchases.payment_method, 
                 purchases.order_status, purchases.purchase_date
          FROM purchases
          INNER JOIN product ON purchases.product_id = product.ID
          WHERE purchases.user_id = '$user_id'";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="../css/purchase.css">
    <style>
        .filter-buttons {
            text-align: center;
            margin-bottom: 20px;
        }
        .filter-btn {
            padding: 10px 20px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        .filter-btn:hover {
            background-color: #45a049;
        }
        .hidden {
            display: none;
        }
        .disabled-btn {
            background-color: #ccc !important;
            cursor: not-allowed !important;
            opacity: 0.6;
        }
        .newbtn {
        background-color: #28a745;
        color: white;
        padding: 8px 12px; /* Reduced button size */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        font-size: 14px;
        }

        .newbtn:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <center><h2 class="cart-heading">Your Purchase History</h2></center>

    <!-- Filter Buttons -->
    <div class="filter-buttons">
        <button class="filter-btn" onclick="filterOrders('all')">All</button>
        <button class="filter-btn" onclick="filterOrders('pending')">Pending Orders</button>
        <button class="filter-btn" onclick="filterOrders('Delivered')">Delivered Orders</button>
    </div>

    <table id="purchaseTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delivery Address</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Purchase Date</th>
                <th class="action-column">Action</th>
                <th class="cancel-column">Cancel</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $serial = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr class="order-row" data-status="<?= $row['order_status']; ?>">
                        <td><?= $serial++; ?></td>
                        <td><img src="../admin/product/<?= htmlspecialchars($row['P_IMAGE']); ?>" alt="Product Image" width="80"></td>
                        <td><?= htmlspecialchars($row['P_NAME']); ?></td>
                        <td><?= $row['quantity']; ?></td>
                        <td>Rs. <?= number_format($row['price'], 2); ?></td>
                        <td><?= htmlspecialchars($row['address']); ?></td>
                        <td><?= htmlspecialchars($row['payment_method']); ?></td>
                        <td><?= $row['order_status']; ?></td>
                        <td><?= $row['purchase_date']; ?></td>
                        <td class="action-column">
                        <?php if ($row['order_status'] !== 'Delivered'): ?>
                            <form method="GET" action="track_order.php">
                                <input type="hidden" name="purchase_id" value="<?= $row['id']; ?>">
                                <button type="submit" class="newbtn" <?= $row['order_status'] === 'Delivered' ? 'class="disabled-btn" disabled' : ''; ?>>Track</button>
                            </form>
                            <?php else: ?>
                                <button class="disabled-btn" disabled>Track</button>
                            <?php endif; ?>
                        </td>
                        <td class="cancel-column">
                            <?php if ($row['order_status'] !== 'Delivered'): ?>
                                <form method="POST" action="cancel_order.php" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <input type="hidden" name="purchase_id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="newbtn">Cancel</button>
                                </form>
                            <?php else: ?>
                                <button class="disabled-btn" disabled>Cancel</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No purchases found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="homepage.php" class="continue-shopping">← Continue Shopping</a>
    <?php include 'footer.php'; ?>

    <script>
    function filterOrders(status) {
        let rows = document.querySelectorAll('.order-row');
        let actionColumns = document.querySelectorAll('.action-column');
        let cancelColumns = document.querySelectorAll('.cancel-column');
        let actionHeader = document.querySelector('th.action-column');
        let cancelHeader = document.querySelector('th.cancel-column');

        rows.forEach(row => {
            let orderStatus = row.getAttribute('data-status');

            if (status === 'all') {
                row.classList.remove('hidden');
                actionHeader.style.display = 'table-cell';
                cancelHeader.style.display = 'table-cell';
                actionColumns.forEach(col => col.style.display = 'table-cell');
                cancelColumns.forEach(col => col.style.display = 'table-cell');
            } 
            else if (status === 'pending') {
                if (orderStatus === 'Processing' || orderStatus === 'Shipped' || orderStatus === 'Out for Delivery') {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
                actionHeader.style.display = 'table-cell';
                cancelHeader.style.display = 'table-cell';
                actionColumns.forEach(col => col.style.display = 'table-cell');
                cancelColumns.forEach(col => col.style.display = 'table-cell');
            } 
            else if (status === 'Delivered') {
                if (orderStatus === 'Delivered') {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
                actionHeader.style.display = 'none';
                cancelHeader.style.display = 'none';
                actionColumns.forEach(col => col.style.display = 'none');
                cancelColumns.forEach(col => col.style.display = 'none');
            }
        });
    }
    </script>

</body>
</html>
