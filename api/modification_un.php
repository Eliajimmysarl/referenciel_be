<?php

    $applicationId=$json_decode->application_id;

    $entiteId=$json_decode->entite_id; 

    $composantId=$json_decode->composant_id; 

    $methode=$json_decode->methode; 

    $uri=$json_decode->uri; 

    $dateUpdate = date("Y-m-d");
    
    $heureUpdate = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE api SET application_id=?, entite_id=?,  composant_id=?, methode=?, uri=? date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $entiteId);

            $stmt->bindParam(3, $composantId);

            $stmt->bindParam(4, $methode);

            $stmt->bindParam(5, $uri);

            $stmt->bindParam(6, $id);

            $stmt->bindParam(7, $dateUpdate);

            $stmt->bindParam(8, $heureUpdate);

            $stmt->execute();

            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["application_id"]  = "$applicationId";

            $data["entite_id"]  = "$entiteId";

            $data["composant_id"]  = "$composantId";

            $data["methode"]  = "$methode";

            $data["uri"]  = "$uri";

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