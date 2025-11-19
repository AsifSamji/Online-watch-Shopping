<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
    <style>
        /* General Page Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: fadeInDown 1s ease-in-out;
        }

        /* Report Cards Container */
        .report-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 900px;
        }

        /* Report Cards */
        .report-card {
            width: 280px;
            height: 150px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            text-decoration: none;
            color: white;
            position: relative;
            overflow: hidden;
        }

        /* Hover Effect */
        .report-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: left 0.4s ease-in-out;
        }

        .report-card:hover::before {
            left: 100%;
        }

        .report-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 10px 25px rgba(255, 255, 255, 0.3);
        }

        /* Icons */
        .icon {
            font-size: 2rem;
            margin-right: 10px;
        }

        /* Back Button */
        .back-button {
            margin-top: 30px;
            padding: 12px 20px;
            background: #ff5722;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .back-button:hover {
            background-color: #d84315;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <h1>Reports Dashboard</h1>

    <div class="report-container">
        <a href="sales_Report.php" class="report-card">📈 Sales Report</a>
        <a href="order_Report.php" class="report-card">📦 Order Report</a>
        <a href="customer_Report.php" class="report-card">👥 Customer Report</a>
        <a href="Payment_Report.php" class="report-card">💳 Payment Report</a>
        <a href="inventory_Report.php" class="report-card">📦 Inventory Report</a>
    </div>

    <!-- Back Button to Dashboard -->
    <a href="../mystore.php" class="back-button">⬅ Back to Dashboard</a>

</body>
</html>
