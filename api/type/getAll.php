<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Type.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate type object
  $type = new Type($db);
  // type read query
  $result = $type->read();
  
  // Get row count
  $num = $result->rowCount();
  // Check if any type

  if($num > 0) {
        // type array
        $type_arr = array();
        $type_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $type_item = array(
            'id_type' => $id_type,
            'name' => $name
          );
          // Push to "data"
          array_push($type_arr['data'], $type_item);
        }
        // Turn to JSON & output
        echo json_encode($type_arr);
  } else {
        // No types
        echo json_encode(
          array('message' => 'No Types Found')
        );
  }



  ?>