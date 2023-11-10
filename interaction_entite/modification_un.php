<?php

$composantEntiteId=$json_decode->composant_entite_id;

$entiteId=$json_decode->entite_id; 

$descriptions=$json_decode->descriptions; 

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE interaction_entite SET composant_entite_id=?, entite_id=?,  descriptions=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $composantEntiteId);

            $stmt->bindParam(2, $entiteId);

            $stmt->bindParam(3, $descriptions);

            $stmt->bindParam(4, $dateUpdate);

            $stmt->bindParam(5, $heureUpdate);

            $stmt->bindParam(6, $id);

            $stmt->execute();

           
            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["composant_entite_id"]  = "$composantEntiteId";

            $data["entite_id"]  = "$entiteId";

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