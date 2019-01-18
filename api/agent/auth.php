
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
  // Get email
  $agent->email = isset($_GET['email']) ? $_GET['email'] : die();
  //get password
  $agent->password = isset($_GET['password']) ? $_GET['password'] : die();
  // Get agent
  $agent->auth();
  // Create array
  $agent_arr = array(
    'status' => '200 (connected)',
    'agent' => [
    'id' => $agent->id,
    'fullname' => $agent->fullname,
    'continent' => $agent->continent,
    'email' => $agent->email,
    'password' => $agent->password
    ]
    
  );
  if(!is_null($agent->id)){
      // Make JSON
        print_r(json_encode($agent_arr));
  }else {
    // No agent
    echo json_encode(
      array('message' => 'email or password are wrong')
    );
}


  ?>