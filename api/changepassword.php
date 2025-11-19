<?php
session_start();
include('connection.php'); 

// Redirect to login page if not logged in
if (!isset($_SESSION['us_id'])) {
    echo "<script>window.location.href = '../html/login.html';</script>";
    exit();
}

$user_id = $_SESSION['us_id'];

if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the existing password from the database
    $query = "SELECT password FROM registration WHERE id='$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<script>alert('User not found.');</script>";
    } elseif ($current_password !== $row['password']) { 
        echo "<script>alert('Current password is incorrect.');</script>";
    } elseif ($new_password !== $confirm_password) {
        echo "<script>alert('New passwords do not match.');</script>";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $new_password)) {
        echo "<script>alert('Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.');</script>";
    } else {
        // Update password without hashing
        $update_query = "UPDATE registration SET password='$new_password' WHERE id='$user_id'";
        
        if (mysqli_query($con, $update_query)) {
            echo "<script>alert('Password changed successfully!');</script>";
        } else {
            echo "<script>alert('Error updating password. Try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .update-btn {
            background-color: #007bff;
        }

        .update-btn:hover {
            background-color: #0056b3;
        }

        .forgot-btn {
            background-color: #dc3545;
        }

        .forgot-btn:hover {
            background-color: #c82333;
        }

        .back-btn {
            display: block;
            margin-top: 15px;
            color: #007bff;
            font-size: 16px;
            text-decoration: none;
            font-weight: bold;
        }

        .back-btn:hover {
            color: #0056b3;
        }

        @media (max-width: 500px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .btn {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>

    <form method="post">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>

        <div class="btn-group">
            <button type="submit" name="change_password" class="btn update-btn">Update Password</button>
            <a href="forgotpassword.php" class="btn forgot-btn">Forgot Password?</a>
        </div>
    </form>

    <a href="myprofile.php" class="back-btn">Back to Profile</a>
</div>

</body>
</html>
