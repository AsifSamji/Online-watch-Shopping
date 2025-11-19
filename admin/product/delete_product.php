<?php
include("connection.php");
$id = $_GET['id'];

$query = "SELECT P_IMAGE FROM product WHERE id = '$id'";
$result = mysqli_query($con, $query);
$product = mysqli_fetch_assoc($result);

if ($product) 
{
  // Get the image file path
  $imagePath = $product['P_IMAGE'];

$deletequery = "delete from product where id = '$id' ";
$data = mysqli_query($con,$deletequery);

if($data)
{
  if (file_exists($imagePath)) 
  {
    unlink($imagePath);
  }

    echo "
    <script>
    alert('deleted');
    window.location.href='http://localhost/mobile_shopping/admin/product/view_delete.php';
    </script>";
}
else
{
  die(mysqli_error);
}
}
?>