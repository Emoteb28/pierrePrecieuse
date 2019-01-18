
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
  $carriere->id = isset($_GET['id']) ? $_GET['id'] : die();
  // Get carriere
  $carriere->read_single();
  // Create array
  $carriere_arr = array(
    'id' => $carriere->id,
    'name' => $carriere->name,
    'continent' => $carriere->continent,
    'owner' => $carriere->owner,
    'status' => $carriere->status
  );
  // Make JSON
  print_r(json_encode($carriere_arr));

  ?>