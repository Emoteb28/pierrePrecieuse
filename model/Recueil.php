<?php
  class Recueil {
    // DB Stuff
    private $conn;
    private $table = 'recueil';
    // Properties
    public $id_agent;
    public $id_pierre;
    public $id_carriere;
    public $date_recueil;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    public function create_recueil() {
        // Create query
        $query = "insert into $this->table set id_agent= :id_agent".
        " ,id_pierre= :id_pierre ,id_carriere= :id_carriere , date_recueil = NOW()";
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->id_agent = htmlspecialchars(strip_tags($this->id_agent));
        $this->id_pierre = htmlspecialchars(strip_tags($this->id_pierre));
        $this->id_carriere = htmlspecialchars(strip_tags($this->id_carriere));
  
  
        // Bind data
        $stmt->bindParam(':id_agent', $this->id_agent);
        $stmt->bindParam(':id_pierre', $this->id_pierre);
        $stmt->bindParam(':id_carriere', $this->id_carriere);
        // Execute query
        if($stmt->execute()) {
          return true;
        }else{
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
          return false;
        }
    
    }

    


}

?>