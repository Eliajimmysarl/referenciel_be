<?php

$applicationId=$json_decode->application_id;

$nom=$json_decode->nom; 

$descriptions=$json_decode->descriptions; 

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE entite SET application_id=?, nom=?,  descriptions=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $nom);

            $stmt->bindParam(3, $descriptions);

            $stmt->bindParam(4, $id);

            $stmt->bindParam(5, $dateUpdate);

            $stmt->bindParam(6, $heureUpdate);

            $stmt->execute();

           
            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["application_id"]  = "$applicationId";

            $data["nom"]  = "$nom";

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