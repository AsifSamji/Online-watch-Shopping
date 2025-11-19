<?php 
include('connection.php');

if (isset($_POST['add'])) {
    $product_name = $_POST['p_name'];
    $product_price = $_POST['p_price'];
    $product_quantity = $_POST['p_quantity'];
    $product_company = $_POST['p_company'];
    $product_ram = $_POST['p_ram'];
    $product_rom = $_POST['p_rom'];
    $product_color = $_POST['p_color'];
    $product_display = $_POST['p_display'];
    $product_battery = $_POST['p_battery'];
    $product_processor = $_POST['p_processor'];
    $product_camera = $_POST['p_camera'];
    $product_discount = isset($_POST['p_discount']) && $_POST['p_discount'] !== "" ? $_POST['p_discount'] : 0;
    $product_image = $_FILES['p_img'];

    // Image Upload
    $img_loc = $_FILES['p_img']['tmp_name'];
    $img_name = $_FILES['p_img']['name'];
    $img_des = "upload_img/" . $img_name;

    if (!move_uploaded_file($img_loc, $img_des)) {
        die("Error uploading image.");
    }

    // Calculate Discounted Price
    $discounted_price = $product_price - ($product_price * ($product_discount / 100));

    // Insert Query with New Fields
    $query = "INSERT INTO product (P_NAME, P_PRICE, P_QUENTITY, P_COMPANY, P_RAM, P_ROM, P_COLOR, P_DISPLAY, P_BATTERY, P_PROCESSOR, P_CAMERA, P_IMAGE, P_DISCOUNT, P_DISCOUNTED_PRICE) 
              VALUES ('$product_name', '$product_price', '$product_quantity', '$product_company', '$product_ram', '$product_rom', '$product_color', '$product_display', '$product_battery', '$product_processor', '$product_camera', '$img_des', '$product_discount', '$discounted_price')";

    $data = mysqli_query($con, $query) or die("MySQL Error: " . mysqli_error($con));

    if ($data) {
        echo "<script>
                alert('Product added successfully');
                window.location.href='http://localhost/mobile_shopping/admin/product/index.php';
              </script>";
    } else {
        echo "<script>alert('Error inserting data');</script>";
    }
}
?>
