<?php
include 'connection.php';

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

$sql = "SELECT payment_method, COUNT(*) AS total_transactions, SUM(price * quantity) AS total_amount 
        FROM purchases";

if (!empty($search_query)) {
    $sql .= " WHERE payment_method LIKE '%$search_query%'";
}

$sql .= " GROUP BY payment_method";
$result = $con->query($sql);

$total_sql = "SELECT COUNT(*) AS grand_total_transactions, SUM(price * quantity) AS grand_total_amount FROM purchases";
$total_result = $con->query($total_sql);
$total_row = $total_result->fetch_assoc();

// Download report logic
if (isset($_GET['download'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=payment_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";
    echo "<tr>
            <th>Payment Method</th>
            <th>Total Transactions</th>
            <th>Total Amount (₹)</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['payment_method']}</td>
                <td>{$row['total_transactions']}</td>
                <td>₹{$row['total_amount']}</td>
              </tr>";
    }

    echo "<tr class='total-row'>
            <td><b>Total</b></td>
            <td><b>{$total_row['grand_total_transactions']}</b></td>
            <td><b>₹{$total_row['grand_total_amount']}</b></td>
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
    <title>Payment Report</title>
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
        input[type="text"], button {
            padding: 8px;
            border-radius: 5px;
            border: none;
        }
        input {
            width: 250px;
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
        doc.text("Payment Report", 90, 20);
        

        // Get table data
        const table = document.getElementById("paymentTable");
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
    <h2>Payment Report</h2>

    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search_query" placeholder="Search by Payment Method..." value="<?= htmlspecialchars($search_query); ?>">
            <button type="submit" name="search">Search</button>
            <a href="payment_report.php"><button type="button">Reset</button></a>
            <button onclick="generatePDF()" class="download-button">Download Report</button>
        </form>
    </div>

    <table id="paymentTable">
        <tr>
            <th>Payment Method</th>
            <th>Total Transactions</th>
            <th>Total Amount</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['payment_method']) . "</td>
                        <td>" . htmlspecialchars($row['total_transactions']) . "</td>
                        <td>" . htmlspecialchars($row['total_amount']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found.</td></tr>";
        }
        ?>

        <tr class="total-row">
            <td><strong>Total</strong></td>
            <td><strong><?= $total_row['grand_total_transactions']; ?></strong></td>
            <td><strong><?= $total_row['grand_total_amount']; ?></strong></td>
        </tr>
    </table>

</div>

</body>
</html>

<?php $con->close(); ?>
