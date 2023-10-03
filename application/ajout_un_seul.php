<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $nom=$json_decode->nom;

    $descriptions=$json_decode->descriptions; 

    $lienWeb=$json_decode->lien_web; 

    $lienAndroid=$json_decode->lien_android; 
    
    $lienIos=$json_decode->lien_ios; 

    $ussdVodacom=$json_decode->ussd_vodacom; 

    $ussd_africell=$json_decode->ussd_africell;

    $ussdOrange=$json_decode->ussd_orange;

    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");    
    
    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO applications ( nom, descriptions, lien_web, lien_android, lien_ios, ussd_vodacom, ussd_africell, ussd_orange, date_creation, date_update, heure_creation, heure_update ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $nom);

            $stmt->bindParam(2, $descriptions);

            $stmt->bindParam(3, $lienWeb);

            $stmt->bindParam(4, $lienAndroid);

            $stmt->bindParam(5, $lienIos);

            $stmt->bindParam(6, $ussdVodacom);

            $stmt->bindParam(7, $ussdAfricell);

            $stmt->bindParam(8, $ussdOrange);

            $stmt->bindParam(9, $dateCreation);

            $stmt->bindParam(10, $dateUpdate);

            $stmt->bindParam(11, $heureCreation);

            $stmt->bindParam(12, $heureUpdate);


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

                    $data["lien_web"]  = "$lienWeb";

                    $data["lien_android"]  = "$lienAndroid";

                    $data["lien_ios"]  = "$lienIos";

                    $data["ussd_vodacom"]  = "$ussdVodacom";

                    $data["ussd_africell"]  = "$ussdAfricell";

                    $data["ussd_orange"]  = "$ussdOrange";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";

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