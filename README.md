# HOW TO USE API PIERRE 

1- import database to mysql or phpmyadmin 
   database : pierres_precieuses.sql

2- configuer file config/Database.php

    private $host = 'localhost';
    private $db_name = 'pierres_precieuses';
    private $username = 'phpmyadmin'; //your username
    private $password = 'mamann'; //your password 

3- Rôle de l’API : 
//------------------------------------------------------------------------------------
● authentifier un agent selon son adresse mail et le mdp fourni:

using postman -> METHOD GET : // fournir email & password agent
http://localhost/php/api_pierre/api/agent/auth.php?email=mouad@gmail.com&password=mouad

 
if email and password are correct the api returns :
    {
        "status": "200 (connected)",
        "agent": {
            "id": "2",
            "fullname": "mouad",
            "continent": "europe",
            "email": "mouad@gmail.com",
            "password": "$2y$10$XWzDgfIVTaolCOCB/oUWiOFFURRBdPjq.KbTyLS1/WAZaVyCi6GCy"
        }
    }
else api returns :
    {
    "message": "email or password are wrong"
    }
//------------------------------------------------------------------------------------

● fournir la liste des carrières associées à l’agent :
using postman -> METHOD GET : // fournir id agent
http://localhost/php/api_pierre/api/carriere/getCarriere_asso_agent.php?id=1

if carrieres exists for asso agent , api returns the carrieres:
    {
        "data": [
            {
                "id": "1",
                "name": "carriere de Ayoub",
                "continent": "afrique",
                "owner": "ayoub",
                "status": "ouvert"
            },
            {
                "id": "2",
                "name": "carriere de Mostafa",
                "continent": "afrique",
                "owner": "mostafa",
                "status": "ferme"
            }
        ]
    }
else it returns 
    {
        "message": "No carrieres Found"
    }

//------------------------------------------------------------------------------------
● enregistrer les “recueils” transmis par les agents:
using postman -> METHOD POST : // fournir info pierre et recueil
              -> headers :
                            key : Content-Type  
                            value : application/json
              ->body : row : 
                                {
                                    "denomination" : "diamant" ,
                                    "color" : "grey" ,
                                    "weight" : "30" ,
                                    "size" : "big" ,
                                    "quality" : "EX" ,
                                    "id_type" : "1",
                                    "id_agent": "2" ,
                                    "id_carriere": "4" 
                                 }
● gérer l’état de chaque transmission de données (ok / ko):
if inserted successfully, api returns :
                    {
                        "pierreStatus": "pierre Created",
                        "recueilStatus": "recueil Created",
                        "lastId": "24" // the id of pierre inserted //
                    }    
else 
                    {
                        "message1" : "recueil Not Created"
                    } 
                    OR
                    {
                        "message2" : "pierre Not Created"
                    } 

//-----------------------------------------------------------------------

● fournir une liste des stocks de pierres disponibles pour chaque
carrière, selon les recueils fournis par les agents :

using postman -> METHOD GET : // fournir id carriere
http://localhost/php/api_pierre/api/pierre/getPierre_asso_carriere.php?id=4 
        
if exists pierre asso carriere exists , api returns : 
          {
                "total": [
                    {
                        "type": "fines",
                        "total_pierre": "3"
                    },
                    {
                        "type": "organiques",
                        "total_pierre": "1"
                    },
                    {
                        "type": "precieuses",
                        "total_pierre": "2"
                    }
                ],
                "data": [
                    {
                        "id": "19",
                        "denomination": "saphir",
                        "color": "grey",
                        "weight": "30",
                        "size": "big",
                        "quality": "EX",
                        "type": "precieuses"
                    },
                    {
                        "id": "24",
                        "denomination": "diamant",
                        "color": "grey",
                        "weight": "30",
                        "size": "small",
                        "quality": "F",
                        "type": "precieuses"
                    },
                    {
                        "id": "17",
                        "denomination": "cornaline",
                        "color": "grey",
                        "weight": "30",
                        "size": "big",
                        "quality": "EX",
                        "type": "fines"
                    },
                    {
                        "id": "20",
                        "denomination": "grenat",
                        "color": "grey",
                        "weight": "30",
                        "size": "big",
                        "quality": "EX",
                        "type": "fines"
                    },
                    {
                        "id": "21",
                        "denomination": "opale",
                        "color": "grey",
                        "weight": "30",
                        "size": "big",
                        "quality": "EX",
                        "type": "fines"
                    },
                    {
                        "id": "18",
                        "denomination": "perle",
                        "color": "grey",
                        "weight": "30",
                        "size": "big",
                        "quality": "EX",
                        "type": "organiques"
                    }
                ]
          }

else 
    {
    "message": "No pierres Found"
    }


//------------------------------------------------------------------------------------
