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

$low_stock_threshold = 2;
$search_query = "";

if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

// Fetch inventory data
$sql = "SELECT ID, P_NAME, P_QUENTITY, P_DISCOUNTED_PRICE FROM product";
if (!empty($search_query)) {
    $sql .= " WHERE P_NAME LIKE '%$search_query%'";
}
$result = mysqli_query($conn, $sql);

// Fetch total inventory summary
$total_sql = "SELECT COUNT(ID) AS total_products, SUM(P_QUENTITY) AS total_stock, SUM(P_QUENTITY * P_DISCOUNTED_PRICE) AS total_unit_price FROM product";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);

// Handle Excel download request
if (isset($_GET['download'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=inventory_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<html>";
    echo "<head>";
    echo "<style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid black; padding: 8px; text-align: center; }
            th { background-color: #f2f2f2; }
          </style>";
    echo "</head>";
    echo "<body>";
    echo "<table>";
    echo "<tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Available Stock</th>
            <th>Per Unit Price</th>
            <th>Total Unit Price</th>
            <th>Status</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $status_text = ($row['P_QUENTITY'] <= $low_stock_threshold) ? "Running Low" : "Available";
        $total_price = $row['P_QUENTITY'] * $row['P_DISCOUNTED_PRICE'];

        echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['P_NAME']}</td>
                <td>{$row['P_QUENTITY']}</td>
                <td>{$row['P_DISCOUNTED_PRICE']}</td>
                <td>{$total_price}</td>
                <td>{$status_text}</td>
              </tr>";
    }

    echo "<tr>
            <td colspan='2'><strong>Grand Total</strong></td>
            <td><strong>{$total_row['total_stock']}</strong></td>
            <td></td>
            <td><strong>{$total_row['total_unit_price']}</strong></td>
            <td><strong>{$total_row['total_products']} Products</strong></td>
          </tr>";

    echo "</table>";
    echo "</body>";
    echo "</html>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <style>
        body { font-family: 'Arial', sans-serif; background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; margin: 0; padding: 0; display: flex; }
        .main-content { margin-left: 270px; padding: 20px; width: 100%; text-align: center; }
        h2 { font-size: 2rem; text-transform: uppercase; letter-spacing: 1px; }
        .search-container { margin-bottom: 20px; }
        input[type="text"] { padding: 8px; width: 250px; border-radius: 5px; border: none; }
        button { padding: 8px 12px; background-color: #f8b400; border: none; color: black; font-weight: bold; cursor: pointer; border-radius: 5px; }
        .download-button { text-decoration: none; background-color: #28a745; color: white; padding: 10px 15px; border-radius: 5px; display: inline-block; margin-left: 10px; font-weight: bold; }
        .download-button:hover { background-color: #218838; }
        table { width: 80%; max-width: 900px; border-collapse: collapse; margin: auto; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(5px); border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.3); }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.3); color: white; }
        th { background: rgba(255, 255, 255, 0.2); text-transform: uppercase; }
        tr:hover { background: rgba(255, 255, 255, 0.1); }
        .low-stock { background-color: red; color: white; padding: 5px 10px; border-radius: 5px; }
        .available-stock { background-color: green; color: white; padding: 5px 10px; border-radius: 5px; }
        .grand-total { background-color: rgba(255, 255, 255, 0.2); font-weight: bold; color: yellow; }
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
        doc.text("Inventory Report", 90, 20);

        // Get table data
        const table = document.getElementById("inventoryTable");
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
    <h2>Inventory Report</h2>

    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search_query" placeholder="Search by Product Name..." value="<?= htmlspecialchars($search_query); ?>">
            <button type="submit" name="search">Search</button>
            <a href="inventory_report.php"><button type="button">Reset</button></a>
            <button onclick="generatePDF()" class="download-button">Download Report</button>
        </form>
    </div>

    <table id="inventoryTable">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Available Stock</th>
            <th>Per Unit Price</th>
            <th>Total Unit Price</th>
            <th>Status</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $status_class = ($row['P_QUENTITY'] <= $low_stock_threshold) ? "low-stock" : "available-stock";
                $status_text = ($row['P_QUENTITY'] <= $low_stock_threshold) ? "Running Low" : "Available";
                $total_price = $row['P_QUENTITY'] * $row['P_DISCOUNTED_PRICE'];

                echo "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['P_NAME']}</td>
                        <td>{$row['P_QUENTITY']}</td>
                        <td>{$row['P_DISCOUNTED_PRICE']}</td>
                        <td>{$total_price}</td>
                        <td><span class='{$status_class}'>{$status_text}</span></td>
                      </tr>";
            }

            echo "<tr class='grand-total'>
                    <td colspan='2'>Grand Total</td>
                    <td>{$total_row['total_stock']}</td>
                    <td></td>
                    <td>{$total_row['total_unit_price']}</td>
                    <td>{$total_row['total_products']} Products</td>
                  </tr>";
        } else {
            echo "<tr><td colspan='6'>No products found.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
