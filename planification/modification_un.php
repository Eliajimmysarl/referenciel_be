<?php

    $userId=$json_decode->user_id;

    $composantId=$json_decode->composant_id; 

    $statut=$json_decode->statut; 

    $remarque=$json_decode->remarque; 

    $dateDebut=$json_decode->date_debut; 

    $dateFin=$json_decode->date_fin; 

    $dateUpdate = date("Y-m-d");

    $dateUpdate = date("Y-m-d");   

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE planification SET user_id=?, composant_id=?, statut=?, remarque=?, date_debut=?, date_fin=?,  date_update=?, heure_update=? WHERE id=?");
            
            $stmt->bindParam(1, $userId);
 
            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $statut);

            $stmt->bindParam(4, $remarque);

            $stmt->bindParam(5, $dateDebut);

            $stmt->bindParam(6, $dateFin);

            $stmt->bindParam(7, $date_update);

            $stmt->bindParam(8, $heure_update);

            $stmt->bindParam(9, $id);

            $stmt->execute();
    

            $data["code"]  = 200;

            $data["planification"]  = "Planification updated";

            $data["id"]  = "$id";

            $data["user_id"]  = "$userId";

            $data["composant_id"]  = "$composantId";

            $data["statut"]  = "$statut";

            $data["remarque"]  = "$remarque";

            $data["date_debut"]  = "$dateDebut";

            $data["date_fin"]  = "$dateFin";

            $data["date_update"]  = "$dateUpdate";

            $data["heure_update"]  = "$heureUpdate"; 

            echo json_encode( $data );
            
             $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }

?>  