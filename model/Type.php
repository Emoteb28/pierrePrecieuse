<?php
  class Type {
    // DB Stuff
    private $conn;
    private $table = 'type';
    // Properties
    public $id_type;
    public $name;

    public $total;
    public $id_carriere;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get types
    public function read() {
      // Create query
      $query = "SELECT id_type, name FROM $this->table;";
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    // Get Single type
  public function read_single(){
    // Create query
    $query = 'SELECT id_type,name FROM ' . $this->table . '
      WHERE id_type = ?
      LIMIT 0,1';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id_type);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // set properties
      $this->id_type = $row['id_type'];
      $this->name = $row['name'];
  }


  public function totalType_asso_carriere(){
    // Create query
    $query = 'SELECT  t.name , count(p.id_type) as total FROM ' . $this->table . ' t inner
              join pierre p on t.id_type = p.id_type inner join
              recueil r on p.id = r.id_pierre where r.id_carriere = ? 
              group by t.name';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id_carriere);
      // Execute query
      $stmt->execute();
      return $stmt;
  }


}

?>