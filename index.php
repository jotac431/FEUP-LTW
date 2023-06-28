<?php
  
  if(!isset($_SESSION['id'])){
    header("Location:main/pages/login.php");
  } else {
  	header("Location:main/pages/home.php");
  }
?>
