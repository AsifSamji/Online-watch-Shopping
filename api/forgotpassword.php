<?php
session_start();
include('connection.php');

$msg = "";

// Handle form submission
if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email and contact number exist in the database
    $query = "SELECT * FROM registration WHERE email='$email' AND contactno='$contactno'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $msg = "<p style='color: red;'>Email or Contact Number is incorrect.</p>";
    } elseif ($new_password !== $confirm_password) {
        $msg = "<p style='color: red;'>Passwords do not match.</p>";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $new_password)) {
        $msg = "<p style='color: red;'>Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.</p>";
    } else {
        // Hash the new password before updating
      //  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password
        $update_query = "UPDATE registration SET password='$new_password' WHERE email='$email' AND contactno='$contactno'";
        
        if (mysqli_query($con, $update_query)) {
            $msg = "<p style='color: green;'>Password reset successfully! Redirecting to login...</p>";
            
            // Redirect to login page after 3 seconds
            echo "<script>
            alert('password change succesfully'); 
            window.location.href = '../html/login.html';
            </script>";
        } else {
            $msg = "<p style='color: red;'>Error updating password. Try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Reset Default Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Background Styling */
        body {
            background-image: url('https://img.freepik.com/premium-vector/closed-padlock-digital-background-cyber-security_42077-15493.jpg?ga=GA1.1.815608279.1740367863&semt=ais_hybrid'); /* Ensure correct path */
            background-size: cover;
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100vh;
            display: flex;
            justify-content: flex-end; /* Moves the form to the right */
            align-items: center;
            padding-right: 10%; /* Adds space from right */
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 400px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.2); /* Glassmorphism effect */
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            text-align: center;
            animation: slideIn 1s ease-in-out;
        }

        /* Slide-in Animation */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Title Styling */
        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #fff;
            font-weight: bold;
        }

        /* Input Fields */
        input[type="email"], input[type="password"], input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 6px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.3);
            color: black ;
            transition: all 0.3s ease-in-out;
        }

        /* Placeholder Visibility Fix */
        input::placeholder {
            color: rgba(30, 25, 25, 0.8);
        }

        /* Input Focus Effects */
        input:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.7);
            transform: scale(1.03);
        }

        /* Submit Button */
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #555, #222);
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            animation: pulse 1.5s infinite;
        }

        /* Submit Button Hover Effect */
        .btn:hover {
            background: linear-gradient(45deg, #222, #000);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Error and Success Messages */
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Back Button */
        .back-btn {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: white;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .back-btn:hover {
            color: #80bdff;
            text-decoration: underline;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 1024px) {
            body {
                justify-content: center; /* Center form on smaller screens */
                padding-right: 0;
            }
        }

        @media (max-width: 768px) {
            .container {
                max-width: 320px;
            }
            h2 {
                font-size: 20px;
            }
            .btn {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                max-width: 280px;
            }
            h2 {
                font-size: 18px;
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
    <h2>Reset Password</h2>
    
    <?php echo $msg; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Enter your registered email" required>
        <input type="text" name="contactno" placeholder="Enter your registered contact number" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <button type="submit" name="reset_password" class="btn">Reset Password</button>
       
    </form>
    <a href="changepassword.php" style="margin-top: 10px;">
  <button type="submit" name="back-btn" class="btn">Back</button>
</a>

</div>

</body>
</html>
