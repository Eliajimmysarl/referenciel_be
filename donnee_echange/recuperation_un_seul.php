<?php

    try 
        {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);
            
            $stmt = $dbh->prepare("SELECT donnee_echange.id AS id_donnee_echange, donnee_echange.application_id, donnee_echange.entite_id, donnee_echange.composant_id, donnee_echange.nom, donnee_echange.types, donnee_echange.descriptions, applications.id, applications.nom AS application_nom, entite.id, entite.nom AS entite_nom, composant.id, composant.nom AS composant_nom FROM `donnee_echange` INNER JOIN applications ON donnee_echange.application_id=applications.id INNER JOIN entite ON donnee_echange.entite_id=entite.id INNER JOIN composant ON donnee_echange.composant_id=composant.id  WHERE donnee_echange.id = :id");
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $datas = array();

            $nombreLigne = $stmt->rowCount();
            
            if($nombreLigne > 0)
                { 
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;

                            $datas['donnee_echange'][]=$resultat;
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