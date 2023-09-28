<?php

    $application_id=$json_decode->application_id;

    $composant_id=$json_decode->composant_id; 

    $entite_id=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $types=$json_decode->types; 

    $descriptions=$json_decode->descriptions; 

    $date_update = date("Y-m-d");
    
    $heure_update = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE donnee_echange SET application_id=?, composant_id=?, entite_id=?, nom=?, types=?, descriptions=? date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $composant_id);

            $stmt->bindParam(3, $entite_id);

            $stmt->bindParam(4, $nom);

            $stmt->bindParam(5, $types);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $id);

            $stmt->bindParam(8, $date_update);

            $stmt->bindParam(9, $heure_update);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM donnee_echange WHERE application_id=? AND  composant_id=? AND entite_id=? AND  nom=?  AND types=? AND descriptions=? AND date_update=? AND  heure_update=?");
            
            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $composant_id);

            $stmt->bindParam(3, $entite_id);

            $stmt->bindParam(4, $nom);

            $stmt->bindParam(5, $types);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $id);

            $stmt->bindParam(8, $date_update);

            $stmt->bindParam(9, $heure_update);

            $stmt->execute();        

            $data["code"]  = 200;

            $data["id"]  = "$last";

            $data["application_id"]  = "$application_id";

            $data["composant_id"]  = "$composant_id";

            $data["entite_id"]  = "$entite_id";

            $data["nom"]  = "$nom";

            $data["types"]  = "$types";

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