<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Basic Reset */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Footer Styles */
        .footer {
            background-color: #212529;
            color: white;
            padding: 40px 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer .social-icons {
            margin: 20px 0;
        }

        .footer .social-icons a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .footer .social-icons a:hover {
            color: #e74c3c; /* Change color on hover */
            transform: scale(1.2); /* Slightly enlarge on hover */
        }

        .footer .list-unstyled {
            padding: 0;
            list-style: none;
        }

        .footer .list-unstyled li {
            margin: 10px 0;
        }

        .footer .list-unstyled a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer .list-unstyled a:hover {
            color: #e74c3c; /* Change color on hover */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .footer .row {
                flex-direction: column; /* Stack columns on smaller screens */
                text-align: center;
            }

            .footer .col-md-3 {
                margin-bottom: 20px; /* Add space between stacked columns */
            }
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="containersss text-center text-md-start">
            <div class="row">
                <div class="col-md-3">
                    <h5>About Us</h5>
                    <p>We provide the latest and greatest mobile phones at the best prices. Shop from top brands with amazing discounts.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="homepage.php">Shop Now</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                    </ul>
                </div>
             
                


                <div class="col-md-3">
                    <h5>Contact Us</h5>
                    <p><i class="fa fa-phone"></i> +91 96017 92121</p>
                    <p><i class="fa fa-map-marker"></i> SS Agarwal Navsari , Gujarat , India</p>
                </div>
            </div>

            <hr>

            <div class="social-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/aasif_samji/?hl=en"><i class="fa fa-instagram"></i></a>
                <a href="https://youtube.com/@hamzamulla9525?si=a45X2WbHBxaJD6NL"><i class="fa fa-youtube"></i></a>
            </div>

            <hr>

            <div>&copy; 2025 Online Mobile Shopping. All Rights Reserved.</div>
        </div>
    </footer>
</body>
</html>