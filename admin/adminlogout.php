<?php

session_start();
session_destroy();
header("location:http://localhost/mobile_shopping/admin/adminlogin.php");

?>