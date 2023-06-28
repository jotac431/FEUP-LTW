<?php
    session_start();

    if (!isset($_SESSION['id'])) die(header('Location: /'));

    require_once('../database/connection.php');
    require_once('../database/ticket.class.php');
    require_once('../database/comment.class.php');
    require_once('../database/user.class.php');
    require_once('../contents/common.php');
    require_once('../contents/tickets.php');

    $db = getDatabaseConnection();

    $ticket = Ticket::getTicket($db, $_GET['id']);
    $comments = Comment::getComments($db, $_GET['id']);

    drawHeader();
    if ($_SESSION['role'] === "agent"){
        $agents = User::getAgents($db);
        drawAssign($agents);
    }
    drawTicketPage($ticket, $comments);
    drawFooter();
?>
