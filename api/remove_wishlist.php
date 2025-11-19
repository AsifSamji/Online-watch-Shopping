<?php
session_start();
include("connection.php");

if (!isset($_SESSION['us_id'])) {
    header("Location: ../html/login.html");
    exit();
}

$user_id = $_SESSION['us_id'];
$product_id = $_POST['product_id'];

// Remove the product from wishlist
$delete_query = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
if ($con->query($delete_query) === TRUE) {
    echo "<script>
            alert('Product removed from Wishlist');
            window.location.href = 'view_wishlist.php'; // Redirect to wishlist page
          </script>";
} else {
    echo "Error: " . $con->error;
}

$con->close();
?>
