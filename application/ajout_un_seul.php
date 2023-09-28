<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $nom=$json_decode->nom;

    $descriptions=$json_decode->descriptions; 

    $lien_web=$json_decode->lien_web; 

    $lien_android=$json_decode->lien_android; 
    
    $lien_ios=$json_decode->lien_ios; 

    $ussd_vodacom=$json_decode->ussd_vodacom; 

    $ussd_africell=$json_decode->ussd_africell;

    $ussd_orange=$json_decode->ussd_orange;

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");    
    
    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO applications ( nom, descriptions, lien_web, lien_android, lien_ios, ussd_vodacom, ussd_africell, ussd_orange, date_creation, date_update, heure_creation, heure_update ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $nom);

            $stmt->bindParam(2, $descriptions);

            $stmt->bindParam(3, $lien_web);

            $stmt->bindParam(4, $lien_android);

            $stmt->bindParam(5, $lien_ios);

            $stmt->bindParam(6, $ussd_vodacom);

            $stmt->bindParam(6, $ussd_africell);

            $stmt->bindParam(7, $ussd_orange);

            $stmt->bindParam(8, $date_creation);

            $stmt->bindParam(9, $id);

            $stmt->bindParam(10, $date_update);

            $stmt->bindParam(11, $heure_creation);

            $stmt->bindParam(12, $heure_update);


            $stmt->execute();

            $last = $dbh->lastInsertId();

            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["id"]  = "$last";

                    $data["nom"]  = "$nom";

                    $data["descriptions"]  = "$descriptions";

                    $data["lien_web"]  = "$lien_web";

                    $data["lien_android"]  = "$lien_android";

                    $data["lien_ios"]  = "$lien_ios";

                    $data["ussd_vodacom"]  = "$ussd_vodacom";

                    $data["ussd_africell"]  = "$ussd_africell";

                    $data["ussd_orange"]  = "$ussd_orange";

                    $data["date_creation"]  = "$date_creation";

                    $data["date_update"]  = "$date_update";

                    $data["heure_creation"]  = "$heure_creation";

                    $data["heure_update"]  = "$heure_update";

                    $data["reponse"]  = "Le test $nom $descriptions avec l'id $id est cree";  
                }
            
            echo json_encode( $data );
        
            $dbh = null; 
        }

    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>