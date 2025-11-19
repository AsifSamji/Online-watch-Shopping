<?php
include '../header2.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Form</title>
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
    /* Uniform height for all inputs and select options */
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
    /* Styling for file input to match height and centering */
    .file-input-container {
      text-align: center;
      margin-bottom: 12px;
    }
    .file-input-container input[type="file"] {
      width: auto;
      padding: 8px;
      height: 40px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
      cursor: pointer;
    }
    .form-container input[type="submit"] {
      background-color: #4CAF50;
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
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Add New Product</h2>
    <form action="insert.php" method="post" enctype="multipart/form-data">
      <div class="form-columns">
        <!-- Left Column -->
        <div class="form-column">
          <label>Product Name:</label>
          <input type="text" name="p_name" required>

          <label>Price:</label>
          <input type="number" name="p_price" step="0.01" required>

          <label>Quantity:</label>
          <input type="number" name="p_quantity" required>

          <label>Select Your Phone Company:</label>
          <select name="p_company" required>
            <option value="" disabled selected>Select a company</option>
            <option value="apple">Apple</option>
            <option value="samsung">Samsung</option>
            <option value="vivo">Vivo</option>
            <option value="oppo">Oppo</option>
            <option value="realme">Realme</option>
            <option value="motorola">Motorola</option>
            <option value="huawei">Huawei</option>
            <option value="xiaomi">Xiaomi</option>
            <option value="oneplus">Oneplus</option>
          </select>

          <label>RAM:</label>
          <select name="p_ram" required>
            <option value="" disabled selected>Select RAM</option>
            <option value="2GB">2GB</option>
            <option value="3GB">3GB</option>
            <option value="4GB">4GB</option>
            <option value="6GB">6GB</option>
            <option value="8GB">8GB</option>
            <option value="12GB">12GB</option>
            <option value="16GB">16GB</option>
          </select>

          <label>ROM:</label>
          <select name="p_rom" required>
            <option value="" disabled selected>Select ROM</option>
            <option value="16GB">16GB</option>
            <option value="32GB">32GB</option>
            <option value="64GB">64GB</option>
            <option value="128GB">128GB</option>
            <option value="256GB">256GB</option>
            <option value="512GB">512GB</option>
            <option value="1TB">1TB</option>
          </select>
        </div>
        <!-- Right Column -->
        <div class="form-column">
          <label>Color:</label>
          <input type="text" name="p_color" required>

          <label>Display:</label>
          <input type="text" name="p_display" required>

          <label>Battery:</label>
          <input type="text" name="p_battery" required>

          <label>Processor:</label>
          <input type="text" name="p_processor" required>

          <label>Camera:</label>
          <input type="text" name="p_camera" required>

          <label>Discount (%):</label>
          <input type="number" name="p_discount" step="0.01">
        </div>
      </div>
      <!-- File input container centered -->
      <div class="file-input-container">
        <label>Product Image:</label>
        <input type="file" name="p_img" required>
      </div>
      <!-- Submit Button Below the Columns -->
      <input type="submit" name="add" value="Add Product">
    </form>
  </div>
</body>
</html>
