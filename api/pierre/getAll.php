<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Pierre.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate pierre object
  $pierre = new Pierre($db);
  // pierre read query
  $result = $pierre->read();
  
  // Get row count
  $num = $result->rowCount();
  // Check if any pierre

  if($num > 0) {
        // pierre array
        $pierre_arr = array();
        $pierre_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $pierre_item = array(
            'id' => $id,
            'denomination' => $denomination,
            'color' => $color,
            'weight' => $weight,
            'size' => $size,
            'quality' => $quality,
            'type' => $name
          );
          // Push to "data"
          array_push($pierre_arr['data'], $pierre_item);
        }
        // Turn to JSON & output
        echo json_encode($pierre_arr);
  } else {
        // No pierres
        echo json_encode(
          array('message' => 'No pierres Found')
        );
  }



  ?>

