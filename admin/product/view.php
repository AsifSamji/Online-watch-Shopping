<?php
include '../header2.php';
include("connection.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';
$company = isset($_GET['company']) ? $_GET['company'] : '';
$ram = isset($_GET['ram']) ? $_GET['ram'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$query = "SELECT * FROM product WHERE P_NAME LIKE '%$search%'";

if ($company) {
    $query .= " AND P_COMPANY = '$company'";
}
if ($ram) {
    $query .= " AND P_RAM = '$ram'";
}
if ($color) {
    $query .= " AND P_COLOR = '$color'";
}
if ($sort == 'low_high') {
    $query .= " ORDER BY P_PRICE ASC";
} elseif ($sort == 'high_low') {
    $query .= " ORDER BY P_PRICE DESC";
}

$data = mysqli_query($con, $query);
?>

<html>
<head>
    <style>
        .filter-container {
            display: flex;
            justify-content: left;
            margin: 20px;
        }
        .filter-container select, .filter-container input, .filter-container button {
            margin-right: 10px;
            padding: 5px;
        }
        table {
    width: 90%;
    border-collapse: collapse;
    margin: 20px auto;
    background: white;
    border: 2px solid #007bff; /* Outer border */
}

thead th, tbody td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd; /* Column lines */
}

thead th {
    background-color: #007bff;
    color: white;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

tbody td img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 1px solid #ccc; /* Border around image */
}
</style>
</head>
<body>

<div class="filter-container">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by Product Name" value="<?= htmlspecialchars($search); ?>">
        <select name="company">
            <option value="">Select Company</option>
            <option value="Samsung" <?= ($company == 'Samsung') ? 'selected' : '' ?>>Samsung</option>
            <option value="Apple" <?= ($company == 'Apple') ? 'selected' : '' ?>>Apple</option>
        </select>
        <select name="ram">
            <option value="">Select RAM</option>
            <option value="4GB" <?= ($ram == '4GB') ? 'selected' : '' ?>>4GB</option>
            <option value="8GB" <?= ($ram == '8GB') ? 'selected' : '' ?>>8GB</option>
        </select>
        <select name="color">
            <option value="">Select Color</option>
            <option value="Black" <?= ($color == 'Black') ? 'selected' : '' ?>>Black</option>
            <option value="White" <?= ($color == 'White') ? 'selected' : '' ?>>White</option>
        </select>
        <select name="sort">
            <option value="">Sort By Price</option>
            <option value="low_high" <?= ($sort == 'low_high') ? 'selected' : '' ?>>Low to High</option>
            <option value="high_low" <?= ($sort == 'high_low') ? 'selected' : '' ?>>High to Low</option>
        </select>
        <button type="submit">Filter</button>
        <button type="button" onclick="window.location.href='view.php'">Reset</button>
    </form>
</div>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Image</th>
            <th>Company</th>
            <th>RAM</th>
            <th>ROM</th>
            <th>Color</th>
            <th>Display</th>
            <th>Battery</th>
            <th>Processor</th>
            <th>Camera</th>
            <th>Price</th>
            <th>Discount (%)</th>
            <th>Discounted Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($data)) { 
            $discounted_price = $row['P_PRICE'] - ($row['P_PRICE'] * $row['P_DISCOUNT'] / 100); 
        ?>
        <tr>
            <td><?= $row['ID'] ?></td>
            <td><?= $row['P_NAME'] ?></td>
            <td><img src="<?= $row['P_IMAGE'] ?>" alt="Product Image"></td>
            <td><?= $row['P_COMPANY'] ?></td>
            <td><?= $row['P_RAM'] ?></td>
            <td><?= $row['P_ROM'] ?></td>
            <td><?= $row['P_COLOR'] ?></td>
            <td><?= $row['P_DISPLAY'] ?></td>
            <td><?= $row['P_BATTERY'] ?></td>
            <td><?= $row['P_PROCESSOR'] ?></td>
            <td><?= $row['P_CAMERA'] ?></td>
            <td>₹<?= number_format($row['P_PRICE'], 2) ?></td>
            <td><?= $row['P_DISCOUNT'] ?>%</td>
            <td>₹<?= number_format($discounted_price, 2) ?></td>
            <td><?= $row['P_QUENTITY'] ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>