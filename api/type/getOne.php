
<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Type.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog type object
  $type = new Type($db);
  // Get ID
  $type->id_type = isset($_GET['id']) ? $_GET['id'] : die();
  // Get type
  $type->read_single();
  // Create array
  $type_arr = array(
    'id_type' => $type->id_type,
    'name' => $type->name
  );
  // Make JSON
  print_r(json_encode($type_arr));

  ?>