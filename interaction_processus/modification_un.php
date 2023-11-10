<?php

$processusId=$json_decode->processus_id;

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE interaction_processus SET processus_id=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $processusId);

            $stmt->bindParam(2, $dateUpdate);

            $stmt->bindParam(3, $heureUpdate);

            $stmt->bindParam(4, $id);

            $stmt->execute();

           
            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["processus_id"]  = "$processusId";

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