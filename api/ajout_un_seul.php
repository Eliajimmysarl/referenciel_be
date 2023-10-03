<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $applicationId=$json_decode->application_id;

    $entiteId=$json_decode->entite_id; 

    $composantId=$json_decode->composant_id; 

    $methode=$json_decode->methode; 

    $uri=$json_decode->uri; 

    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");    
    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO api (application_id, entite_id, composant_id, methode, uri, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $entiteId);

            $stmt->bindParam(3, $composantId);

            $stmt->bindParam(4, $methode);

            $stmt->bindParam(5, $uri);

            $stmt->bindParam(6, $dateCreation);

            $stmt->bindParam(7, $dateUpdate);

            $stmt->bindParam(8, $heureCreation);

            $stmt->bindParam(9, $heureUpdate);

           

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

                    $data["application_id"]  = "$applicationId";

                    $data["entite_id"]  = "$entiteId";

                    $data["composant_id"]  = "$composantId";

                    $data["methode"]  = "$methode";

                    $data["uri"]  = "$uri";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";


                    $data["reponse"]  = "Le test $applicationId $entiteId avec l'id $id est cree";  
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