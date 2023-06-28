<?php
    session_start();

    require_once('../contents/common.php');
    require_once('../settings/account.php');

    drawHeader();

    drawSettings();

    drawFooter();
?>