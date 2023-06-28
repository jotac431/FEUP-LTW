<?php

declare(strict_types=1);

class Ticket
{
    public int $id;
    public int $client_id;
    public int $agent_id;
    public int $dept_id;
    public string $dept_name;
    public string $subject;
    public string $description;
    public string $status;


    public function __construct(int $id, int $client_id, int $agent_id, int $dept_id, string $dept_name, string $subject, string $description, string $status)
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->agent_id = $agent_id;
        $this->dept_id = $dept_id;
        $this->dept_name = $dept_name;
        $this->subject = $subject;
        $this->description = $description;
        $this->status = $status;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE Tickets SET agent_id = ?, status = ?
        WHERE ticket_id = ?
      ');

      $stmt->execute(array($this->agent_id, $this->status, $this->id));
    }

    static function getAgentName(PDO $db, int $agent_id) {
        $stmt = $db->prepare('SELECT name FROM Users where user_id = ?');
        $stmt->execute(array($agent_id));
        $agentname = $stmt->fetch();
      
        return $agentname["name"];
    }

    static function getDepartmentName(PDO $db, int $dept_id) {
        $stmt = $db->prepare('SELECT name FROM Departments where dept_id = ?');
        $stmt->execute(array($dept_id));
        $depname = $stmt->fetch();
      
        return $depname["name"];
    }

    static function getTicket(PDO $db, int $ticket_id)  {
      $stmt = $db->prepare('SELECT ticket_id, client_id,agent_id,dept_id,subject,description,status FROM Tickets where ticket_id = ?');
      $stmt->execute(array($ticket_id));

      $ticket = $stmt->fetch();

      $dept_name = Ticket::getDepartmentName($db, (int)$ticket['dept_id']);
  
      return new Ticket(
          (int)$ticket['ticket_id'],
          (int)$ticket['client_id'],
          (int)$ticket['agent_id'],
          (int)$ticket['dept_id'],
          $dept_name,
          $ticket['subject'],
          $ticket['description'],
          $ticket['status'],
        );
    }

    static function getClientTickets(PDO $db, int $client_id) : array {
        $stmt = $db->prepare('SELECT ticket_id, client_id,agent_id,dept_id,subject,description,status FROM Tickets where client_id = ?');
        $stmt->execute(array($client_id));
    
        $tickets = array();
        while ($ticket = $stmt->fetch()) {
          $dept_name = Ticket::getDepartmentName($db, (int)$ticket['dept_id']);
          $tickets[] = new Ticket(
            (int)$ticket['ticket_id'],
            (int)$ticket['client_id'],
            (int)$ticket['agent_id'],
            (int)$ticket['dept_id'],
            $dept_name,
            $ticket['subject'],
            $ticket['description'],
            $ticket['status'],
          );
        }
        
    
        return $tickets;
      }

      static function getAssignedTickets(PDO $db, int $agent_id) : array {
        $stmt = $db->prepare('SELECT ticket_id, client_id,agent_id,dept_id,subject,description,status FROM Tickets where agent_id = ?');
        $stmt->execute(array($agent_id));
    
        $tickets = array();
        while ($ticket = $stmt->fetch()) {
          $dept_name = Ticket::getDepartmentName($db, (int)$ticket['dept_id']);
          $tickets[] = new Ticket(
            (int)$ticket['ticket_id'],
            (int)$ticket['client_id'],
            (int)$ticket['agent_id'],
            (int)$ticket['dept_id'],
            $dept_name,
            $ticket['subject'],
            $ticket['description'],
            $ticket['status'],
          );
        }
        
    
        return $tickets;
      }

      static function getTicketsDepartment(PDO $db, int $dept_id, $offset, $limit) : array {
        $stmt = $db->prepare('SELECT ticket_id, client_id,agent_id,dept_id,subject,description,status FROM Tickets where dept_id = ? LIMIT ?, ?');
        $stmt->execute(array($dept_id, $offset, $limit));
    
        $tickets = array();
        while ($ticket = $stmt->fetch()) {
          $dept_name = Ticket::getDepartmentName($db, (int)$ticket['dept_id']);
          $tickets[] = new Ticket(
            (int)$ticket['ticket_id'],
            (int)$ticket['client_id'],
            (int)$ticket['agent_id'],
            (int)$ticket['dept_id'],
            $dept_name,
            $ticket['subject'],
            $ticket['description'],
            $ticket['status'],
          );
        }
        
    
        return $tickets;
      }

      static function addTicket(PDO $db, int $id, int $dept_id, string $subject, string $description){
        try {
          $stmt = $db->prepare('INSERT INTO Tickets(client_id,dept_id,subject,description,status) VALUES (:client_id,:dept_id,:subject,:description, :status)');
          $stmt->bindParam(':client_id', $id);
          $stmt->bindParam(':dept_id', $dept_id);
          $stmt->bindParam(':subject', $subject);
          $stmt->bindParam(':description', $description);
          $stmt->bindValue(':status', "open", PDO::PARAM_STR);
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
?>
