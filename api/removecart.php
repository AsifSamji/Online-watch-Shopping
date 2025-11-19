<?php
session_start();
include("connection.php");

if (!isset($_SESSION['us_id'])) {
    header("Location: http://localhost/mobile_shopping/html/login.html");
    exit();
}


if (isset($_GET['cart_id'])) {
    $cart_id = intval($_GET['cart_id']); 
  
    $sql = "DELETE FROM cart WHERE id = $cart_id";

    if ($con->query($sql) === TRUE) {
       
        header("Location: http://localhost/mobile_shopping/api/viewcart.php?message=ItemRemoved");
        exit();
    } else {
        
        header("Location: http://localhost/mobile_shopping/api/viewcart.php?error=FailedToRemoveItem");
        exit();
    }
} else {
   
    header("Location: http://localhost/mobile_shopping/api/viewcart.php?error=NoCartID");
    exit();
}
?>
