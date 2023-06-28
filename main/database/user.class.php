<?php

class User {
  public int $id;
  public string $username;
  public string $name;
  public string $email;
  public string $role;

  public function __construct(int $id, string $username, string $name, string $email, string $role)
  {
    $this->id = $id;
    $this->username = $username;
    $this->name = $name;
    $this->email = $email;
    $this->role = $role;
  }

  static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
    $stmt = $db->prepare('
        SELECT user_id, username, name, email, role
        FROM Users
        WHERE username = ? AND password = ?
        ');
        //$realPass=hash('sha256',$password);
    $stmt->execute(array($username, $password));

    if ($user = $stmt->fetch()) {
        
      return new User(
        (int)$user['user_id'],
        $user['username'],      
        $user['name'],
        $user['email'],
        $user['role'],
      );
    }else return null;
  }

  static function getAgents(PDO $db) : array {
    $stmt = $db->prepare('
        SELECT user_id, username, name, email, role
        FROM Users
        WHERE role = ?
        ');
    $stmt->execute(array('agent'));

    $agents = array();
    while ($agent = $stmt->fetch()) {
      $agents[] = new User(
        (int)$agent['user_id'],
        $agent['username'],      
        $agent['name'],
        $agent['email'],
        $agent['role']
      );
    }
    

    return $agents;
  }


  static function isLoginCorrect($username, $password) {
    global $dbh;
    $passwordhashed = hash('sha256', $password);
    try {
      $stmt = $dbh->prepare('SELECT * FROM user WHERE username = ? AND Password = ?');
      $stmt->execute(array($username, $passwordhashed));
      if($stmt->fetch() !== false) {
        return getID($username);
      }
      else return -1;

    } catch(PDOException $e) {
      return -1;
    }
  }

  static function createUser($db, $username, $password, $name, $email) {
    $passwordhashed = hash('sha256', $password);
    global $db;
    try {
  	  $stmt = $db->prepare('INSERT INTO Users(username, password, name, email, role) VALUES (:Username,:Password,:Name,:Email,:Role)');
  	  $stmt->bindParam(':Username', $username);
  	  $stmt->bindParam(':Password', $passwordhashed);
  	  $stmt->bindParam(':Name', $name);
  	  $stmt->bindParam(':Email', $email);
      $stmt->bindValue(':Role', "client", PDO::PARAM_STR);
      if ($stmt->execute()){
        return true;
      }
      else{
        return false;
      }
    }catch(PDOException $e) {
      
      return -1;
    }
    
  }

  static function getUser($db, $user_id) {
    try {
      $stmt = $db->prepare('SELECT user_id, name, role FROM Users WHERE user_id = ?');
      $stmt->execute(array($user_id));
      return $stmt->fetch();
    
    }catch(PDOException $e) {
      return null;
    }
  }

  static function deleteUser($userID) {
    global $dbh;
    try {
      $stmt = $dbh->prepare('DELETE FROM Users WHERE user_id = ?');
      $stmt->execute(array($userID));
      return true;
    }
    catch(PDOException $e) {
      return false;
    }
  }

  static function getID($username) {
    global $dbh;
    try {
      $stmt = $dbh->prepare('SELECT user_id FROM Users WHERE username = ?');
      $stmt->execute(array($username));
      if($row = $stmt->fetch()){
        return $row['user_id'];
      }
    
    }catch(PDOException $e) {
      return -1;
    }
  }

  static function duplicateUsername($db, $username) {
    try {
      $stmt = $db->prepare('SELECT * FROM Users WHERE username = ?');
      $stmt->execute(array($username));
      return $stmt->fetch()  !== false;
    
    }catch(PDOException $e) {
      return true;
    }
  }

  static function duplicateEmail($db, $email) {
    global $db;
    try {
      $stmt = $db->prepare('SELECT * FROM Users WHERE email = ?');
      $stmt->execute(array($email));
      return $stmt->fetch() !== false;
    
    }catch(PDOException $e) {
      return true;
    }
  }
  
  static function getUsersLike($username) {
    global $dbh;
    try {

      $stmt = $dbh->prepare('SELECT username FROM Users WHERE lower(username) LIKE lower(?) LIMIT 4');
      $stmt->execute(array("$username%"));
      return $stmt->fetchAll();
    
    }catch(PDOException $e) {
      return null;
    }
  }

  static function updateUserInfo($userID, $name, $username, $email){
    global $dbh;

    try {
      $stmt = $dbh->prepare('UPDATE Users SET Name = ?, username = ?, email = ? WHERE user_id = ?');
      if($stmt->execute(array($name, $username, $email, $userID)))
          return true;
      else{
        return false;
      }   
    }catch(PDOException $e) {
      return false;
    }
  }

  static function updateUserPassword($userID, $newpassword){
    $passwordhashed = hash('sha256', $newpassword);
    global $dbh;

    try {
      $stmt = $dbh->prepare('UPDATE Users SET password = ? WHERE user_id = ?');
      if($stmt->execute(array($passwordhashed, $userID)))
          return true;
      else{
        return false;
      }   
    }catch(PDOException $e) {
      return false;
    }
  }
}
