<?php
session_start();
include('connection.php');

if (!isset($_SESSION['us_id'])) {
    header('Location: http://localhost/mobile_shopping/html/login.html');
    exit();
}

$user = $_SESSION['us_id'];
$query = "SELECT * FROM registration WHERE id='$user'";
$result = mysqli_query($con, $query);
$userData = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $update_query = "UPDATE registration SET 
                        fname='$fname', 
                        lname='$lname', 
                        address='$address', 
                        email='$email', 
                        contactno='$contactno'
                     WHERE id='$user'";

    if (mysqli_query($con, $update_query)) {
        if ($email !== $_SESSION['us_id']) {
            $_SESSION['us_id'] = $email;
        }
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 95%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            display: block;
            text-align: left;
            margin-top: 10px;
        }

        input[type="text"], 
        input[type="email"] {
            width: 90%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        input[type="text"]:focus, 
        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-container {
    margin-top: 20px;
    text-align: center;
}

input[type="submit"], 
.btn-container a {
    width: 90%;
    display: inline-block;
    padding: 12px;
    border: none;
    border-radius: 5px;
    text-align: center;
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
    transition: 0.3s;
}

/* Update Profile Button */
input[type="submit"] {
    background-color: #007bff;
    color: white;
}

input[type="submit"]:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Back Profile Button */
.btn-container a {
    background-color: #6c757d;
    color: white;
    margin-top: 10px;
}

.btn-container a:hover {
    background-color: #5a6268;
    transform: scale(1.05);
}

        @media screen and (max-width: 480px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            input[type="text"], input[type="email"] {
                font-size: 16px;
            }

            input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST" action="">
            <label>First Name:</label>
            <input type="text" name="fname" value="<?php echo htmlspecialchars($userData['fname']); ?>" required>

            <label>Last Name:</label>
            <input type="text" name="lname" value="<?php echo htmlspecialchars($userData['lname']); ?>" required>

            <label>Address:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>

            <label>Contact No:</label>
            <input type="text" name="contactno" value="<?php echo htmlspecialchars($userData['contactno']); ?>" required>

            <div class="btn-container">
                <input type="submit" name="update" value="Update Profile">
            </div>
            <div class="btn-container">
               <a href="myprofile.php"> Back Profile </a>
            </div>
        </form>
    </div>

</body>
</html>
