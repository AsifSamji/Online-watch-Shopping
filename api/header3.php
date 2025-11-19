<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Brand Header</title>
  <style>

    /* Reset default styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

.brand-header {
    background-color: #343a40;
    height: \50px;
    position: fixed;
    top: 70px;
    z-index: 1000;
    width: 100%;
}

.brand-nav {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
  max-width: 100%;
}

.brand-nav a {
  text-decoration: none;
  color: white;
  font-weight: bold;
  padding: 8px 12px;
  transition: color 0.3s ease;
}

.brand-nav a:hover {
  color: #007bff;
}


  </style>
</head>
<body>
  <header class="brand-header">
    <nav class="brand-nav">
      <a href="apple.php">Apple</a>
      <a href="mototrola.php">Motorola</a>
      <a href="samsung.php">Samsung</a>
      <a href="xiaomi.php">Xiaomi</a>
      <a href="homepage.php">Home</a>
      <a href="realme.php">Realme</a>
      <a href="vivo.php">Vivo</a>
      <a href="oppo.php">Oppo</a>
      <a href="oneplus.php">OnePlus</a>
    </nav>
  </header>
</body>
</html>
