<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/ticket.class.php');
    require_once('../database/department.class.php');
    require_once('../contents/common.php');
    require_once('../contents/tickets.php');
    
    $db = getDatabaseConnection();

    $departments = Department::getDepartments($db);

    drawHeader();

    $tickets = Ticket::getClientTickets($db, $_SESSION['id']);
    drawCreateTicketButton();
    drawTickets($tickets);
    if ($_SESSION['role'] === "agent"){
        $assigned_tickets = Ticket::getAssignedTickets($db, $_SESSION['id']);
        drawAssignedTickets($assigned_tickets);
    }

    $selectedDepartment = $_GET['dept_id'] ?? 'all';

    // Get the offset and limit values from the query parameters
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

    $tickets_dept = Ticket::getTicketsDepartment($db, (int)$selectedDepartment, $offset, $limit);
    drawTicketsDepartment($tickets_dept, $departments, $offset, $limit, $selectedDepartment);

    drawFooter();
?>