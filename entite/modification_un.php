<?php

$application_id=$json_decode->application_id;

$nom=$json_decode->nom; 

$descriptions=$json_decode->descriptions; 

$date_update = date("Y-m-d");

$heure_update = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE entite SET application_id=?, nom=?,  descriptions=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $nom);

            $stmt->bindParam(3, $descriptions);

            $stmt->bindParam(4, $id);

            $stmt->bindParam(5, $date_update);

            $stmt->bindParam(6, $heure_update);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM entite WHERE application_id=? AND nom=? AND  descriptions=?  AND date_update=? AND  heure_update=?");
            
            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $nom);

            $stmt->bindParam(3, $descriptions);

            $stmt->bindParam(4, $id);

            $stmt->bindParam(5, $date_update);

            $stmt->bindParam(6, $heure_update);

            $stmt->execute();        

            $data["code"]  = 200;

            $data["id"]  = "$last";

            $data["application_id"]  = "$application_id";

            $data["nom"]  = "$nom";

            $data["descriptions"]  = "$descriptions";

            $data["date_update"]  = "$date_update";

            $data["heure_update"]  = "$heure_update";  

            echo json_encode( $data );  
            
                $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>  