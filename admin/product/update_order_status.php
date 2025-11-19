<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['order_status'];

    // // Prevent the admin from setting the status to "Delivered"
    // if ($new_status === "Delivered") {
    //     echo "<script>alert('Admin cannot mark an order as Delivered!'); 
    //     window.location.href = 'pending_order_detail.php?order_id=$order_id';</script>";
    //     exit();
    // }

    // Update order status if it's not "Delivered"
    $update_status_query = "UPDATE purchases SET order_status = '$new_status' WHERE id = '$order_id'";
    $con->query($update_status_query);

    echo "<script>alert('Order status updated successfully!'); 
    window.location.href = 'http://localhost/mobile_shopping/admin/mystore.php';</script>";
}
?>
