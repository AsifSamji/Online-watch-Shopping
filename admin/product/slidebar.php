<!-- Sidebar Menu -->
<div class="sidebar">
    <a href="sales_report.php" >Sales Report</a>
    <a href="inventory_report.php" >Inventory Report</a>
    <a href="customer_report.php">Customer Report</a>
    <a href="order_report.php">Order Report</a>
    <a href="payment_report.php">Payment Report</a>
    <a href="t.php">Turnover Report</a>
    <a href="reports.php">Back To Dashboard</a>
</div>

<style>
    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        height: 100vh;
        background: #222;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        padding-top: 20px;
    }

    .sidebar a {
        text-decoration: none;
        color: white;
        padding: 15px 20px;
        display: block;
        font-size: 1rem;
        border-bottom: 1px solid #333;
        transition: 0.3s;
    }

    .sidebar a:hover, .sidebar a.active {
        background: #f8b400;
        color: black;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
        }
    }

    @media (max-width: 600px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }
        .sidebar a {
            display: inline-block;
            padding: 10px;
        }
    }
</style>
