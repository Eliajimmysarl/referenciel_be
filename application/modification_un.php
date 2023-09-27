<?php

    $texte=$json_decode->texte;

    $selec=$json_decode->selec;

    $dates=$json_decode->dates;

    $telephone=$json_decode->telephone;

    $email=$json_decode->email; 

    $passwords=$json_decode->passwords;

    $optionsRadios=$json_decode->optionsRadios; 

    $dateUpdate = date("Y-m-d");
    
    $heureUpdate = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

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