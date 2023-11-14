<?php

    try 
        {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);
            
            $stmt = $dbh->prepare("SELECT roles.id AS id_roles, roles.application_id, roles.acteur_id, roles.application_id, roles.unite_organisation_id, roles.nom, roles.descriptions, applications.nom AS application_nom, unite_organisation.id, unite_organisation.nom AS unite_organisation_nom, acteur.id, acteur.nom AS acteur_nom FROM `roles` INNER JOIN applications ON roles.application_id=applications.id INNER JOIN acteur ON roles.acteur_id=acteur.id INNER JOIN unite_organisation ON roles.unite_organisation_id=unite_organisation.id WHERE roles.id=:id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $datas = array();

            $nombreLigne = $stmt->rowCount();
            
            if($nombreLigne > 0)
                { 
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;

                            $datas['roles'][]=$resultat;
                        }
                }
            else
                {
                    $datas["code"]  = 400;
        
                    $datas['roles'][]="Ressource not found";
                }
                
            echo json_encode($datas);
        }

   catch (PDOException $e)
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            
            die();
        }
    
  ?> 