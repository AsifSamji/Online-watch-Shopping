<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Page</title>
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
                    event.stopPropagation(); // Prevent redirect when clicking these elements
                });
            });
        });
    </script>
    <script>
      function updatePrice() {
    let minPrice = parseInt(document.getElementById("min-price").value);
    let maxPrice = parseInt(document.getElementById("max-price").value);

    // Ensure maxPrice does not go below minPrice
    if (maxPrice < minPrice) {
        maxPrice = minPrice;
        document.getElementById("max-price").value = maxPrice;
    }

    document.getElementById("price-display").textContent = minPrice + " - " + maxPrice;

    // Update hidden inputs for form submission
    document.getElementById("min-price-hidden").value = minPrice;
    document.getElementById("max-price-hidden").value = maxPrice;
}

// Prevent max slider from going below min slider dynamically
document.getElementById("min-price").addEventListener("input", function () {
    let minValue = parseInt(this.value);
    let maxInput = document.getElementById("max-price");

    if (parseInt(maxInput.value) < minValue) {
        maxInput.value = minValue;
    }
    updatePrice();
});

document.getElementById("max-price").addEventListener("input", function () {
    let maxValue = parseInt(this.value);
    let minInput = document.getElementById("min-price");

    if (parseInt(minInput.value) > maxValue) {
        minInput.value = maxValue;
    }
    updatePrice();
});

        </script>
             <style>
        .price-range {
            width: 100%;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <br><br>
    <!-- Filter Sidebar -->
<div id="filter-sidebar" class="filter-sidebar">
    <h3>Filters</h3>
    <form action="filter.php" method="GET">
        <!-- RAM Filter -->
        <label>RAM:</label>
        <select name="ram">
            <option value="">Select</option>
            <option value="4">4GB</option>
            <option value="6">6GB</option>
            <option value="8">8GB</option>
            <option value="12">12GB</option>
            <option value="16">16GB</option>
        </select>

        <!-- ROM Filter -->
        <label>ROM:</label>
        <select name="rom">
            <option value="">Select</option>
            <option value="64">64GB</option>
            <option value="128">128GB</option>
            <option value="256">256GB</option>
            <option value="512">512GB</option>
            <option value="1TB">1TB</option>
        </select>

        <!-- Name Sorting -->
        <label>Sort by Name:</label>
        <select name="name_sort">
            <option value="">Select</option>
            <option value="asc">A to Z</option>
            <option value="desc">Z to A</option>
        </select>

        <!-- Price Sorting -->
        <label>Sort by Price:</label>
        <select name="price_sort">
            <option value="">Select</option>
            <option value="low_to_high">Low to High</option>
            <option value="high_to_low">High to Low</option>
        </select>

        <label>Price Range: <span id="price-display">0 - 200000</span></label>
<input type="range" class="price-range" name="min_price" id="min-price" min="0" max="200000" value="0" step="1000" oninput="updatePrice()">
<input type="range" class="price-range" name="max_price" id="max-price" min="0" max="200000" value="200000" step="1000" oninput="updatePrice()">
<input type="hidden" name="min_price_hidden" id="min-price-hidden">
<input type="hidden" name="max_price_hidden" id="max-price-hidden">


        <!-- Apply Filter Button -->
        <button type="submit">Apply Filter</button>
    </form>
</div>

    <div class="container">
        <?php
        include 'connection.php';
        $query = "SELECT * FROM product where P_COMPANY = 'vivo'";
        $data = mysqli_query($con, $query);
        $user_id = isset($_SESSION['us_id']) ? $_SESSION['us_id'] : null;

        while ($row = mysqli_fetch_array($data)) {
            $stock = $row['P_QUENTITY'];
            $is_out_of_stock = $stock == 0 ? 'style="pointer-events: none; opacity: 0.5;"' : '';
            $button_disabled = $stock == 0 ? 'disabled' : '';

            // Calculate Discount Price
            $original_price = $row['P_PRICE'];
            $discount = $row['P_DISCOUNT'];
            $discounted_price = $original_price - ($original_price * ($discount / 100));

            // Check if product is in wishlist
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
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    let sidebar = document.getElementById("filter-sidebar");

    document.addEventListener("mousemove", function (event) {
        if (event.clientX < 50) {
            sidebar.style.left = "0"; // Show sidebar when cursor is on the left
        }
    });

    sidebar.addEventListener("mouseleave", function () {
        sidebar.style.left = "-250px"; // Hide sidebar when mouse leaves
    });
});
</script>

</body>
</html>
