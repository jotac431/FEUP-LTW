<?php function drawHeader()
{ ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Ticketaria</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../css/style.css" rel="stylesheet">
        <link href="../../css/ticket.css" rel="stylesheet">
        <link href="../../css/faq.css" rel="stylesheet">
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!--<script src="../js/script.js" defer></script>-->
    </head>

    <body>
        <header>
            <h1><a href="../pages/home.php">Ticketaria</a></h1>
            <nav>
                <ul>
                    <li><a href="../pages/faq.php">FAQ</a></li>
                </ul>
            </nav>
            <?php if (isset($_SESSION['id'])) drawSettingsForm($_SESSION['name']);?>
            <?php if (isset($_SESSION['id'])) drawLogoutForm($_SESSION['name']);?>
        </header>
        <main>
        <?php } ?>

<?php function drawFooter()
        { ?>
        </main>
        <footer id="footer">
            <p id="cp">Copyright &copy; Ticketaria</p>
        </footer>
    </body>

    </html>
<?php } ?>

<?php function drawLogoutForm(string $name) { ?>
  <form action="../actions/action_logout.php" method="post" class="logout">
    <button id="logout-but" type="submit" >Logout</button>
  </form>
<?php } ?>

<?php function drawSettingsForm(string $name) { ?>
  <form action="../pages/settings.php" method="post" class="settings">
    <button id="settings-but" type="submit" >Settings</button>
  </form>
<?php } ?>