<?php

declare(strict_types=1);
session_start();

require_once('../database/connection.php');
require_once('../database/user.class.php');
$db = getDatabaseConnection();

if (User::duplicateUsername($db, $_POST['username'])) {
  $_SESSION['ERROR'] = 'Duplicated Username';
  header("Location:" . $_SERVER['HTTP_REFERER'] . "");
} else if (User::duplicateEmail($db, $_POST['email'])) {
  $_SESSION['ERROR'] = 'Duplicated Email';
  header("Location:" . $_SERVER['HTTP_REFERER'] . "");
} else if (strlen($_POST['password']) < 6) {
  $_SESSION['ERROR'] = 'Password must have at least 6 characters';
  header("Location:" . $_SERVER['HTTP_REFERER'] . "");
} else if ($_POST['password'] != $_POST['passwordagain']) {
  $_SESSION['ERROR'] = 'Passwords dont match';
  header("Location:" . $_SERVER['HTTP_REFERER'] . "");
} else if ((User::createUser($db, $_POST['username'], $_POST['password'], $_POST['name'], $_POST['email'])) != -1) {
  echo 'User Registered successfully';
  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);
  if ($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION['name'] = $user->name;
    $_SESSION['username'] = $user->username;
    $_SESSION['role'] = $user->role;

    header('Location: ../pages/home.php');
  } else {
    $_SESSION['ERROR'] = 'Registration failed.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
