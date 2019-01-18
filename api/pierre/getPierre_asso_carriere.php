
<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Pierre.php';
  require_once '../../model/Type.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog pierre object
  $pierre = new Pierre($db);
  // Instantiate blog type object
  $type = new Type($db);
  // Get ID
  $pierre->id_carriere = isset($_GET['id']) ? $_GET['id'] : die();
  // Get ID
  $type->id_carriere = isset($_GET['id']) ? $_GET['id'] : die();
  // Get pierre
  $result = $pierre->read_asso_carriere();
    // Get type
  $result2 = $type->totalType_asso_carriere();

    // Get row count
    $num = $result->rowCount();
    // Get row count
    $num2 = $result2->rowCount();

    // Check if any pierre
  
    if($num > 0) {

        //------
        // type array
        $pierre_arr = array();
        $pierre_arr['total'] = array();
        while($row = $result2->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $type_item = array(
            'type' => $name ,
            'total_pierre' => $total
          );
          // Push to "total"
          array_push($pierre_arr['total'], $type_item);
        }

        //------
          // pierre array
          
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
