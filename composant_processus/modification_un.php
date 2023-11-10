<?php

$processusId=$json_decode->processus_id;

$activite=$json_decode->activite; 

$lienCode=$json_decode->lien_code;

$descriptions=$json_decode->descriptions; 

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE composant_processus SET processus_id=?, activite=?, lien_code=?, descriptions=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $processusId);

            $stmt->bindParam(2, $activite);

            $stmt->bindParam(3, $lienCode);

            $stmt->bindParam(4, $descriptions);

            $stmt->bindParam(5, $dateUpdate);

            $stmt->bindParam(6, $heureUpdate);

            $stmt->bindParam(7, $id);

            $stmt->execute();

           
            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["processus_id"]  = "$processusId";

            $data["activite"]  = "$activite";

            $data["lien_code"]  = "$lienCode";

            $data["descriptions"]  = "$descriptions";

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