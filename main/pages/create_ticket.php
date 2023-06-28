<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/department.class.php');
    require_once('../contents/common.php');
    require_once('../contents/tickets.php');

    $db = getDatabaseConnection();

    $departments = Department::getDepartments($db);

    drawHeader();
    drawCreateTicket($departments);
    drawFooter();
?>