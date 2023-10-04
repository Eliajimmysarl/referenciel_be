<?php

$nom=$json_decode->nom;

$descriptions=$json_decode->descriptions; 

$lienWeb=$json_decode->lien_web; 

$lienAndroid=$json_decode->lien_android; 

$lienIos=$json_decode->lien_ios; 

$ussdVodacom=$json_decode->ussd_vodacom; 

$ussdAfricell=$json_decode->ussd_africell;

$ussdOrange=$json_decode->ussd_orange;

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE applications SET nom=?, descriptions=?,  lien_web=?, lien_android=?, lien_ios=?, ussd_vodacom=?, ussd_africell=?, ussd_orange=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $nom);

            $stmt->bindParam(2, $descriptions);

            $stmt->bindParam(3, $lienWeb);

            $stmt->bindParam(4, $lienAndroid);

            $stmt->bindParam(5, $lienIos);

            $stmt->bindParam(6, $ussdVodacom);
            
            $stmt->bindParam(7, $ussdAfricell);

            $stmt->bindParam(8, $ussdOrange);

            $stmt->bindParam(9, $id);

            $stmt->bindParam(10, $dateUpdate);

            $stmt->bindParam(11, $heureUpdate);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM applications WHERE nom=? AND descriptions=? AND lien_web=? AND lien_android=? AND lien_ios=? AND ussd_vodacom=? AND ussd_africell=? AND ussd_orange=?  AND date_update=? AND  heure_update=?");
            
            $stmt->bindParam(1, $nom);

            $stmt->bindParam(2, $descriptions);

            $stmt->bindParam(3, $lienWeb);

            $stmt->bindParam(4, $lienAndroid);

            $stmt->bindParam(5, $lienIos);

            $stmt->bindParam(6, $ussdVodacom);
            
            $stmt->bindParam(7, $ussdAfricell);

            $stmt->bindParam(8, $ussdOrange);

            $stmt->bindParam(9, $id);

            $stmt->bindParam(10, $dateUpdate);

            $stmt->bindParam(11, $heureUpdate);

            $stmt->execute();        

            $data["code"]  = 200;

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

            echo json_encode( $data );
            
                $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>  