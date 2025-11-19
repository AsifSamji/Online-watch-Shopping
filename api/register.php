<?php 
include("connection.php");

if(isset($_POST['rg'])) {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['number'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        echo "
            <script>
                alert('Passwords do not match.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Check if email or contact number already exists
    $checkQuery = "SELECT * FROM registration WHERE email='$email' OR contactno='$contact'";
    $checkResult = mysqli_query($con, $checkQuery);

    if(mysqli_num_rows($checkResult) > 0) {
        echo "
            <script>
                alert('Email or Contact Number already registered. Please use a different one.');
                window.history.back();
            </script>
        ";
        exit();
    }

    // Insert new user
    $query = "INSERT INTO registration (fname, lname, address, email, contactno, password) 
              VALUES ('$fname', '$lname', '$address', '$email', '$contact', '$password')";
    $data = mysqli_query($con, $query);

    if ($data) {
        echo "
            <script>
                alert('Registration successful');
                window.location.href='http://localhost/mobile_shopping/html/login.html';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Registration failed. Please try again.');
            </script>
        ";
    }
}
?>
