<?php
  class Agent {
    // DB Stuff
    private $conn;
    private $table = 'agent';
    // Properties
    public $id;
    public $fullname;
    public $cotinent;
    public $email;
    public $password;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get agents
    public function read() {
      // Create query
      $query = "SELECT * FROM $this->table;";
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    // Get Single agent
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
      $this->fullname = $row['fullname'];
      $this->continent = $row['continent'];
      $this->email = $row['email'];
      $this->password = $row['password'];
  }


  // check auth agent
  public function auth() {
    // Create query
    $query = "SELECT * FROM $this->table where email = ?;";
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind email
    $stmt->bindParam(1, $this->email);
    // Execute query
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(password_verify($this->password,$row['password'])){
      // set properties
    $this->id = $row['id'];
    $this->fullname = $row['fullname'];
    $this->continent = $row['continent'];
    $this->email = $row['email'];
    $this->password = $row['password'];
    }
    
  }

}

?>