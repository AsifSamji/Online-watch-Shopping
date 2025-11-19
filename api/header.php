<?php
session_start();
include("connection.php");

// Initialize cart and wishlist counts
$cart_count = 0;
$wishlist_count = 0;
$wishlis_count = 0;

if (isset($_SESSION['us_id'])) 
{
    // Fetch cart count for logged-in user
    $user_id = $_SESSION['us_id'];
    $cart_query = "SELECT COUNT(DISTINCT product_id) as total FROM cart WHERE user_id = '$user_id'";
    $cart_result = mysqli_query($con, $cart_query);
    
    $cart_count = 0; // Default cart count
    
    if ($cart_result) {
        $cart_row = mysqli_fetch_assoc($cart_result);
        $cart_count = (int) $cart_row['total']; // Ensure it's always an integer
    }
    

    // Fetch wishlist count for logged-in user
    $wishlist_query = "SELECT COUNT(*) as total FROM wishlist WHERE user_id = '$user_id'";
    $wishlist_result = mysqli_query($con, $wishlist_query);
    if ($wishlist_result) {
        $wishlist_row = mysqli_fetch_assoc($wishlist_result);
        $wishlist_count = $wishlist_row['total'] > 0 ? $wishlist_row['total'] : 0;
    }

     // Fetch purchases count for logged-in user
     $purchase_query = "SELECT COUNT(quantity) as total FROM purchases WHERE user_id = '$user_id'";
     $list_result = mysqli_query($con, $purchase_query);
     if ($list_result) {
         $shlist_row = mysqli_fetch_assoc($list_result);
         $wishlis_count = $shlist_row['total'] > 0 ? $shlist_row['total'] : 0;
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Mobile Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
      body {
    margin: 0;
    padding: 0;          
    overflow-x: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
}

.navbar-custom {
    background-color: #343a40;
    height: 70px;
    position: fixed;
    top: 0;
    z-index: 1000;
    padding: 0 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    
}

.search-bar {
    flex: 1;
    max-width: 500px;
    display: flex;
    align-items: center;
    margin: 0 15px;
}

.search-bar input {
    border-radius: 30px 0 0 30px;
    height: 45px;
    border: 1px solid #ced4da;
    flex: 1;
    padding: 0 15px;
}

.search-bar button {
    border-radius: 0 30px 30px 0;
    height: 45px;
    background-color: #dc3545;
    color: white;
    border: none;
    transition: background-color 0.3s;
}

.search-bar button:hover {
    background-color: #c82333;
}

.nav-link-custom {
    color: #ffffff;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
}

.nav-link-custom i {
    margin-right: 8px;
}

.nav-link-custom:hover {
    background-color: #007bff;
}

.cart-link, .wishlist-link {
    color: #ffc107;
    font-weight: bold;
    display: flex;
    align-items: center;
    text-decoration: none;
}

.cart-link i, .wishlist-link i {
    margin-right: 5px;
}

.user-greeting {
    color: white;
    font-weight: bold;
    margin-right: 15px;
}

/* Tablet and below */
@media (max-width: 768px) {
    .navbar-custom {
        flex-direction: column;
        align-items: center;
        height: auto;
        padding: 10px;
        text-align: center;
    }

    .search-bar {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        gap: 8px;
        margin-top: 10px;
    }

    .search-bar input {
        flex: 1;
        min-width: 60%;
        max-width: 80%;
        padding: 8px;
        border-radius: 20px;
    }

    .search-bar button {
        padding: 8px 15px;
        border-radius: 20px;
    }

    .nav-link-custom {
        font-size: 14px;
        padding: 6px 10px;
        display: inline-block;
        margin: 4px 0;
    }

    .cart-link, .wishlist-link {
        font-size: 13px;
        margin: 5px 0;
    }

    .user-greeting {
        font-size: 14px;
        margin-bottom: 5px;
    }
}

/* Mobile phones like 320x650 */
@media (max-width: 480px) {
    .navbar-custom {
        padding: 8px;
    }

    .search-bar {
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .search-bar input {
        width: 90%;
        padding: 8px;
        border-radius: 20px;
        margin-bottom: 5px;
    }

    .search-bar button {
        width: 90%;
        padding: 8px;
        border-radius: 20px;
    }

    .nav-link-custom {
        font-size: 12px;
        padding: 5px 8px;
        display: block;
        width: 100%;
        text-align: center;
    }

    .cart-link, .wishlist-link {
        font-size: 11px;
        display: block;
        margin: 4px 0;
    }

    .user-greeting {
        font-size: 12px;
        margin-bottom: 5px;
        display: block;
    }
}


        
    </style>
</head>
<body>

<!-- First Sticky Navbar -->
<nav class="navbar navbar-custom">
    <div>
        <a class="navbar-brand text-white" href="http://localhost/mobile_shopping/api/main.php">
            <i class="fas fa-store"></i> Online Mobile Shopping
        </a>
    </div>

    <!-- Search Bar -->
    <form class="search-bar d-flex" action="search.php" method="GET">
        <input class="form-control" type="search" placeholder="Search products..." name="search">
        <button class="btnn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- Right Side Links -->
    <div class="d-flex align-items-center">
        <a href="http://localhost/mobile_shopping/api/viewcart.php" class="cart-link me-3">
            <i class="fas fa-shopping-cart"></i>
            Cart(<?php echo $cart_count; ?>)
        </a>
        <a href="http://localhost/mobile_shopping/api/view_wishlist.php" class="wishlist-link me-3">
            <i class="fas fa-heart"></i>
            Wishlist(<?php echo $wishlist_count; ?>)
        </a>
        <a href="http://localhost/mobile_shopping/api/viewpurchase.php" class="wishlist-link me-3">
            <i class="fas fa-box"></i>
            Purchase(<?php echo $wishlis_count; ?>)
        </a>
      
        <?php if (!isset($_SESSION['us'])): ?>
            <a href="http://localhost/mobile_shopping/html/login.html" class="nav-link-custom me-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        <?php else: ?>
            <a href="http://localhost/mobile_shopping/api/logout.php" class="nav-link-custom me-2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        <?php endif; ?>
        <a href="http://localhost/mobile_shopping/api/myprofile.php" class="nav-link-custom me-2">
        <i class="fas fa-user-circle"></i> My Profile
        </a>
        <a href="http://localhost/mobile_shopping/admin/adminlogin.php" class="nav-link-custom me-2">
            <i class="fas fa-user-shield"></i> Admin
        </a>
    </div>
</nav>
<br>
<br>
<br>

</body>
</html>