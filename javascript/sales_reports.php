<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .report-container { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
        a { margin-right: 15px; }
    </style>
</head>
<body>
    <h2>Reports</h2>
    <nav>
        <a href="?report=sales">Sales Report</a>
        <a href="?report=orders">Order Report</a>
        <a href="?report=customers">Customer Report</a>
        <a href="?report=inventory">Inventory Report</a>
        <a href="?report=payments">Payment Report</a>
    </nav>
    <div class="report-container">
        <?php
        if (isset($_GET['report'])) {
            $report = $_GET['report'];
            switch ($report) {
                case 'sales':
                    echo "<h3>Sales Report</h3>";
                    $sql = "SELECT SUM(quantity) AS total_sold, SUM(price * quantity) AS total_revenue FROM purchases";
                    break;
                case 'orders':
                    echo "<h3>Order Report</h3>";
                    $sql = "SELECT id, user_id, product_id, quantity, price, order_status FROM purchases";
                    break;
                case 'customers':
                    echo "<h3>Customer Report</h3>";
                    $sql = "SELECT r.id, r.fname, r.lname, r.email, COUNT(p.id) AS total_orders FROM registration r LEFT JOIN purchases p ON r.id = p.user_id GROUP BY r.id";
                    break;
                case 'inventory':
                    echo "<h3>Inventory Report</h3>";
                    $sql = "SELECT P_NAME, P_QUENTITY FROM product WHERE P_QUENTITY >= 0";
                    break;
                case 'payments':
                    echo "<h3>Payment Report</h3>";
                    $sql = "SELECT payment_method, COUNT(*) AS total_transactions, SUM(price * quantity) AS total_amount FROM purchases GROUP BY payment_method";
                    break;
                default:
                    echo "<p>Select a valid report.</p>";
                    exit;
            }
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table><tr>";
                while ($field = $result->fetch_field()) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $data) {
                        echo "<td>" . $data . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data found.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
