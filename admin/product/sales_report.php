<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

// SQL Query to fetch product sales and remaining stock
$sql = "SELECT 
            p.P_NAME AS product_name, 
            p.P_QUENTITY AS total_stock, 
            COALESCE(SUM(pr.quantity), 0) AS total_sold, 
            (p.P_QUENTITY - COALESCE(SUM(pr.quantity), 0)) AS remaining_stock, 
            p.P_DISCOUNTED_PRICE AS price_per_unit, 
            COALESCE(SUM(pr.quantity * p.P_DISCOUNTED_PRICE), 0) AS total_revenue
        FROM product p
        LEFT JOIN purchases pr ON p.ID = pr.product_id AND pr.order_status = 'Delivered'";

if (!empty($search_query)) {
    $sql .= " WHERE p.P_NAME LIKE '%$search_query%'";
}

$sql .= " GROUP BY p.P_NAME, p.P_DISCOUNTED_PRICE, p.P_QUENTITY";
$result = $conn->query($sql);

// Store data in an array
$data = [];
$grand_total_stock = 0;
$grand_total_sold = 0;
$grand_total_remaining = 0;
$grand_total_revenue = 0;

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $grand_total_stock += $row['total_stock'];
    $grand_total_sold += $row['total_sold'];
    $grand_total_remaining += $row['remaining_stock'];
    $grand_total_revenue += $row['total_revenue'];
}

// Handle Download Request
if (isset($_GET['download'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=sales_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<html><head><style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid black; padding: 8px; text-align: center; }
            th { background-color: #f2f2f2; }
          </style></head><body>";
    echo "<table><tr>
            <th>Product Name</th>
            <th>Total Stock</th>
            <th>Quantity Sold</th>
            <th>Remaining Stock</th>
            <th>Price Per Unit</th>
            <th>Total Sales</th>
          </tr>";

    foreach ($data as $row) {
        echo "<tr>
                <td>{$row['product_name']}</td>
                <td>{$row['total_stock']}</td>
                <td>{$row['total_sold']}</td>
                <td>{$row['remaining_stock']}</td>
                <td>{$row['price_per_unit']}</td>
                <td>{$row['total_revenue']}</td>
              </tr>";
    }

    // Grand total row
    echo "<tr style='font-weight:bold; background:#f2f2f2;'>
            <td>Total</td>
            <td>{$grand_total_stock}</td>
            <td>{$grand_total_sold}</td>
            <td>{$grand_total_remaining}</td>
            <td>-</td>
            <td>{$grand_total_revenue}</td>
          </tr>";

    echo "</table></body></html>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
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

        input[type="text"] {
            padding: 8px;
            width: 250px;
            border-radius: 5px;
            border: none;
        }

        button {
            padding: 8px 12px;
            background-color: #f8b400;
            border: none;
            color: black;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .download-button {
            text-decoration: none;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
        }

        .download-button:hover {
            background-color: #218838;
        }

        table {
            width: 80%;
            max-width: 800px;
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

        .back-button {
            margin-top: 20px;
            text-decoration: none;
            background-color: #ff5722;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #d84315;
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
        doc.text("Sales Report", 90, 20);

        // Get table data
        const table = document.getElementById("salesTable");
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

<?php include 'slidebar.php'; ?>

<div class="main-content">
    <h2>Sales Report</h2>

    <div class="search-container">
        <form method="POST">
            <input type="text" name="search_query" placeholder="Search product name..." value="<?= htmlspecialchars($search_query); ?>">
            <button type="submit" name="search">Search</button>
            <a href="sales_report.php"><button type="button">Reset</button></a>
            <button onclick="generatePDF()" class="download-button">Download Report</button>

        </form>
    </div>

    <table id="salesTable">
        <tr>
            <th>Product Name</th>
            <th>Total Stock</th>
            <th>Quantity Sold</th>
            <th>Remaining Stock</th>
            <th>Price Per Unit</th>
            <th>Total Sales</th>
        </tr>

        <?php if (!empty($data)) : ?>
    <?php foreach ($data as $row) : ?>
        <tr>
            <td><?= htmlspecialchars($row['product_name']); ?></td>
            <td><?= $row['total_stock']; ?></td>
            <td><?= $row['total_sold']; ?></td>
            <td><?= $row['remaining_stock']; ?></td>
            <td><?= $row['price_per_unit']; ?></td>
            <td><?= $row['total_revenue']; ?></td>
        </tr>
    <?php endforeach; ?>

    <!-- Grand Total Row -->
    <tr class="total-row">
        <td>Total</td>
        <td><?= $grand_total_stock; ?></td>
        <td><?= $grand_total_sold; ?></td>
        <td><?= $grand_total_remaining; ?></td>
        <td>-</td>
        <td><?= $grand_total_revenue; ?></td>
    </tr>

<?php else : ?>
    <tr><td colspan="6">No data found.</td></tr>
<?php endif; ?>

    </table>
</div>

</body>
</html>
