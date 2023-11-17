<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $application_id=$json_decode->application_id;

    $entite_id=$json_decode->entite_id; 

    $composant_id=$json_decode->composant_id; 

    $methode=$json_decode->methode; 

    $uri=$json_decode->uri; 

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");    
    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO api (application_id, entite_id, composant_id, methode, uri, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $entite_id);

            $stmt->bindParam(3, $composant_id);

            $stmt->bindParam(4, $methode);

            $stmt->bindParam(5, $uri);

            $stmt->bindParam(6, $date_creation);

            $stmt->bindParam(7, $date_update);

            $stmt->bindParam(8, $heure_creation);

            $stmt->bindParam(9, $heure_update);

           

            $stmt->execute();

            $last = $dbh->lastInsertId();

            if($last==0)
            {
                $data["code"]  = 400;

                $data["message"]  = "Ressource not created";
            }
        else
            {
                $data["code"]  = 201;

                $data["id"]  = "$last";

                $data["application_id"]  = "$application_id";

                $data["entite_id"]  = "$entite_id";

                $data["composant_id"]  = "$composant_id";

                $data["methode"]  = "$methode";

                $data["uri"]  = "$uri";

                $data["date_creation"]  = "$date_creation";

                $data["date_update"]  = "$date_update";

                $data["heure_creation"]  = "$heure_creation";

                $data["heure_update"]  = "$heure_update";

                $data["reponse"]  = "Le test $application_id $entite_id avec l'id $id est cree";  
                
            }
            
            echo json_encode( $data );
        
            $dbh = null; 
        }

    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }  
?>