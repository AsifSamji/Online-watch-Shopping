<?php
include("connection.php");
include("header.php");

if (!isset($_SESSION['us_id'])) {
    echo "<script>
    window.location.href = '../html/login.html';
    </script>";
    exit();
}

$user_id = $_SESSION['us_id'];
$query = "SELECT product.* FROM wishlist INNER JOIN product ON wishlist.product_id = product.ID WHERE wishlist.user_id = '$user_id'";
$data = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="../css/wishlist.css">
</head>
<body>

<center><h2 class="cart-heading">My Wishlist</h2></center>

<?php if (mysqli_num_rows($data) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Add to Cart</th>
                <th>Remove from Wishlist</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $serial = 1;
            while ($row = mysqli_fetch_array($data)) {
                $product_image = "../admin/product/{$row['P_IMAGE']}";
            ?>
            <tr>
                <td><?= $serial++; ?></td>
                <td><img src="<?= $product_image; ?>" alt="<?= $row['P_NAME']; ?>" width="100" height="100"></td>
                <td><?= $row['P_NAME']; ?></td>
                <td>Rs: <?= $row['P_DISCOUNTED_PRICE']; ?></td>
                <td>
                    <form action="addcart.php" method="POST">
                        <input type="hidden" value="1" name="p_quentity">
                        <input type="hidden" value="<?= $row['P_PRICE']; ?>" name="p_price">
                        <input type="hidden" value="<?= $row['ID']; ?>" name="product_id">
                        <input type="submit" class="btn" value="Add to Cart" name="cart">
                    </form>
                </td>
                <td>
                    <form action="remove_wishlist.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $row['ID']; ?>">
                        <input type="submit" class="btn" value="Remove from Wishlist" name="remove_wishlist">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="homepage.php" class="continue-shopping">← Continue Shopping</a>

<?php else: ?>
    <div class="empty-cart-container">
        <p class="empty-cart">Your wishlist is empty.</p>
        <a href="homepage.php" class="continue-shopping">← Continue Shopping</a>
    </div>
<?php endif; ?>

<?php include 'footer.php'; ?>
</body>
</html>
