<?php
session_start();
include("connection.php");

if (!isset($_SESSION['us_id'])) {
    header("Location: ../html/login.html");
    exit();
}

$user_id = $_SESSION['us_id'];
$product_id = $_POST['product_id'];

// Check if the product is already in the wishlist
$check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = $con->query($check_query);

if ($result->num_rows > 0) {
    // Product is already in the wishlist, show message
    echo "<script>
            alert('Product is already in Wishlist.');
            window.location.href='homepage.php';
          </script>";
} else {
    // Add to wishlist
    $insert_query = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
    if ($con->query($insert_query) === TRUE) {
        echo "<script>
                alert('Added to Wishlist');
                window.location.href='homepage.php';
              </script>";
    } else {
        echo "<script>
                alert('Error adding to Wishlist.');
                window.location.href='homepage.php';
              </script>";
    }
}

$con->close();
?>
