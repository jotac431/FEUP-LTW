<?php

declare(strict_types=1);

class Comment
{
    public int $ticket_id;
    public int $user_id;
    public string $text;
    public string $username;
    public string $role;


    public function __construct(int $ticket_id, int $user_id, string $text, string $username, string $role)
    {
        $this->ticket_id = $ticket_id;
        $this->user_id = $user_id;
        $this->text = $text;
        $this->username = $username;
        $this->role = $role;
    }

    static function getTicket(PDO $db, int $ticket_id) {
        $stmt = $db->prepare('SELECT name FROM Tickets where ticket_id = ?');
        $stmt->execute(array($ticket_id));
        $ticket = $stmt->fetch();
      
        return $ticket["ticket_id"];
    }

    static function getUsername(PDO $db, int $user_id) {
        $stmt = $db->prepare('SELECT name FROM Users where user_id = ?');
        $stmt->execute(array($user_id));
        $user = $stmt->fetch();
      
        return $user["name"];
    }

    static function getRole(PDO $db, int $user_id) {
      $stmt = $db->prepare('SELECT role FROM Users where user_id = ?');
      $stmt->execute(array($user_id));
      $user = $stmt->fetch();
    
      return $user["role"];
  }


    static function getComments(PDO $db, int $ticket_id) : array {
        $stmt = $db->prepare('SELECT ticket_id, user_id, text FROM Comment where ticket_id = ?');
        $stmt->execute(array($ticket_id));
    
        $comments = array();
        while ($comment = $stmt->fetch()) {
          $username = Comment::getUsername($db, (int)$comment['user_id']);
          $role = Comment::getRole($db, (int)$comment['user_id']);
          $comments[] = new Comment(
            (int)$comment['ticket_id'],
            (int)$comment['user_id'],
            $comment['text'],
            $username,
            $role
          );
        }
        
    
        return $comments;
      }

      static function addComment(PDO $db, int $ticket_id, int $user_id, string $text){
        try {
          $stmt = $db->prepare('INSERT INTO Comment(ticket_id,user_id,text) VALUES (:ticket_id,:user_id,:text)');
          $stmt->bindParam(':ticket_id', $ticket_id);
          $stmt->bindParam(':user_id', $user_id);
          $stmt->bindParam(':text', $text);
          if ($stmt->execute()){
            return true;
          }
          else{
            return false;
          }
        
        }catch(PDOException $e) {
          return true;
        }
      }
}
