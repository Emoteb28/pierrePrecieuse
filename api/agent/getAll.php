<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once '../../config/Database.php';
  require_once '../../model/Agent.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate agent object
  $agent = new Agent($db);
  // agent read query
  $result = $agent->read();
  
  // Get row count
  $num = $result->rowCount();
  // Check if any agent

  if($num > 0) {
        // agent array
        $agent_arr = array();
        $agent_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $agent_item = array(
            'id' => $id,
            'fullname' => $fullname,
            'continent' => $continent,
            'email' => $email,
            'password' => $password
          );
          // Push to "data"
          array_push($agent_arr['data'], $agent_item);
        }
        // Turn to JSON & output
        echo json_encode($agent_arr);
  } else {
        // No agents
        echo json_encode(
          array('message' => 'No agents Found')
        );
  }

