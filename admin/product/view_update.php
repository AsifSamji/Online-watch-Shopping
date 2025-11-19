<?php
include '../header2.php';
include("connection.php");
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        thead th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: center;
            border-bottom: 3px solid #ddd;
        }

        tbody td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tbody td img {
            display: block;
            margin: 0 auto;
            height: 80px;
            width: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .update-btn {
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .update-btn:hover {
            background-color: #218838;
        }

        /* Responsive Styling */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
                font-size: 14px;
            }
            tbody td img {
                height: 60px;
                width: 60px;
            }
            .update-btn {
                padding: 6px 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<h2>Product List</h2>

<?php
$query = "SELECT *, (P_PRICE - (P_PRICE * P_DISCOUNT / 100)) AS P_DISCOUNTED_PRICE FROM product";
$data = mysqli_query($con, $query);

echo "<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Company</th>
                <th>Image</th>
                <th>Price</th>
                <th>Discount (%)</th>
                <th>Discounted Price</th>
                <th>Quantity</th>
                <th>RAM</th>
                <th>ROM</th>
                <th>Color</th>
                <th>Display</th>
                <th>Battery</th>
                <th>Processor</th>
                <th>Camera</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>";

while ($row = mysqli_fetch_assoc($data)) {
    echo "<tr>
            <td>".$row['ID']."</td>
            <td>".$row['P_NAME']."</td>
            <td>".$row['P_COMPANY']."</td>
            <td><img src='".$row['P_IMAGE']."' alt='Product Image'></td>
            <td>₹".$row['P_PRICE']."</td>
            <td>".$row['P_DISCOUNT']."%</td>
            <td>₹".number_format($row['P_DISCOUNTED_PRICE'], 2)."</td>
            <td>".$row['P_QUENTITY']."</td>
            <td>".$row['P_RAM']."</td>
            <td>".$row['P_ROM']."</td>
            <td>".$row['P_COLOR']."</td>
            <td>".$row['P_DISPLAY']."</td>
            <td>".$row['P_BATTERY']."</td>
            <td>".$row['P_PROCESSOR']."</td>
            <td>".$row['P_CAMERA']."</td>
            <td>
                <a href='update_product.php?id={$row['ID']}' class='update-btn'>Update</a>
            </td>
          </tr>";
}

echo "</tbody></table>";
?>

</body>
</html>
