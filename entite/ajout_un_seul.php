<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
    
    
    $application_id=$json_decode->application_id;

    $nom=$json_decode->nom; 

    $descriptions=$json_decode->descriptions; 
    
    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user_services, $pass_services);

            $stmt = $dbh->prepare("INSERT INTO entite (application_id, nom, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $nom);

            $stmt->bindParam(3, $descriptions);

            $stmt->bindParam(4, $date_creation);

            $stmt->bindParam(5, $date_update);

            $stmt->bindParam(6, $heure_creation);

            $stmt->bindParam(7, $heure_update);

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

                    $data["nom"]  = "$nom";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$date_creation";

                    $data["date_update"]  = "$date_update";

                    $data["heure_creation"]  = "$heure_creation";

                    $data["heure_update"]  = "$heure_update";

                    $data["reponse"]  = "Le test $application_id $nomt avec l'id $id est cree";  
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