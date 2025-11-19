<?php

include('connection.php'); 
include 'header.php'; 
include 'header3.php'; 
if (!isset($_SESSION['us_id'])) {
    echo "<script>
    window.location.href = '../html/login.html';
    </script>";
    exit();
}

$user = $_SESSION['us_id'];
$query = "SELECT * FROM registration WHERE id='$user'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        .body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .containerss {
            width: 90%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .btn-containerss {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn {
            flex: 1;
            padding: 12px;
            margin: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 480px) {
            .btn-containerss {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="body">
    <div class="containerss">
        <h1>User Details</h1>
        <table>
            <tr><th>First Name</th><td><?php echo htmlspecialchars($user['fname'] ?? 'N/A'); ?></td></tr>
            <tr><th>Last Name</th><td><?php echo htmlspecialchars($user['lname'] ?? 'N/A'); ?></td></tr>
            <tr><th>Address</th><td><?php echo htmlspecialchars($user['address'] ?? 'N/A'); ?></td></tr>
            <tr><th>Email</th><td><?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></td></tr>
            <tr><th>Contact No</th><td><?php echo htmlspecialchars($user['contactno'] ?? 'N/A'); ?></td></tr>
        </table>

        <div class="btn-containerss">
            <a href="updateprofile.php" class="btn">Edit Profile</a>
            <a href="changepassword.php" class="btn">Change Password</a>
        </div>
    </div>

   
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
