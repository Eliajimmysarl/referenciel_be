<?php

    $userId=$json_decode->user_id;

    $composantId=$json_decode->composant_id; 

    $dateDebut=$json_decode->date_debut; 

    $dateFin=$json_decode->date_fin; 

    $remarque=$json_decode->remarque; 

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");   

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE planification SET user_id=?, composant_id=?, date_debut=?, date_fin=?, remarque=?, date_update=?, heure_update=? WHERE id=?");
            
            $stmt->bindParam(1, $userId);

            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $dateDebut);

            $stmt->bindParam(4, $dateFin);

            $stmt->bindParam(5,  $remarque);

            $stmt->bindParam(6, $date_update);

            $stmt->bindParam(7, $heure_update);

            $stmt->bindParam(8, $id);

            $stmt->execute();

            $data["code"]  = 200;

            $data["planification"]  = "Planification updated";

            echo json_encode( $data );
            
             $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>  