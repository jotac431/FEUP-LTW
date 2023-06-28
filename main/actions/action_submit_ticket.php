<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/ticket.class.php');



  $db = getDatabaseConnection();
  

  if (Ticket::addTicket($db, $_SESSION['id'], (int)$_POST['dept_id'],$_POST['subject'],$_POST['description'])){
    header("Location:../pages/home.php");
  }
  
  else{
    $_SESSION['ERROR'] = 'ERROR';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  


?>