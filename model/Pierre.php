<?php
  class Pierre {
    // DB Stuff
    private $conn;
    private $table = 'pierre';
    // Properties
    public $id;
    public $denomination;
    public $color;
    public $weight;
    public $size;
    public $quality;
    public $type;

    public $id_carriere;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get pierres
    public function read() {
      // Create query
      $query = "SELECT p.id , p.denomination , p.color , p.weight, p.size
                , p.quality , t.name FROM $this->table p inner join type t on
                p.id_type = t.id_type;";
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    // Get Single pierre
  public function read_single(){
    // Create query
    $query = "SELECT p.id , p.denomination , p.color , p.weight, p.size
    , p.quality , t.name from $this->table p inner join type t on
    p.id_type = t.id_type WHERE p.id = ? LIMIT 0,1";
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // set properties
      $this->id = $row['id'];
      $this->denomination = $row['denomination'];
      $this->color = $row['color'];
      $this->weight = $row['weight'];
      $this->size = $row['size'];
      $this->quality = $row['quality'];
      $this->type = $row['name'];
  }

      public function create_pierre() {
        // Create query
        $query = "insert into $this->table set denomination= :denomination".
        " ,color= :color ,weight= :weight ,size= :size ,quality= :quality ".
        ",id_type= :id_type;";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->denomination = htmlspecialchars(strip_tags($this->denomination));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->weight = htmlspecialchars(strip_tags($this->weight));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->quality = htmlspecialchars(strip_tags($this->quality));
        $this->$type = htmlspecialchars(strip_tags($this->$type));


        // Bind data
        $stmt->bindParam(':denomination', $this->denomination);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':weight', $this->weight);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':quality', $this->quality);
        $stmt->bindParam(':id_type', $this->type);
        // Execute query
        if($stmt->execute()) {
          return true;
        }else{
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
          return false;
        }
    
    }




    public function read_asso_carriere(){
      // Create query
      $query = 'SELECT p.id , p.denomination , p.color , p.weight, p.size
               , p.quality , t.name FROM ' . $this->table . ' p inner join
                recueil r on p.id = r.id_pierre inner join type t on
                p.id_type = t.id_type where
                r.id_carriere = ?';
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