<?php
include '../header2.php';
include("connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM product WHERE ID='$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
}



if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['p_name'];
    $price = $_POST['p_price'];
    $quantity = $_POST['p_quantity'];
    $company = $_POST['p_company'];
    $ram = $_POST['p_ram'];
    $rom = $_POST['p_rom'];
    $color = $_POST['p_color'];
    $display = $_POST['p_display'];
    $battery = $_POST['p_battery'];
    $processor = $_POST['p_processor'];
    $camera = $_POST['p_camera'];
    $discount = $_POST['p_discount'];

    $query = "UPDATE product SET 
                P_NAME='$name', P_PRICE='$price', P_QUENTITY='$quantity', 
                P_COMPANY='$company', P_RAM='$ram', P_ROM='$rom', 
                P_COLOR='$color', P_DISPLAY='$display', P_BATTERY='$battery', 
                P_PROCESSOR='$processor', P_CAMERA='$camera', P_DISCOUNT='$discount' 
              WHERE ID='$id'";

    if(mysqli_query($con, $query)) {
        echo "<script>alert('Product updated successfully!'); window.location.href='view_update.php';</script>";
    } else {
        echo "<script>alert('Error updating product');</script>";
    }
}
?>

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>
  <style>
    body { 
      font-family: Arial, sans-serif; 
      background: #f9f9f9;
      margin: 0;
      padding: 20px;
    }
    .form-container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-container h2 { 
      text-align: center;
      margin-bottom: 20px; 
    }
    .form-columns {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .form-column {
      flex: 1;
      min-width: 300px;
    }
    .form-container label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    .form-container input[type="text"],
    .form-container input[type="number"],
    .form-container select {
      width: 100%;
      padding: 8px;
      height: 40px;
      margin-bottom: 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .form-container input[type="submit"] {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 15px;
      width: 100%;
      font-size: 16px;
      margin-top: 10px;
      border-radius: 4px;
      cursor: pointer;
    }
    .form-container input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Update Product</h2>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

      <div class="form-columns">
        <!-- Left Column -->
        <div class="form-column">
          <label>Product Name:</label>
          <input type="text" name="p_name" value="<?php echo $row['P_NAME']; ?>" required>

          <label>Price:</label>
          <input type="number" name="p_price" step="0.01" value="<?php echo $row['P_PRICE']; ?>" required>

          <label>Quantity:</label>
          <input type="number" name="p_quantity" value="<?php echo $row['P_QUENTITY']; ?>" required>

          <label>Select Your Phone Company:</label>
          <select name="p_company" required>
            <option value="apple" <?php if($row['P_COMPANY'] == "apple") echo "selected"; ?>>Apple</option>
            <option value="samsung" <?php if($row['P_COMPANY'] == "samsung") echo "selected"; ?>>Samsung</option>
            <option value="vivo" <?php if($row['P_COMPANY'] == "vivo") echo "selected"; ?>>Vivo</option>
            <option value="oppo" <?php if($row['P_COMPANY'] == "oppo") echo "selected"; ?>>Oppo</option>
            <option value="realme" <?php if($row['P_COMPANY'] == "realme") echo "selected"; ?>>Realme</option>
            <option value="motorola" <?php if($row['P_COMPANY'] == "motorola") echo "selected"; ?>>Motorola</option>
            <option value="huawei" <?php if($row['P_COMPANY'] == "huawei") echo "selected"; ?>>Huawei</option>
            <option value="xiaomi" <?php if($row['P_COMPANY'] == "xiaomi") echo "selected"; ?>>Xiaomi</option>
          </select>

          <label>RAM:</label>
          <select name="p_ram" required>
            <?php
            $ramOptions = ["2GB", "3GB", "4GB", "6GB", "8GB", "12GB", "16GB"];
            foreach ($ramOptions as $ram) {
                echo "<option value='$ram' ".($row['P_RAM'] == $ram ? "selected" : "").">$ram</option>";
            }
            ?>
          </select>

          <label>ROM:</label>
          <select name="p_rom" required>
            <?php
            $romOptions = ["16GB", "32GB", "64GB", "128GB", "256GB", "512GB", "1TB"];
            foreach ($romOptions as $rom) {
                echo "<option value='$rom' ".($row['P_ROM'] == $rom ? "selected" : "").">$rom</option>";
            }
            ?>
          </select>
        </div>
        
        <!-- Right Column -->
        <div class="form-column">
          <label>Color:</label>
          <input type="text" name="p_color" value="<?php echo $row['P_COLOR']; ?>" required>

          <label>Display:</label>
          <input type="text" name="p_display" value="<?php echo $row['P_DISPLAY']; ?>" required>

          <label>Battery:</label>
          <input type="text" name="p_battery" value="<?php echo $row['P_BATTERY']; ?>" required>

          <label>Processor:</label>
          <input type="text" name="p_processor" value="<?php echo $row['P_PROCESSOR']; ?>" required>

          <label>Camera:</label>
          <input type="text" name="p_camera" value="<?php echo $row['P_CAMERA']; ?>" required>

          <label>Discount (%):</label>
          <input type="number" name="p_discount" step="0.01" value="<?php echo $row['P_DISCOUNT']; ?>">
        </div>
      </div>
      <input type="submit" name="update" value="Update Product">
    </form>
  </div>
</body>
</html>
