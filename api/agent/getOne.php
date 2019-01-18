
<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Agent.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog agent object
  $agent = new Agent($db);
  // Get ID
  $agent->id = isset($_GET['id']) ? $_GET['id'] : die();
  // Get agent
  $agent->read_single();
  // Create array
  $agent_arr = array(
    'id' => $agent->id,
    'fullname' => $agent->fullname,
    'continent' => $agent->continent,
    'email' => $agent->email,
    'password' => $agent->password
  );
  // Make JSON
  print_r(json_encode($agent_arr));

  ?>