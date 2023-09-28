<?php

$application_id=$json_decode->application_id;

$couche=$json_decode->couche; 

$plateforme=$json_decode->plateforme; 

$entite_id=$json_decode->entite_id; 

$nom=$json_decode->nom; 

$descriptions=$json_decode->descriptions; 

$url_code=$json_decode->url_code;

$date_update = date("Y-m-d");

$heure_update = date("H:i:s");  

    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE test SET texte=?, selec=?,  dates=?, telephone=?, email=?, passwords=?, optionsRadios=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $texte);

            $stmt->bindParam(2, $selec);

            $stmt->bindParam(3, $dates);

            $stmt->bindParam(4, $telephone);

            $stmt->bindParam(5, $email);

            $stmt->bindParam(6, $passwords);
            
            $stmt->bindParam(7, $optionsRadios);

            $stmt->bindParam(8, $id);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureUpdate);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM test WHERE texte=? AND selec=? AND  dates=? AND telephone=? AND email=? AND passwords=? AND optionsRadios=? AND date_update=? AND  heure_update=?");
            
            $stmt->bindParam(1, $texte);

            $stmt->bindParam(2, $selec);

            $stmt->bindParam(3, $dates);

            $stmt->bindParam(4, $telephone);

            $stmt->bindParam(5, $email);

            $stmt->bindParam(6, $passwords);
            
            $stmt->bindParam(7, $optionsRadios);

            $stmt->bindParam(8, $id);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureUpdate);

            $stmt->execute();        

            $data["code"]  = 200;

            $data["id"]  = "$last";

            $data["texte"]  = "$texte";

            $data["selec"]  = "$selec";

            $data["dates"]  = "$dates";

            $data["telephone"]  = "$telephone";

            $data["email"]  = "$email";

            $data["passwords"]  = "$passwords";
            
            $data["optionsRadios"]  = "$optionsRadios";

            echo json_encode( $data );
            
                $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>  