<?php
include("connection.php");
session_start();

if (!isset($_SESSION['us_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href = '../html/login.html';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['purchase_id'])) {
    $purchase_id = intval($_POST['purchase_id']);
    $user_id = $_SESSION['us_id'];

    // Check if the order belongs to the user and is not already delivered
    $checkQuery = "SELECT product_id, quantity, order_status FROM purchases WHERE id = '$purchase_id' AND user_id = '$user_id'";
    $result = $con->query($checkQuery);
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        $product_id = $order['product_id'];
        $quantity = $order['quantity'];

        if ($order['order_status'] !== 'Delivered') {
            // Delete the order from the table
            $deleteQuery = "DELETE FROM purchases WHERE id = '$purchase_id'";
            if ($con->query($deleteQuery) === TRUE) {
                // Update product stock
                $updateStockQuery = "UPDATE product SET P_QUENTITY = P_QUENTITY + $quantity WHERE ID = '$product_id'";
                $con->query($updateStockQuery);

                echo "<script>alert('Order cancelled successfully and stock updated!'); window.location.href = 'viewpurchase.php';</script>";
            } else {
                echo "<script>alert('Failed to cancel order. Please try again.'); window.location.href = 'viewpurchase.php';</script>";
            }
        } else {
            echo "<script>alert('Delivered orders cannot be cancelled.'); window.location.href = 'viewpurchase.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid order.'); window.location.href = 'viewpurchase.php';</script>";
    }
}
?>
