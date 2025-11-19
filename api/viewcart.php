<?php
include("connection.php");
include("header.php");

if (!isset($_SESSION['us_id'])) {
    echo "<script>window.location.href = '../html/login.html';</script>";
    exit();
}

$user_id = $_SESSION['us_id'];

// Update quantity if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $cart_id = intval($_POST['cart_id']);
    $action = $_POST['action'];

    // Fetch current quantity and stock
    $query = "SELECT cart.quantity AS cart_quantity, product.P_QUENTITY AS stock 
              FROM cart 
              INNER JOIN product ON cart.product_id = product.ID 
              WHERE cart.id = $cart_id";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_quantity = intval($row['cart_quantity']);
        $stock = intval($row['stock']);

        if ($action === 'increment' && $current_quantity < $stock) {
            $new_quantity = $current_quantity + 1;
        } elseif ($action === 'decrement' && $current_quantity > 1) {
            $new_quantity = $current_quantity - 1;
        } else {
            $new_quantity = $current_quantity;
        }

        // Update quantity in the database
        $con->query("UPDATE cart SET quantity = $new_quantity WHERE id = $cart_id");
    }
}

// Fetch cart items
$sql = "SELECT cart.id AS cart_id, product.id AS product_id, product.P_NAME AS name, 
        cart.quantity, product.P_DISCOUNTED_PRICE AS price, product.P_IMAGE AS image, 
        product.P_QUENTITY AS stock 
        FROM cart 
        INNER JOIN product ON cart.product_id = product.id
        WHERE cart.user_id = '$user_id'";

$result = $con->query($sql);
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/viewcart.css">
    <style>
      .newbtn {
    background-color: #28a745;
    color: white;
    padding: 8px 12px; /* Reduced button size */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-transform: uppercase;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
    display: inline-block;
    font-size: 14px;
    text-decoration: none;
    }

    .newbtn:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    }
    </style>
</head>
<body>

<div class="cart-container">
    <center><h2>Your Shopping Cart</h2></center>

    <?php if ($result->num_rows > 0): ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price (Per Unit)</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th>Purchase</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $serial = 1; 
                while ($row = $result->fetch_assoc()): 
                    $product_id = $row['product_id'];
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    $stock = $row['stock'];
                    $total_price += $quantity * $price;
                ?>
                <tr>
                    <td><?= $serial++; ?></td>
                    <td><img src="../admin/product/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>"></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td>Rs. <?= number_format($price, 2); ?></td>
                    <td>
                        <div class="quantity-controls">
                            <form method="POST" action="">
                                <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                                <input type="hidden" name="action" value="decrement">
                                <button type="submit" name="update_quantity" <?= $quantity <= 1 ? 'disabled' : ''; ?>>-</button>
                            </form>
                            <span><?= $quantity; ?></span>
                            <form method="POST" action="">
                                <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                                <input type="hidden" name="action" value="increment">
                                <button type="submit" name="update_quantity" <?= $quantity >= $stock ? 'disabled' : ''; ?>>+</button>
                            </form>
                        </div>
                    </td>
                    <td>Rs. <?= number_format($quantity * $price, 2); ?></td>
                    <td><button ><a href="removecart.php?cart_id=<?= $row['cart_id']; ?>" class="newbtn">Remove</a></button></td>
                    <td>
                        <form method="POST" action="confirm_purchase.php">
                            <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                            <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
                            <input type="hidden" name="quantity" value="<?= $row['quantity']; ?>">
                            <input type="hidden" name="total_price" value="<?= $quantity * $price; ?>">
                            <button type="submit" name="purchase" class="newbtn">Purchase</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="cart-actions">
            <a href="homepage.php">← Continue Shopping</a>
            <h4 class="total-price">Total Price: Rs. <?= number_format($total_price, 2); ?></h4>
        </div>

    <?php else: ?>
        <div class="cart-actions">
            <p>Your cart is empty.</p>
            <a href="homepage.php">← Continue Shopping</a>
        </div>
    <?php endif; ?>
</div>

<?php $con->close(); ?>
<?php include 'footer.php'; ?>
</body>
</html>
