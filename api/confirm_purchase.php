<?php
session_start();
include("connection.php");

if (!isset($_SESSION['us_id'])) {
    echo "<script>window.location.href = '../html/login.html';</script>";
    exit();
}

$user_id = $_SESSION['us_id'];

// Fetch the user's registered address
$query = "SELECT address FROM registration WHERE id='$user_id'";
$result = $con->query($query);
$userData = $result->fetch_assoc();
$registered_address = $userData['address']; // Store the registered address

$cart_id = isset($_POST['cart_id']) ? $_POST['cart_id'] : null;
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : null;
$total_price = isset($_POST['total_price']) ? (float)$_POST['total_price'] : null;

if ($cart_id === null || $product_id === null || $quantity === null || $total_price === null) {
    echo "<script>alert('Error: Missing form data! Please try again.'); window.history.back();</script>";
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        textarea, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background: #218838;
        }
        @media (max-width: 600px) {
            .container {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirm Your Purchase</h2>
        <form method="POST" action="purchase.php">
            <input type="hidden" name="cart_id" value="<?= $cart_id; ?>">
            <input type="hidden" name="product_id" value="<?= $product_id; ?>">
            <input type="hidden" name="quantity" value="<?= $quantity; ?>">
            <input type="hidden" name="total_price" value="<?= $total_price; ?>">
            
            <label for="new_address">Delivery Address:</label>
            <textarea name="new_address" id="new_address" required><?= $registered_address; ?></textarea>
            
            <label for="payment_method">Select Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
            
            <button type="submit" name="purchase">Confirm Purchase</button>
        </form>
    </div>
</body>
</html>
