<?php

declare(strict_types=1);

class Department
{
    public int $dept_id;
    public string $name;


    public function __construct(int $dept_id, string $name)
    {
        $this->dept_id = $dept_id;
        $this->name = $name;
    }


    static function getDepartments(PDO $db) {
      $stmt = $db->prepare('SELECT dept_id, name FROM Departments');
      $stmt->execute();
      $deps = array();

      while ($dep = $stmt->fetch()) {
        $deps[] = new Department(
            (int)$dep['dept_id'],
            $dep['name']
          );
      }
      return $deps;
  }
}
?>
