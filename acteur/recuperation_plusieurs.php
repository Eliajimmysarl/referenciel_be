<?php

    try {
        $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

        $stmt = $dbh->prepare("SELECT acteur.id, acteur.application_id, acteur.unite_organisation_id, acteur.nom, acteur.types, acteur.descriptions, applications.nom FROM `acteur` INNER JOIN applications ON acteur.application_id = applications.id ");
       // $stmt = $dbh->prepare("SELECT *FROM acteur   ORDER BY id");
        $stmt->execute();

        $datas = array();

        $nombreLigne = $stmt->rowCount();
        
        if($nombreLigne > 0)
            { 
                while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $datas["code"]  = 200;
                        
                        $datas['acteur'][]=$resultat;
                    }
            }
        else
            {
                $datas["code"]  = 400;

                $datas['acteur'][]="Ressource not found";
            }   
        echo json_encode($datas);
          
    }
    catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
    }
?> 