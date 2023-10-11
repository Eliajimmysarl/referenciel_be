<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $userId=$json_decode->user_id;

    $composantId=$json_decode->composant_id; 

    $statut=$json_decode->statut; 

    $remarque=$json_decode->remarque; 

    $dateDebut=$json_decode->date_debut; 

    $dateFin=$json_decode->date_fin; 

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");  

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO planification (user_id, composant_id, statut, remarque, date_debut, date_fin, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $userId);

            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $statut);

            $stmt->bindParam(4,  $remarque);

            $stmt->bindParam(5, $dateDebut);

            $stmt->bindParam(6, $dateFin);

            $stmt->bindParam(7, $date_creation);

            $stmt->bindParam(8, $date_update);

            $stmt->bindParam(9, $heure_creation);

            $stmt->bindParam(10, $heure_update);


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

                    $data["user_id"]  = "$userId";

                    $data["composant_id"]  = "$composantId";

                    $data["statut"]  = "$statut";

                    $data["remarque"]  = "$remarque";

                    $data["date_debut"]  = "$dateDebut";

                    $data["date_fin"]  = "$dateFin";

                    $data["reponse"]  = "Le test $composant_id $user_id avec l'id $id est cree";  
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