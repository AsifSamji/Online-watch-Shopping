<?php
include 'connection.php';
include 'header.php';
include 'herder2.php';
$filter_query = "SELECT * FROM product WHERE 1";

// Get filters from URL
if (!empty($_GET['ram'])) {
    $ram = $_GET['ram'];
    $filter_query .= " AND P_RAM = '$ram'";
}

if (!empty($_GET['rom'])) {
    $rom = $_GET['rom'];
    $filter_query .= " AND P_ROM = '$rom'";
}

if (!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
    $min_price = (int) $_GET['min_price'];
    $max_price = (int) $_GET['max_price'];
    $filter_query .= " AND (P_PRICE - (P_PRICE * (P_DISCOUNT / 100))) BETWEEN $min_price AND $max_price";
}

// Sorting Logic
$order_clause = "";

if (!empty($_GET['price_sort'])) {
    // If price sorting is selected (low_to_high or high_to_low)
    $order_clause = " ORDER BY P_PRICE " . ($_GET['price_sort'] == 'low_to_high' ? 'ASC' : 'DESC');
}

if (!empty($_GET['name_sort'])) {
    // If name sorting is selected (asc or desc)
    if ($order_clause == "") {
        $order_clause = " ORDER BY P_NAME " . ($_GET['name_sort'] == 'asc' ? 'ASC' : 'DESC');
    } else {
        // Append name sorting after price sorting if price sorting is also applied
        $order_clause .= ", P_NAME " . ($_GET['name_sort'] == 'asc' ? 'ASC' : 'DESC');
    }
}

// Apply order clause
$filter_query .= $order_clause;

// Debugging Output (Check in browser)


// Execute the query
$data = mysqli_query($con, $filter_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Products</title>
    <link rel="stylesheet" href="../css/homepagestyle.css">

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
  <style>
        .price-range {
            width: 100%;
            margin: 10px 0;
        }
    </style>
</head>
<body>

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

       

        <label>Price Range: <span id="price-display">0 - 200000</span></label>
            <input type="range" class="price-range" name="max_price" id="max-price" min="0" max="200000" value="200000" step="1000" oninput="updatePrice()">
            <input type="range" class="price-range" name="min_price" id="min-price" min="0" max="200000" value="0" step="1000" oninput="updatePrice()">
            <input type="hidden" name="max_price_hidden" id="max-price-hidden">
            <input type="hidden" name="min_price_hidden" id="min-price-hidden">


        <!-- Apply Filter Button -->
        <button type="submit">Apply Filter</button>
        <a href="homepage.php"><button type="clear">clear</button></a>
    </form>
</div>

    <h2>Filtered Products</h2>
    <div class="container">
        <?php
        include 'connection.php';
      
    
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
</body>
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
</html>
