<?php
    session_start();

    require_once('../contents/common.php');
    require_once('../contents/faq.php');

    drawHeader();

    drawFaq();

    drawFooter();
?>