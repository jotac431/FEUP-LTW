<?php

  declare(strict_types=1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/user.class.php');
  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->name;
    $_SESSION['username'] = $user->username;
    $_SESSION['role'] = $user->role;

    header('Location: ../pages/home.php');
  } else {
    $_SESSION['ERROR'] = 'Login failed. Please make sure you typed the right username/password';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }




  /*//old
  $db = new PDO('sqlite:database.db');

  $username = $_POST['username'];
  $password = $_POST['password'];
  //$password = password_hash(string $password, string|int|null $algo, array $options = []): string;

  $stmt = $db->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
  $stmt->execute();

  $user = $stmt->fetch();

  if ($user) $_SESSION['username'] = $user['username'];

  header('Location: /');*/

  ?>
