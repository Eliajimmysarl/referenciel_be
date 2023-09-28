<?php

    $application_id=$json_decode->application_id;

    $entite_id=$json_decode->entite_id; 

    $composant_id=$json_decode->composant_id; 

    $methode=$json_decode->methode; 

    $uri=$json_decode->uri; 

    $date_update = date("Y-m-d");
    
    $heure_update = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE api SET application_id=?, entite_id=?,  composant_id=?, methode=?, uri=? date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $entite_id);

            $stmt->bindParam(3, $composant_id);

            $stmt->bindParam(4, $methode);

            $stmt->bindParam(5, $uri);

            $stmt->bindParam(6, $id);

            $stmt->bindParam(7, $date_update);

            $stmt->bindParam(8, $heure_update);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM api WHERE application_id=? AND entite_id=? AND  composant_id=? AND methode_id=? AND uri=? AND date_update=? AND  heure_update=?");
            
            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $entite_id);

            $stmt->bindParam(3, $composant_id);

            $stmt->bindParam(4, $methode);

            $stmt->bindParam(5, $uri);

            $stmt->bindParam(6, $id);

            $stmt->bindParam(7, $date_update);

            $stmt->bindParam(8, $heure_update);

            $stmt->execute();        

            $data["code"]  = 200;

            $data["id"]  = "$last";

            $data["application_id"]  = "$application_id";

            $data["entite_id"]  = "$entite_id";

            $data["composant_id"]  = "$composant_id";

            $data["methode"]  = "$methode";

            $data["uri"]  = "$uri";

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