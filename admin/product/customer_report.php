<?php
include 'connection.php';

// Initialize variables
$search_query = "";
$total_delivered = 0;
$total_remaining = 0;
$total_orders = 0;

if (isset($_POST['search'])) {
    $search_query = trim($_POST['search_query']);
}

// Base SQL query
$sql = "SELECT 
            r.id, r.fname, r.lname, r.email, 
            COUNT(p.id) AS total_orders,
            SUM(CASE WHEN p.order_status = 'Delivered' THEN 1 ELSE 0 END) AS delivered_orders,
            SUM(CASE WHEN p.order_status IN ('Processing', 'Shipped', 'Out for Delivery') THEN 1 ELSE 0 END) AS remaining_orders
        FROM registration r 
        LEFT JOIN purchases p ON r.id = p.user_id";

// Apply search filter
if (!empty($search_query)) {
    $sql .= " WHERE r.fname LIKE ? OR r.lname LIKE ? OR r.email LIKE ?";
}

$sql .= " GROUP BY r.id";

$stmt = $con->prepare($sql);

// Bind parameter if search is applied
if (!empty($search_query)) {
    $search_param = "%$search_query%";
    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
}

$stmt->execute();
$result = $stmt->get_result();

// Handle Download Request
if (isset($_GET['download'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=customer_report.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";
    echo "<tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Delivered Orders</th>
            <th>Remaining Orders</th>
            <th>Total Orders</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['fname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['email']}</td>
                <td>{$row['delivered_orders']}</td>
                <td>{$row['remaining_orders']}</td>
                <td>{$row['total_orders']}</td>
              </tr>";

        // Accumulate totals
        $total_delivered += $row['delivered_orders'];
        $total_remaining += $row['remaining_orders'];
        $total_orders += $row['total_orders'];
    }

    echo "<tr>
            <td colspan='4'><strong>Total</strong></td>
            <td><strong>$total_delivered</strong></td>
            <td><strong>$total_remaining</strong></td>
            <td><strong>$total_orders</strong></td>
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
    <title>Customer Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        }
        .search-container {
            margin-bottom: 20px;
        }
        input[type="text"], button {
            padding: 8px;
            border-radius: 5px;
            border: none;
        }
        input[type="text"] {
            width: 250px;
        }
        button {
            background-color: #f8b400;
            font-weight: bold;
            cursor: pointer;
        }
        .download-button {
            text-decoration: none;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
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
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        th {
            background: rgba(255, 255, 255, 0.2);
        }
        tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .total-row {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
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
        doc.text("Customer Report", 90, 20);

        // Get table data
        const table = document.getElementById("customerTable");
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
    <h2>Customer Report</h2>

    <div class="search-container">
        <form method="POST">
            <input type="text" name="search_query" placeholder="Search by Name or Email..." value="<?= htmlspecialchars($search_query); ?>">
            <button type="submit" name="search">Search</button>
            <a href="customer_report.php"><button type="button">Reset</button></a>
            <button onclick="generatePDF()" class="download-button">Download Report</button>
        </form>
    </div>

    <table id="customerTable">
        <tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Delivered Orders</th>
            <th>Remaining Orders</th>
            <th>Total Orders</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fname']}</td>
                        <td>{$row['lname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['delivered_orders']}</td>
                        <td>{$row['remaining_orders']}</td>
                        <td>{$row['total_orders']}</td>
                      </tr>";

                // Accumulate totals
                $total_delivered += $row['delivered_orders'];
                $total_remaining += $row['remaining_orders'];
                $total_orders += $row['total_orders'];
            }

            echo "<tr class='total-row'>
                    <td colspan='4'>Total</td>
                    <td>$total_delivered</td>
                    <td>$total_remaining</td>
                    <td>$total_orders</td>
                  </tr>";
        } else {
            echo "<tr><td colspan='7'>No data found.</td></tr>";
        }

        $stmt->close();
        $con->close();
        ?>
    </table>
</div>

</body>
</html>
