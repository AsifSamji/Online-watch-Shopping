<?php
        session_start();    
        include("connection.php");
        if(isset($_POST['al']))
        {
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        $query = "select * from admin where username = '$username' && password = '$pwd' " ;
        $data = mysqli_query($con,$query);

        

        $total = mysqli_num_rows($data);

        if($total)
        {
            $_SESSION['ad'] = $username;
            
            echo "
                    <script>
                    alert('admin login successfully');
                    window.location.href='http://localhost/mobile_shopping/admin/mystore.php';
                    </script>
                    ";                                 
        }
        else
        {
            echo "
                 <script>
                 alert('lnvalid User');
                
                 </script>
                ";  
        }
    }
 
?>



<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login Page</title>
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
    background-image: url('../api/images/admin1.AVIF');
    background-size: cover;
    background-position: bottom; 
    background-repeat: no-repeat; 
    height: 100vh;
    display: flex;
    justify-content: flex-start; /* Align to the left */
    align-items: center;
    padding-left: 80px; /* Adjust left spacing */
    animation: fadeIn 1.5s ease-in-out;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Login Container with Glassmorphism Effect */
.login-container {
    width: 100%;
    max-width: 450px; /* Increased width */
    padding: 30px; /* Increased padding */
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(12px);
    text-align: center;
    animation: slideIn 1s ease-in-out;
}

/* Slide-in Animation */
@keyframes slideIn {
    from {
        transform: translateX(-50px); /* Slide in from left */
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Title Styling */
h1 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #fff;
    font-weight: bold;
    animation: fadeIn 1.5s ease-in-out;
}

/* Input Group */
.input-group {
    margin-bottom: 12px;
    text-align: left;
}

/* Label Styling */
.input-group label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #fff;
}

/* Input Fields */
.input-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 6px;
    font-size: 18px;
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
    transition: all 0.3s ease-in-out;
}

/* Input Focus Effects */
.input-group input:focus {
    border-color: #80bdff;
    outline: none;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.7);
    transform: scale(1.03);
}

/* Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(45deg, #555, #222); /* Gradient effect */
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    animation: pulse 1.5s infinite;
}

/* Submit Button Hover Effect */
input[type="submit"]:hover {
    background: linear-gradient(45deg, #222, #000);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
}

/* Pulse Animation */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Links Section */
.links {
    margin-top: 15px;
    text-align: center;
}

/* Stylish Links */
.links a {
    display: inline-block;
    font-size: 14px;
    margin: 5px 10px;
    color: #fff;
    text-decoration: none;
    position: relative;
    transition: color 0.3s ease-in-out;
}

/* Hover Effect on Links */
.links a:hover {
    color: #80bdff;
}

/* Animated Underline Effect */
.links a::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: #80bdff;
    left: 0;
    bottom: -4px;
    transform: scaleX(0);
    transition: transform 0.3s ease-in-out;
}

/* Show Underline on Hover */
.links a:hover::after {
    transform: scaleX(1);
}

/* RESPONSIVE DESIGN */

/* For Tablets (<= 1024px) */
@media (max-width: 1024px) {
    body {
        justify-content: center; /* Center on smaller screens */
        padding-left: 0;
    }
    .login-container {
        max-width: 320px;
        padding: 20px;
    }
}

/* For Mobile Devices (<= 768px) */
@media (max-width: 768px) {
    body {
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 0 15px;
    }
    .login-container {
        width: 100%;
        max-width: 300px;
        padding: 18px;
    }
    h1 {
        font-size: 20px;
    }
    .input-group input {
        font-size: 14px;
        padding: 8px;
    }
    input[type="submit"] {
        font-size: 15px;
    }
}

/* For Very Small Screens (<= 480px) */
@media (max-width: 480px) {
    .login-container {
        width: 95%;
        max-width: 280px;
    }
    h1 {
        font-size: 18px;
    }
    input[type="submit"] {
        padding: 10px;
        font-size: 14px;
    }
}

    </style>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    
    <form action="#" method="POST">
    <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        </div>
        
        <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        </div>
        
        <input type="submit" value="Login" name="al">
    </form>
</div>
</body>
</html>

