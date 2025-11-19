<?php
include 'connection.php';

// Fetch total products, total quantity, and total price from products
$sql_products = "SELECT 
                    COUNT(ID) AS total_products, 
                    SUM(P_QUENTITY) AS total_quantity, 
                    SUM(P_QUENTITY * P_DISCOUNTED_PRICE) AS total_price 
                 FROM product";
$result_products = $con->query($sql_products);
$row_products = $result_products->fetch_assoc();

$total_products = $row_products['total_products'];
$total_quantity = $row_products['total_quantity'];
$total_price = $row_products['total_price'];

// Fetch total sold quantity and total revenue
$sql_sold = "SELECT 
                SUM(quantity) AS total_sold_quantity, 
                SUM(quantity * price) AS total_revenue 
             FROM purchases";
$result_sold = $con->query($sql_sold);
$row_sold = $result_sold->fetch_assoc();

$total_sold_quantity = $row_sold['total_sold_quantity'] ?? 0;
$total_revenue = $row_sold['total_revenue'] ?? 0;

// Calculate remaining stock and value
$remaining_quantity = $total_quantity - $total_sold_quantity;
$remaining_value = $total_price - $total_revenue;

// Handle file download
if (isset($_GET['download'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=turnover_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table id='turnoverTable' border='1'>";
    echo "<tr><th colspan='2'>Turnover Report</th></tr>";
    echo "<tr><th>Total Products</th><td>{$total_products}</td></tr>";
    echo "<tr><th>Grand Total Quantity</th><td>{$total_quantity}</td></tr>";
    echo "<tr><th>Grand Total Price</th><td>" . number_format($total_price, 2) . "</td></tr>";
    echo "<tr><th>Total Sold Quantity</th><td>{$total_sold_quantity}</td></tr>";
    echo "<tr><th>Total Revenue</th><td>" . number_format($total_revenue, 2) . "</td></tr>";
    echo "<tr><th>Remaining Quantity</th><td>{$remaining_quantity}</td></tr>";
    echo "<tr><th>Remaining Stock Value</th><td>" . number_format($remaining_value, 2) . "</td></tr>";
    echo "</table>";

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnover Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: black;
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

        .report-container {
            width: 80%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: left;
        }

        .report-container h3 {
            color: yellow;
        }

        .report-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .download-button {
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .download-button:hover {
            background-color: #218838;
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
        doc.text("Turnover Report", 90, 20);

        // Get table data
        const table = document.getElementById("turnoverTable");
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
    <h2>Turnover Report</h2>

    <style>

    table {
        width: 100%;
        border-collapse: collapse;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        background: #fff;
        border-radius: 5px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #28a745;
        color: white;
        font-size: 18px;
    }

    tr:hover {
        background: #f1f1f1;
    }

    td:last-child {
        font-weight: bold;
        color: #333;
    }
</style>

<div class="report-container">
    <h3>Product Report</h3>
    <table id="turnoverTable">
        <tr>
            <th colspan="2">Total Products in Website</th>
        </tr>
        <tr>
            <td>Total Products</td>
            <td><?= $total_products; ?></td>
        </tr>
        <tr>
            <td>Grand Total Quantity</td>
            <td><?= $total_quantity; ?></td>
        </tr>
        <tr>
            <td>Grand Total Price</td>
            <td><?= number_format($total_price, 2); ?></td>
        </tr>

        <tr>
            <th colspan="2">Sold Products</th>
        </tr>
        <tr>
            <td>Total Sold Quantity</td>
            <td><?= $total_sold_quantity; ?></td>
        </tr>
        <tr>
            <td>Total Revenue</td>
            <td><?= number_format($total_revenue, 2); ?></td>
        </tr>

        <tr>
            <th colspan="2">Remaining Stock</th>
        </tr>
        <tr>
            <td>Total Remaining Quantity</td>
            <td><?= $remaining_quantity; ?></td>
        </tr>
        <tr>
            <td>Total Value of Remaining Stock</td>
            <td><?= number_format($remaining_value, 2); ?></td>
        </tr>
    </table>
</div>

    <button onclick="generatePDF()" class="download-button">Download Report</button>
</div>

</body>
</html>
