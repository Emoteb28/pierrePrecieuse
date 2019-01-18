
<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Pierre.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog pierre object
  $pierre = new Pierre($db);
  // Get ID
  $pierre->id = isset($_GET['id']) ? $_GET['id'] : die();
  // Get pierre
  $pierre->read_single();
  // Create array
  $pierre_arr = array(
    'id' => $pierre->id,
    'denomination' => $pierre->denomination,
    'color' => $pierre->color,
    'weight' => $pierre->weight,
    'size' => $pierre->size,
    'quality' => $pierre->quality,
    'type' => $pierre->type
  );
  // Make JSON
  print_r(json_encode($pierre_arr));

  ?>
