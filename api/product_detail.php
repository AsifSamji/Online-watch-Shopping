<?php
include 'connection.php';
include 'header.php';
include 'header3.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM product WHERE ID = '$product_id'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);
}

$user_id = isset($_SESSION['us_id']) ? $_SESSION['us_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['P_NAME']; ?> - Product Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .left img {
            width: 100%;
            max-width: 450px;
            border-radius: 10px;
        }
        .right {
            flex: 1;
            max-width: 500px;
        }
        .original-price {
            text-decoration: line-through;
            color: gray;
            font-size: 18px;
        }
        .discounted-price {
            color: red;
            font-size: 22px;
            font-weight: bold;
        }
        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .btn {
            padding: 12px 18px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #0056b3;
        }
        .wishlist-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 22px;
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="product-detail">
        <div class="left">
            <img src="../admin/product/<?php echo $product['P_IMAGE']; ?>" alt="<?php echo $product['P_NAME']; ?>">
        </div>
        <div class="right">
            <h2><?php echo $product['P_NAME']; ?></h2>
            <p><strong><i class="fa fa-industry"></i> Company:</strong> <?php echo $product['P_COMPANY']; ?></p>
            <p><strong><i class="fa fa-tags"></i> Price:</strong> 
                <?php if ($product['P_DISCOUNT'] > 0) { ?>
                    <span class="original-price">Rs. <?php echo number_format($product['P_PRICE'], 2); ?></span>
                    <p><strong><i class="fa fa-percent"></i> Discounted Price:</strong> 
                        <span class="discounted-price">Rs. <?php echo number_format($product['P_DISCOUNTED_PRICE'], 2); ?></span>
                    </p>
                <?php } else { ?>
                    <span class="discounted-price">Rs. <?php echo number_format($product['P_PRICE'], 2); ?></span>
                <?php } ?>
            </p>
            <p><strong><i class="fa fa-cubes"></i> Stock:</strong> <?php echo ($product['P_QUENTITY'] > 0) ? $product['P_QUENTITY'] . " Available" : "<span style='color: red;'>Out of Stock</span>"; ?></p>
            <p><strong><i class="fa fa-info-circle"></i> Specifications:</strong></p>
            <ul style="list-style: none; padding: 0;">
                <li><i class="fa fa-microchip"></i> <strong>RAM:</strong> <?php echo $product['P_RAM']; ?></li>
                <li><i class="fa fa-hdd"></i> <strong>ROM:</strong> <?php echo $product['P_ROM']; ?></li>
                <li><i class="fa fa-paint-brush"></i> <strong>Color:</strong> <?php echo $product['P_COLOR']; ?></li>
                <li><i class="fa fa-desktop"></i> <strong>Display:</strong> <?php echo $product['P_DISPLAY']; ?></li>
                <li><i class="fa fa-battery-three-quarters"></i> <strong>Battery:</strong> <?php echo $product['P_BATTERY']; ?></li>
                <li><i class="fa fa-microchip"></i> <strong>Processor:</strong> <?php echo $product['P_PROCESSOR']; ?></li>
                <li><i class="fa fa-camera"></i> <strong>Camera:</strong> <?php echo $product['P_CAMERA']; ?></li>
            </ul>
            <div class="button-container">
            <?php
                // Fetch product stock from the database
                $product_id = $product['ID'];
                $stock_query = "SELECT P_QUENTITY FROM product WHERE ID = $product_id";
                $stock_result = $con->query($stock_query);
                $stock_row = $stock_result->fetch_assoc();
                $max_stock = $stock_row['P_QUENTITY'];
            ?>

                <form action="addcart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <strong><i class="fa fa-cubes"></i> Quantity :</strong>  <input type="number" name="p_quentity" value="1" min="1" max="<?php echo $max_stock; ?>"> <br><br>
                    <button type="submit" class="btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </form>


                <form action="addwishlist.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>"><br><br><br>
                    <button type="submit" class="wishlist-btn"><i class="fa fa-heart-o"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
  .slider {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding: 10px 0;
    scroll-snap-type: x mandatory;
    white-space: nowrap;
}

.slider::-webkit-scrollbar {
    display: none;
}

.product-card {
    width: 300px; /* Wider */
    height: 450px; /* Shorter */
    text-align: center;
    background: white;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    flex: 0 0 auto;
    scroll-snap-align: center;
}

.product-card img {
    width: 100%;
    height: 250px; /* Smaller height */
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: scale(1.05);
}

.product-card img:hover {
    transform: scale(1.1);
}

</style>

<!-- Discounted Products -->
<h3>Discounted Products</h3>
<div class="slider">
    <?php
    $discounted_query = "SELECT * FROM product WHERE P_DISCOUNT > 0";
    $discounted_data = mysqli_query($con, $discounted_query);

    while ($row = mysqli_fetch_array($discounted_data)) {
        echo "
            <div class='product-card' onclick='showProductDetails({$row['ID']})'>
                <img src='../admin/product/{$row['P_IMAGE']}' alt='{$row['P_NAME']}'>
                <h4>{$row['P_NAME']}</h4>
                <p class='original-price'>Rs. " . number_format($row['P_PRICE'], 2) . "</p>
                <p class='discounted-price'>Rs. " . number_format($row['P_DISCOUNTED_PRICE'], 2) . "</p>
                <form action='addcart.php' method='POST'>
                    <input type='hidden' name='product_id' value='{$row['ID']}'>
                    <input type='hidden' name='p_quentity' value='1'>
                    <button type='submit' class='btn'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
                </form>
            </div>
        ";
    }
    ?>
</div>

<!-- All Products -->
<h3>Products</h3>
<div class="slider">
    <?php
    $product_query = "SELECT * FROM product WHERE P_DISCOUNT = 0";
    $product_data = mysqli_query($con, $product_query);

    while ($row = mysqli_fetch_array($product_data)) {
        echo "
            <div class='product-card' onclick='showProductDetails({$row['ID']})'>
                <img src='../admin/product/{$row['P_IMAGE']}' alt='{$row['P_NAME']}'>
                <h4>{$row['P_NAME']}</h4>
                <p class='discounted-price'>Rs. " . number_format($row['P_PRICE'], 2) . "</p>
                <form action='addcart.php' method='POST'>
                    <input type='hidden' name='product_id' value='{$row['ID']}'>
                    <input type='hidden' name='p_quentity' value='1'>
                    <button type='submit' class='btn'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
                </form>
            </div>
        ";
    }
    ?>
</div>

<script>
    function showProductDetails(productId) {
        window.location.href = "product_detail.php?id=" + productId;
    }
</script>



<?php include 'footer.php'; ?>
</body>
</html>
