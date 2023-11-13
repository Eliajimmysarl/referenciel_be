<?php

    try {
        $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

        $stmt = $dbh->prepare(" SELECT processus.id, processus.nom AS processus_nom, processus.application_id, processus.descriptions, applications.nom AS applications_nom FROM `processus` INNER JOIN applications ON processus.application_id=applications.id ");

        $stmt->execute();

        $datas = array();

        $nombreLigne = $stmt->rowCount();
        
        if($nombreLigne > 0)
            { 
                while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $datas["code"]  = 200;
                        
                        $datas['processus'][]=$resultat;
                    }
            }
        else
            {
                $datas["code"]  = 400;

                $datas['processus'][]="Ressource not found";
            }   
        echo json_encode($datas);
        
    }
    catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
    }
?> 