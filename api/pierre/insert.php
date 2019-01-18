<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  require_once '../../config/Database.php';
  require_once '../../model/Pierre.php';
  require_once '../../model/Recueil.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Pierre object
  $pierre = new Pierre($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $pierre->denomination = $data->denomination;
  $pierre->color = $data->color;
  $pierre->weight = $data->weight;
  $pierre->size = $data->size;
  $pierre->quality = $data->quality;
  $pierre->type = $data->id_type;

  // Create pierre
  if($pierre->create_pierre()) {

      // Instantiate blog Recueil object
  $recueil = new Recueil($db);

  $recueil->id_agent = $data->id_agent;
  $recueil->id_pierre = $db->lastInsertId();
  $recueil->id_carriere = $data->id_carriere;

  // Create recueil
  if($recueil->create_recueil()) {

    echo json_encode(
        array('pierreStatus' => 'pierre Created',
              'recueilStatus' => 'recueil Created' ,
              'lastId' => $recueil->id_pierre)
      );
  } else {
    echo json_encode(
      array('message1' => 'recueil Not Created')
    );
  }

  } else {
    echo json_encode(
      array('message2' => 'pierre Not Created')
    );
  }


  //---postman----
  //-Content-Type --->  application/json
  //---http://localhost/php/api_pierre/api/pierre/insert.php----
//   {
// 	"denomination" : "pierre21" ,
// 	"color" : "grey" ,
// 	"weight" : "30" ,
// 	"size" : "big" ,
// 	"quality" : "EX" ,
// 	"id_type" : "1",
// 	"id_agent": "2" ,
// 	"id_carriere": "4" 
// }

  ?>