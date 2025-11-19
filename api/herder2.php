<div class="brand-header">
    <div class="container text-center">
        <div class="brand-wrapper d-flex justify-content-center flex-wrap gap-3">
            <a href="apple.php"><div class="brand-logo"><img src="images/logoa4.jpg" alt="Apple"></div></a>
            <a href="motorola.php"><div class="brand-logo"><img src="images/logomotorola.png" alt="Motorola"></div></a>
            <a href="samsung.php"><div class="brand-logo"><img src="images/logos3.png" alt="Samsung"></div></a>
            <a href="xiaomi.php"><div class="brand-logo"><img src="images/logoxiaomi.png" alt="Xiaomi"></div></a>
            <a href="homepage.php"><div class="brand-logo"><img src="images/product.AVIF" alt="All"></div></a>
            <a href="realme.php"><div class="brand-logo"><img src="images/logorealme.png" alt="Realme"></div></a>
            <a href="vivo.php"><div class="brand-logo"><img src="images/logovivo.png" alt="Vivo"></div></a>
            <a href="oppo.php"><div class="brand-logo"><img src="images/logooppo1.png" alt="Oppo"></div></a>
            <a href="oneplus.php"><div class="brand-logo"><img src="images/logooneplus1.png" alt="OnePlus"></div></a>
        </div>
    </div>
</div>

<!-- Your main page content -->
<div class="page-content">
    <!-- Page content here -->
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    .brand-header {
        /* position: fixed; */
        top: 1000px; /* Adjust if your navbar height is different */
        z-index: 1000;
        width: 100%;
        background-color: white;
        padding: 10px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .brand-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .brand-logo {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 50%;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        overflow: hidden;
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

    .page-content {
        padding-top: 50px; /* Adjusted to prevent content from hiding under header */
    }

    /* RESPONSIVE STYLES */
    @media (max-width: 768px) {
        .brand-wrapper
        {
            margin-top : 130px;
        }
        .brand-logo {
           
            width: 40px;
            height: 40px;
        }
    }

    @media (max-width: 480px) {
        .brand-wrapper
        {
            margin-top : 130px;
        }
        .brand-logo {
            width: 40px;
            height: 40px;
        }

       
    }
</style>
