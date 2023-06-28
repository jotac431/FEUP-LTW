<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/ticket.class.php');



  $db = getDatabaseConnection();
  

  $ticket = Ticket::getTicket($db,(int)$_POST['ticket_id']);

  if ($ticket) {
    $ticket->agent_id = (int)$_POST['user_id'];
    $ticket->status = "assigned";
    $ticket->save($db);
    $next="Location:../pages/ticket.php?id=". $_POST['ticket_id'];
    header($next);
  }
  else{
    $_SESSION['ERROR'] = 'Something went wrong';
    header("Location:".$_SERVER['HTTP_REFERER']."");
  }
  


?>