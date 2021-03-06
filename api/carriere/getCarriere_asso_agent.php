
<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Carriere.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog carriere object
  $carriere = new carriere($db);
  // Get ID
  $carriere->id_agent = isset($_GET['id']) ? $_GET['id'] : die();
  // Get carriere
  $result = $carriere->read_asso_agent();

    // Get row count
    $num = $result->rowCount();
    // Check if any carriere
  
    if($num > 0) {
          // carriere array
          $carriere_arr = array();
          $carriere_arr['data'] = array();
          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $carriere_item = array(
              'id' => $id,
              'name' => $name,
              'continent' => $continent,
              'owner' => $owner,
              'status' => $status
            );
            // Push to "data"
            array_push($carriere_arr['data'], $carriere_item);
          }
          // Turn to JSON & output
          echo json_encode($carriere_arr);
    } else {
          // No carrieres
          echo json_encode(
            array('message' => 'No carrieres Found')
          );
    }
  ?>


