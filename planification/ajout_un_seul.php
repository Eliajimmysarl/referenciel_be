<?php

    $userId=$json_decode->user_id;

    $composantId=$json_decode->composant_id; 

    $applicationId=$json_decode->application_id;

    $dateDebut=$json_decode->date_debut; 

    $dateFin=$json_decode->date_fin; 

    $remarque=$json_decode->remarque; 

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");  

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO planification (user_id, composant_id, application_id, date_debut, date_fin, remarque, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $userId);

            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $applicationId);

            $stmt->bindParam(4, $dateDebut);

            $stmt->bindParam(5, $dateFin);

            $stmt->bindParam(6,  $remarque);

            $stmt->bindParam(7, $date_creation);

            $stmt->bindParam(8, $date_update);

            $stmt->bindParam(9, $heure_creation);

            $stmt->bindParam(10, $heure_update);

            $stmt->execute();

            $last = $dbh->lastInsertId();

            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["user_id"]  = "$userId";

                    $data["composant_id"]  = "$composantId";

                    $data["application_id"]  = "$applicationId";

                    $data["date_debut"]  = "$dateDebut";

                    $data["date_fin"]  = "$dateFin";

                    $data["remarque"]  = "$remarque";

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["id"]  = "$last";

                    $data["user_id"]  = "$userId";

                    $data["composant_id"]  = "$composantId";

                    $data["application_id"]  = "$applicationId";


                    $data["date_debut"]  = "$dateDebut";

                    $data["date_fin"]  = "$dateFin";

                    $data["remarque"]  = "$remarque";

                    $data["reponse"]  = "Le test $applicationId $nom avec l'id $id est cree";  
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