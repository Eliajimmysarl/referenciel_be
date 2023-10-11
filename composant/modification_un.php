<?php

$applicationId=$json_decode->application_id;

$couche=$json_decode->couche; 

$plateforme=$json_decode->plateforme; 

$entiteId=$json_decode->entite_id; 

$nom=$json_decode->nom; 

$descriptions=$json_decode->descriptions; 

$urlCode=$json_decode->url_code;

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");  

    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE composant SET application_id=?, couche=?,  plateforme=?, entite_id=?, nom=?, descriptions=?, url_code=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $couche);

            $stmt->bindParam(3, $plateforme);

            $stmt->bindParam(4, $entiteId);

            $stmt->bindParam(5, $nom);

            $stmt->bindParam(6, $descriptions);
            
            $stmt->bindParam(7, $urlCode);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureUpdate);

            $stmt->bindParam(10, $id);

            $stmt->execute();    

            $data["code"]  = 200;  

            $data["id"]  = "$id";

            $data["application_id"]  = "$applicationId";

            $data["couche"]  = "$couche";

            $data["plateforme"]  = "$plateforme";

            $data["entite_id"]  = "$entiteId";

            $data["nom"]  = "$nom";

            $data["descriptions"]  = "$descriptions";
            
            $data["url_code"]  = "$urlCode";

            echo json_encode( $data );
            
                $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>  