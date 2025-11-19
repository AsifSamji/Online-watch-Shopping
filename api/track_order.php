<?php
include("connection.php");
include("header.php");

if (!isset($_SESSION['us_id'])) {
    echo "<script>window.location.href = '../html/login.html';</script>";
    exit();
}

if (!isset($_GET['purchase_id'])) {
    echo "<script>alert('Invalid request!'); window.location.href = 'viewpurchase.php';</script>";
    exit();
}

$purchase_id = $_GET['purchase_id'];
$user_id = $_SESSION['us_id'];

$query = "SELECT purchases.id, product.P_NAME, product.P_IMAGE, purchases.quantity, purchases.price, 
                 purchases.address, purchases.payment_method, 
                 purchases.order_status, purchases.purchase_date
          FROM purchases
          INNER JOIN product ON purchases.product_id = product.ID
          WHERE purchases.id = '$purchase_id' AND purchases.user_id = '$user_id'";

$result = $con->query($query);

if ($result->num_rows == 0) {
    echo "<script>alert('Order not found!'); window.location.href = 'viewpurchase.php';</script>";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order</title>
    <style>

        .body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0px;
            text-align: center;
        }

        .body h2, h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .body .product-image {
            width: 150px;
            height: 150px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .body table {
            width: 90%;
            max-width: 600px;
            margin: 15px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .body th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .body th {
            text-align: left;
            background: #007bff;
            color: #fff;
        }

        .body td {
            text-align: center;
        }

        .body .order-tracking {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .body .order-step {
            text-align: center;
            min-width: 120px;
        }

        .body .order-step img {
            width: 80px;
            height: 80px;
            transition: transform 0.3s ease-in-out;
        }

        .body .order-step.completed img {
            transform: scale(1.1);
            filter: drop-shadow(0 0 10px rgba(0, 123, 255, 0.5));
        }

        .body .arrow {
            font-size: 30px;
            font-weight: bold;
            color: #007bff;
            transition: all 0.3s ease-in-out;
        }

        .body .pending {
            opacity: 0.4;
        }

        .body button {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }

        .body button:hover {
            background: #218838;
        }

        .body a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .body a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .body table {
                width: 100%;
            }
            .body .order-tracking {
                flex-direction: column;
            }
            .body .arrow {
                transform: rotate(90deg);
            }
        }

    </style>
</head>
<body>
    <div class="body">
    <h2>Track Your Order</h2>

    <img src="../admin/product/<?= htmlspecialchars($row['P_IMAGE']); ?>" alt="Product Image" class="product-image">

    <table>
        <tr>
            <th>Product Name</th>
            <td><?= htmlspecialchars($row['P_NAME']); ?></td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td><?= $row['quantity']; ?></td>
        </tr>
        <tr>
            <th>Price</th>
            <td>Rs. <?= number_format($row['price'], 2); ?></td>
        </tr>
        <tr>
            <th>Delivery Address</th>
            <td><?= htmlspecialchars($row['address']); ?></td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td><?= htmlspecialchars($row['payment_method']); ?></td>
        </tr>
        <tr>
            <th>Purchase Date</th>
            <td><?= $row['purchase_date']; ?></td>
        </tr>
    </table>

    <h3>Order Progress</h3>
    <div class="order-tracking">
        <?php
        $status = $row['order_status'];
        ?>

        <div class="order-step <?= ($status == 'Processing' || $status == 'Shipped' || $status == 'Out for Delivery') ? 'completed' : 'pending'; ?>">
            <img src="images/processing.png" alt="Processing">
            <p>Processing</p>
        </div>

        <span class="arrow <?= ($status == 'Shipped' || $status == 'Out for Delivery') ? '' : 'pending'; ?>">→</span>
        
        <div class="order-step <?= ($status == 'Shipped' || $status == 'Out for Delivery') ? 'completed' : 'pending'; ?>">
            <img src="images/shipping.png" alt="Shipped">
            <p>Shipped</p>
        </div>

        <span class="arrow <?= ($status == 'Out for Delivery') ? '' : 'pending'; ?>">→</span>

        <div class="order-step <?= ($status == 'Out for Delivery') ? 'completed' : 'pending'; ?>">
            <img src="images/out.jpeg" alt="Out for Delivery">
            <p>Out for Delivery</p>
        </div>
    </div>

    <br>

    <br>
    <a href="viewpurchase.php">Back to Orders</a>

    <?php include 'footer.php'; ?>
    </div>
</body>
</html>
