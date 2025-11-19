<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <?php include 'header.php'; ?>
    <?php include 'herder2.php'; ?>
    <link rel="stylesheet" href="../css/homepagestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function goToProductDetail(productId) {
            window.location.href = "product_detail.php?id=" + productId;
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.no-click').forEach(function (element) {
                element.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <?php
        include 'connection.php';

        $search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

        if ($search_term != '') {
            $query = "SELECT * FROM product WHERE P_NAME LIKE '%$search_term%'";
            $data = mysqli_query($con, $query);
            $user_id = isset($_SESSION['us_id']) ? $_SESSION['us_id'] : null;

            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $stock = $row['P_QUENTITY'];
                    $button_disabled = $stock == 0 ? 'disabled' : '';
                    
                    $original_price = $row['P_PRICE'];
                    $discount = $row['P_DISCOUNT'];
                    $discounted_price = $original_price - ($original_price * ($discount / 100));
                    
                    $wishlist_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '{$row['ID']}'";
                    $wishlist_result = mysqli_query($con, $wishlist_query);
                    $is_wishlisted = mysqli_num_rows($wishlist_result) > 0;

                    echo "
                    <div class='card " . ($stock == 0 ? "disabled-card" : "") . "' onclick='goToProductDetail({$row['ID']})'>
                        <div class='card-image no-click'>
                            <img src='../admin/product/{$row['P_IMAGE']}' alt='{$row['P_NAME']}' class='no-click'>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title no-click'>{$row['P_NAME']}</h5>
                            " . ($discount > 0 ? "
                            <div class='price-row'>
                                <div class='discount-badge no-click'>{$discount}% OFF</div>
                                <span class='original-price no-click'>Rs: " . number_format($original_price, 2) . "</span>
                            </div>
                            " : "") . "
                            <form action='http://localhost/mobile_shopping/api/addcart.php' method='POST' class='cart-form'>
                                <div class='quantity-price-container'>
                                    <input type='number' name='p_quentity' class='quantity-input no-click' min='1' max='{$stock}' value='1' required " . ($stock == 0 ? "disabled" : "") . ">
                                    <span class='discounted-price no-click'>Rs: " . number_format($discounted_price, 2) . "</span>
                                </div>
                                <input type='hidden' value='{$discounted_price}' name='p_price'>
                                <input type='hidden' value='../admin/product/{$row['P_IMAGE']}' name='image'>
                                <input type='hidden' value='{$row['ID']}' name='product_id'>
                                <div class='button-container'>
                                    <button type='submit' class='btn' name='cart' " . ($stock == 0 ? "disabled" : "") . ">Add to Cart</button>
                                    <button type='submit' class='wishlist-btn' name='wishlist' form='wishlist-form-{$row['ID']}' " . ($stock == 0 ? "disabled" : "") . ">
                                        <i class='fa " . ($is_wishlisted ? "fa-heart wishlisted" : "fa-heart-o") . "'></i>
                                    </button>
                                </div>
                            </form>
                            <form action='addwishlist.php' method='POST' id='wishlist-form-{$row['ID']}' class='wishlist-form'>
                                <input type='hidden' name='product_id' value='{$row['ID']}'>
                            </form>
                            " . ($stock == 0 ? "<div class='out-of-stock'>Out of Stock</div>" : "") . "
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<div class='alert alert-info'>No products found for '$search_term'</div>";
            }
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>