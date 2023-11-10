<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
    
    $processusId=$json_decode->processus_id;

    $activite=$json_decode->activite; 

    $lienCode=$json_decode->lien_code;

    $descriptions=$json_decode->descriptions; 
    
    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO composant_processus (processus_id, activite, lien_code, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $processusId);

            $stmt->bindParam(2, $activite);

            $stmt->bindParam(3, $lienCode);

            $stmt->bindParam(4, $descriptions);

            $stmt->bindParam(5, $dateCreation);

            $stmt->bindParam(6, $dateUpdate);

            $stmt->bindParam(7, $heureCreation);

            $stmt->bindParam(8, $heureUpdate);

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

                    $data["processus_id"]  = "$processusId";

                    $data["activite"]  = "$activite";

                    $data["lien_code"]  = "$lienCode";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";

                    $data["reponse"]  = "Le test $processusId $activite avec l'id $id est cree";  
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