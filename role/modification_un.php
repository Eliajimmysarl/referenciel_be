<?php

$acteurId=$json_decode->acteur_id;

$applicationId=$json_decode->application_id;

$uniteOrganisationId=$json_decode->unite_organisation_id;
    
$nom=$json_decode->nom; 

$descriptions=$json_decode->descriptions; 

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE roles SET acteur_id=?, application_id=?, unite_organisation_id=?, nom=?,  descriptions=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $acteurId);
           
            $stmt->bindParam(2, $applicationId);

            $stmt->bindParam(3, $uniteOrganisationId);

            $stmt->bindParam(4, $nom);

            $stmt->bindParam(5, $descriptions);

            $stmt->bindParam(6, $dateUpdate);

            $stmt->bindParam(7, $heureUpdate);

            $stmt->bindParam(8, $id);

            $stmt->execute();

           
            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["acteur_id"]  = "$acteurId";

            $data["application_id"]  = "$applicationId";

            $data["unite_organisation_id"]  = "$uniteOrganisationId";

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