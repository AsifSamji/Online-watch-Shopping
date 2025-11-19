<?php

session_start();
include("connection.php");

if (!isset($_SESSION['us_id'])) {
    header("Location: ../html/login.html");
    exit();
}

if (isset($_POST['product_id']) && isset($_POST['p_quentity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['p_quentity'];
    $user_id = $_SESSION['us_id'];

    // Check stock
    $stock_query = "SELECT P_QUENTITY FROM product WHERE ID = '$product_id'";
    $stock_result = $con->query($stock_query);
    $stock_row = $stock_result->fetch_assoc();
    $current_stock = $stock_row['P_QUENTITY'];

    if ($quantity > $current_stock) {
        echo "<script>
                alert('Not enough stock available.');
                window.location.href='http://localhost/mobile_shopping/api/homepage.php';
              </script>";
        exit();
    }

    // Check if product already in the cart
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Product is already in the cart.');
                window.location.href='http://localhost/mobile_shopping/api/homepage.php';
              </script>";
        exit();
    } else {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
    }

    if ($con->query($sql) === TRUE) {
        echo "<script>
                alert('Product added successfully.');
                window.location.href='http://localhost/mobile_shopping/api/homepage.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
