<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/comment.class.php');



  $db = getDatabaseConnection();
  

  if (Comment::addComment($db, (int)$_POST['ticket_id'], $_SESSION['id'], $_POST['text'])){
    header("Location:../pages/ticket.php?id=".$_POST['ticket_id']);
  }
  
  else{
    $_SESSION['ERROR'] = 'ERROR';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  


?>