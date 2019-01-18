<?php
  class Carriere {
    // DB Stuff
    private $conn;
    private $table = 'carriere';
    // Properties
    public $id;
    public $name;
    public $cotinent;
    public $owner;
    public $status;
    public $id_agent;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get carrieres
    public function read() {
      // Create query
      $query = "SELECT * FROM $this->table;";
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    // Get Single carriere
  public function read_single(){
    // Create query
    $query = 'SELECT * FROM ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->continent = $row['continent'];
      $this->owner = $row['owner'];
      $this->status = $row['status'];
  }

   // Get carrieres asso agent
   public function read_asso_agent(){
    // Create query
    $query = 'SELECT distinct c.* FROM ' . $this->table . ' c inner join
              recueil r on c.id = r.id_carriere where
              r.id_agent = ?';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id_agent);
      // Execute query
      $stmt->execute();
      return $stmt;
  }


}

?>