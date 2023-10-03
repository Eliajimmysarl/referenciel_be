<?php

    $applicationId=$json_decode->application_id;

    $composantId=$json_decode->composant_id; 

    $entiteId=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $types=$json_decode->types; 

    $descriptions=$json_decode->descriptions; 

    $dateUpdate = date("Y-m-d");
    
    $heureUpdate = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE donnee_echange SET application_id=?, composant_id=?, entite_id=?, nom=?, types=?, descriptions=? date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $entiteId);

            $stmt->bindParam(4, $nom);

            $stmt->bindParam(5, $types);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $id);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureUpdate);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM donnee_echange WHERE application_id=? AND  composant_id=? AND entite_id=? AND  nom=?  AND types=? AND descriptions=? AND date_update=? AND  heure_update=?");
            
            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $entiteId);

            $stmt->bindParam(4, $nom);

            $stmt->bindParam(5, $types);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $id);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureUpdate);

            $stmt->execute();        

            $data["code"]  = 200;

            $data["id"]  = "$last";

            $data["application_id"]  = "$applicationId";

            $data["composant_id"]  = "$composantId";

            $data["entite_id"]  = "$entiteId";

            $data["nom"]  = "$nom";

            $data["types"]  = "$types";

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