<?php

    try 
        {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);
            
            $stmt = $dbh->prepare("SELECT composant.id AS id_composant, composant.application_id, composant.couche, composant.plateforme, composant.nom, composant.descriptions, composant.url_code, composant.entite_id, composant.nom, applications.id, applications.nom AS application_nom, entite.id, entite.nom AS entite_nom FROM `composant` INNER JOIN applications ON composant.application_id=applications.id INNER JOIN entite ON composant.entite_id=entite.id WHERE composant.id = :id");
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $datas = array();

            $nombreLigne = $stmt->rowCount();
            
            if($nombreLigne > 0)
                { 
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;

                            $datas['composant'][]=$resultat;
                        }
                }
            else
                {
                    $datas["code"]  = 400;
        
                    $datas['token'][]="Ressource not found";
                }
                
            echo json_encode($datas);
        }

   catch (PDOException $e)
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            
            die();
        }
    
  ?>   