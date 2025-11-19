<?php
include("connection.php");
include("header.php");
include("header3.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, subject, message)
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Thank you! Your message has been sent.'); window.location='contact_us.php';</script>";
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Online Mobile Shopping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }

        .contact-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .contact-container h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        form .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-submit:hover {
            background: #0056b3;
        }

        @media (max-width: 768px) {
            .contact-container {
                margin: 30px 15px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h2>Contact Us</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <input class="form-control" type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input class="form-control" type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="subject">Subject</label>
            <input class="form-control" type="text" name="subject" id="subject" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="message">Message</label>
            <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn-submit">Send Message</button>
    </form>
</div>

<?php include("footer.php"); ?>
</body>
</html>
