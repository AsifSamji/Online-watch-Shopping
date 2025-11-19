<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Online Mobile Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Carousel
        .carousel-inner img {
            height: 400px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .carousel-inner img:hover {
            transform: scale(1.05);
        } */

        @media (max-width: 768px) {
            .carousel-inner img {
                height: 250px;
            }
        }

        /* Product Slider */
        .product-slider {
            
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 20px 0;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .product-slider::-webkit-scrollbar {
            display: none;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            flex: 0 0 300px;
            max-width: 350px;
            background: #fff;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: contain;
            transition: transform 0.3s ease-in-out;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        /* Scroll Buttons */
        .scroll-btn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 24px;
            color: #007bff;
            transition: color 0.3s ease-in-out;
        }

        .scroll-btn:hover {
            color: #0056b3;
        }

        /* Special Offers & Companies */
        .offer-section, .company-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 20px 0;
        }

        .offer-section .card, .company-section .card {
            max-width: 350px;
            flex: 0 0 350px;
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .offer-section .card:hover, .company-section .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .card {
                flex: 0 0 90%;
                max-width: 100%;
            }
            .scroll-btn {
                font-size: 18px;
            }
        }

    </style>
</head>
<body>

    <!-- Header -->
    <?php include 'header.php'; ?>
    
<!-- Mobile Companies Logo Section -->
<div class="container mt-4 text-center">
    <h3 class="mb-3">Top Mobile Brands</h3>
    <div class="asif d-flex justify-content-center flex-wrap gap-3">
        <a href='apple.php'><div class='brand-logo'><img src='images/logoa4.jpg' alt='Apple'></div></a>
        <a href='motorola.php'><div class='brand-logo'><img src='images/logomotorola.png' alt='Motorola'></div></a>
        <a href='samsung.php'><div class='brand-logo'><img src='images/logos3.png' alt='Samsung'></div></a>
        <a href='xiaomi.php'><div class='brand-logo'><img src='images/logoxiaomi.png' alt='Xiaomi'></div></a>
        <a href='homepage.php'><div class='brand-logo'><img src='images/product.AVIF' alt='Xiaomi'></div></a>
        <a href='realme.php'><div class='brand-logo'><img src='images/logorealme.png' alt='Realme'></div></a>
        <a href='vivo.php'><div class='brand-logo'><img src='images/logovivo.png' alt='Vivo'></div></a>
        <a href='oppo.php'><div class='brand-logo'><img src='images/logooppo1.png' alt='Oppo'></div></a>
        <a href='oneplus.php'><div class='brand-logo'><img src='images/logooneplus1.png' alt='OnePlus'></div></a>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        text-align: center;
    }

    .asif .d-flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .brand-logo {
        width: 120px; 
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 50%;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        overflow: hidden;
        margin-bottom:40px;
    }

    .brand-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .brand-logo:hover {
        transform: scale(1.1);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
    }
</style>

<a href="homepage.php" style="
    display: inline-block; 
    padding: 10px 20px; 
    background-color: #ff6600; 
    color: white; 
    font-size: 18px; 
    font-weight: bold; 
    text-decoration: none; 
    border-radius: 8px; 
    transition: background-color 0.3s ease-in-out, transform 0.2s; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
     margin-bottom:40px;
">
    Shop Now
</a>


<!-- Video Slider -->
<div class="video-container">
    <video id="myVideo" class="d-block w-100" autoplay loop muted playsinline>
        <source src="images/new.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('myVideo');

        // Ensure the video starts at the beginning once loaded
        video.addEventListener('loadedmetadata', function () {
            video.currentTime = 0;
        });

        video.addEventListener('timeupdate', function () {
            // Reset the video to the beginning when it reaches the end (e.g., at 30s)
            if (video.currentTime >= 44) {
                video.currentTime = 0;
            }
        });
    });
</script>

<style>
.video-container {
   
    width: 100%;
    height: 450px; /* Fixed height */
    overflow: hidden;
}

video {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Maintain aspect ratio without cutting */
    background-color: black; /* Add background color to fill empty space */
}
</style>


    <!-- Latest Products Section -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Products </h3>
        <div class="d-flex align-items-center justify-content-center">
            <button class="scroll-btn" onclick="scrollLeft()">&#10094;</button>
            <div class="product-slider">
                <?php
                    include 'connection.php';
                    $query = "SELECT * FROM product";
                    $data = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($data)) {
                        echo "<div class='card'>
                                <img src='../admin/product/$row[P_IMAGE]' class='card-img-top' alt='$row[P_NAME]'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$row[P_NAME]</h5>
                                    <p class='card-text'>Rs: $row[P_PRICE]</p>
                                    <form action='addcart.php' method='POST'>
                                        <input type='hidden' name='product_id' value='$row[ID]'>
                                        <input type='hidden' name='p_quentity' value='1' min='1' max='$row[P_QUENTITY]' class='form-control mb-2' required>
                                        <button type='submit' class='btn btn-primary w-100'>Add to Cart</button>
                                    </form>
                                </div>
                              </div>";
                    }
                ?>
            </div>
            <button class="scroll-btn" onclick="scrollRight()">&#10095;</button>
        </div>
    </div>

    <!-- Special Offers Section -->
    <div class="container mt-5 offer-section d-flex justify-content-center gap-4 flex-wrap">
        <a href="discount.php" style="text-decoration: none; color: inherit; display: block; width: 100%; max-width: 350px;">
            <div class="card text-center p-0">
                <img src="images/discount2.jpg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Discount Offer">
                <div class="card-body">
                    <h5 class="card-title">Special Discount</h5>
                    <p class="card-text">Get up to 20% off on select models.</p>
                </div>
            </div>
        </a>

        <a href="tranding.php" style="text-decoration: none; color: inherit; display: block; width: 100%; max-width: 350px;">
            <div class="card text-center p-0">
                <img src="images/trending3.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Trending Mobiles">
                <div class="card-body">
                    <h5 class="card-title">Trending Mobiles</h5>
                    <p class="card-text">Explore the latest trending phones.</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Mobile Companies Section -->
    <div class="container mt-5 company-section d-flex justify-content-center gap-4 flex-wrap">
        <div class="card text-center p-0">
            <img src="images/iphon.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Apple iPhones">
            <div class="card-body">
                <h5 class="card-title">Apple iPhones</h5>
                <a href="apple.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/s2.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Samsung Phones">
            <div class="card-body">
                <h5 class="card-title">Samsung Phones</h5>
                <a href="samsung.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/vivo.jpg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Vivo Phones">
            <div class="card-body">
                <h5 class="card-title">Vivo Phones</h5>
                <a href="vivo.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/oppo1.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Oppo Phones">
            <div class="card-body">
                <h5 class="card-title">Oppo Phones</h5>
                <a href="oppo.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/realme.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Realme Phones">
            <div class="card-body">
                <h5 class="card-title">Realme Phones</h5>
                <a href="realme.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/hueivei.WEBP" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Huawei Phones">
            <div class="card-body">
                <h5 class="card-title">Huawei Phones</h5>
                <a href="huawei.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/motorola.AVIF" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Motorola Phones">
            <div class="card-body">
                <h5 class="card-title">Motorola Phones</h5>
                <a href="motorola.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/xx1.png" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Laptops">
            <div class="card-body">
                <h5 class="card-title">Xiaomi </h5>
                <a href="xiaomi.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
        <div class="card text-center p-0">
            <img src="images/logooneplus.png" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Laptops">
            <div class="card-body">
                <h5 class="card-title">OnePlus </h5>
                <a href="oneplus.php" class="btn btn-outline-secondary btn-sm">View More</a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function scrollLeft() {
            document.querySelector('.product-slider').scrollBy({ left: -200, behavior: 'smooth' });
        }

        function scrollRight() {
            document.querySelector('.product-slider').scrollBy({ left: 200, behavior: 'smooth' });
        }
    </script>

</body>
</html>