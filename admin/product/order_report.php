<?php
include 'connection.php';

$search_product = "";
$search_date = "";
$min_price = "";
$max_price = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search_product = isset($_GET['search_product']) ? $_GET['search_product'] : "";
    $search_date = isset($_GET['search_date']) ? $_GET['search_date'] : "";
    $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : "";
    $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : "";
}

// SQL Query to fetch order details
$sql = "SELECT p.id, 
               u.fname AS user_name, 
               pr.p_name AS product_name, 
               p.quantity, 
               p.price, 
               p.order_status, 
               p.purchase_date 
        FROM purchases p
        JOIN registration u ON p.user_id = u.id
        JOIN product pr ON p.product_id = pr.id
        WHERE 1=1";

// Applying search filters
if (!empty($search_product)) {
    $sql .= " AND pr.p_name LIKE '%$search_product%'";
}

if (!empty($search_date)) {
    $sql .= " AND DATE(p.purchase_date) = '$search_date'";
}

if (!empty($min_price) && !empty($max_price)) {
    $sql .= " AND p.price BETWEEN $min_price AND $max_price";
}

$sql .= " ORDER BY p.purchase_date DESC";
$result = $con->query($sql);

// Initialize total quantity and total price
$total_quantity = 0;
$grand_total_price = 0;

if (isset($_GET['download'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=order_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1' >";
    echo "<tr>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Order Status</th>
            <th>Purchase Date</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_name']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['price']}</td>
                <td>{$row['order_status']}</td>
                <td>{$row['purchase_date']}</td>
              </tr>";

        $total_quantity += $row['quantity'];
        $grand_total_price += $row['price'];
    }

    echo "<tr class='total-row'>
            <td colspan='3'><b>Total Quantity</b></td>
            <td><b>" . $total_quantity . "</b></td>
            <td><b>" . $grand_total_price . "</b></td>
            <td colspan='2'>-</td>
          </tr>";

    echo "</table>";
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
            text-align: center;
        }
        h2 {
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        input, button {
            padding: 8px;
            margin: 5px;
            border-radius: 5px;
            border: none;
        }
        input {
            width: 200px;
        }
        button {
            background-color: #f8b400;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }
        .download-button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }
        .download-button:hover {
            background-color: #218838;
        }
        table {
            width: 80%;
            max-width: 1000px;
            border-collapse: collapse;
            margin: auto;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        th {
            background: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
        }
        tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .total-row {
            font-weight: bold;
            background: rgba(255, 255, 255, 0.2);
            color: yellow;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script>
    function generatePDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Title
        doc.setFontSize(16);
        doc.text("Online Mobile Shopping", 80, 10);
        doc.text("Order Report", 90, 20);

        // Get table data
        const table = document.getElementById("orderTable");
        doc.autoTable({
            html: table,
            startY: 20,
            theme: 'grid', // Adds grid lines
            headStyles: { fillColor: [30, 60, 114] }, // Header background color
            styles: { fontSize: 10, cellPadding: 2 },
        });

        // Open the PDF in a new tab
        window.open(doc.output('bloburl'), '_blank');
    }
</script>

</head>
<body>

<!-- Include Sidebar -->
<?php include 'slidebar.php'; ?>

<div class="main-content">
    <h2>Order Report</h2>

    <!-- Search Form -->
    <div class="search-container">
        <form method="GET">
            <input type="date" name="search_date" value="<?php echo htmlspecialchars($search_date); ?>"> 
            <button type="submit">Search</button>
            <a href="order_report.php"><button type="button">Reset</button></a>
            <button onclick="generatePDF()" class="download-button">Download Report</button>
        </form>
    </div>

    <?php
    if ($result->num_rows > 0) {
        echo "<table id='orderTable'><tr><th>Order ID</th><th>User Name</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Order Status</th><th>Purchase Date</th></tr>";

        $grand_total_price = 0;
        $total_quantity = 0;

        while ($row = $result->fetch_assoc()) {
          
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['order_status']) . "</td>";
            echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
            echo "</tr>";

            $grand_total_price += $row['price'];
            $total_quantity += $row['quantity'];
        }

        echo "<tr class='total-row'><td colspan='3'>Total Quantity</td><td>" . $total_quantity . "</td><td>" . $grand_total_price . "</td><td colspan='2'>-</td></tr>";
        echo "</table>";
    } else {
        echo "<p>No data found.</p>";
    }
    $con->close();
    ?>
</div>

</body>
</html>
