<?php
    include('../../../connect/connect.php');

    include('../../../module/curl.php');
  
    $headers = apache_request_headers();
    
    $token=$headers['Authorisation'];

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $uri = $authority."/token/";
        
    $result=curl_get($uri,$token);

    $obj = json_decode($result);
        
    $code =  $obj->code;

    if($code !=200)
        {   
            $data["code"]  = 403;

            $data["planification"]  = "Erreur 403 Forbidden:  Vous n'avez pas les permissions necessaires pour acceder a la ressource demandee";
        
            echo json_encode($data);  
        }
    else
        {
            $methode=$_SERVER['REQUEST_METHOD'];
                
            if (isSet($_GET['id']))
                {
                    $id=$_GET['id'];
                
                    if($methode=='PUT')
                        {
                            require_once("modification_un.php"); 
                        }
                    else if($methode=='GET')
                        {
                            require_once("recuperation_un_seul.php");   
                        }    
                    else if($methode=='DELETE')
                        {
                            require_once("suppression_un.php");        
                        }
                    else
                        {
                            $data["code"]  = 400;

                            $data["planification"]  = "Erreur 400 :  Votre requete est POST et a un parametre id dans l'URL";
                        
                            echo json_encode($data);     
                        }
                }
            else if($methode=='POST')
                {
                    if(isSet($_GET['plusieurs']))
                        { 
                            require_once("ajout_plusieurs.php"); 
                        }
                    else
                        {
                            require_once("ajout_un_seul.php");   
                        }
                }
            else if($methode=='GET')
                {
                    $userId=$json_decode->user_id;

                    $statut=$json_decode->statut;
                    
                    if((isSet($userId)) AND (isSet($statut)))
                        {
                            require_once("recuperation_plusieurs_user_statut.php");
                        }
                    else if(isSet($userId))
                        {
                            require_once("recuperation_plusieurs_user.php");
                        }
                    else if(isSet($statut))
                        {
                            require_once("recuperation_plusieurs_statut.php");
                        }
                    else
                        {
                            require_once("recuperation_plusieurs.php");
                        }
                }  
            else if($methode=='PUT')
                {
                    require_once("modification_plusieurs.php"); 
                }
            else if($methode=='DELETE')
                {
                    require_once("suppression_plusieurs.php"); 
                }
            else 
                {
                    $data["code"]  = 405;

                    $data["planification"]  = "Erreur 405 :  Abscence de la méthode : POST, GET, PUT, DELETE";
                
                    echo json_encode($data);

                }
        }