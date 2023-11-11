<?php

    try 
        {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);
            
            $stmt = $dbh->prepare( "SELECT unite_organisation.id, unite_organisation.nom AS unite_organisation_nom, unite_organisation.application_id, unite_organisation.descriptions, applications.nom AS applications_nom FROM `unite_organisation` INNER JOIN applications ON unite_organisation.application_id=applications.id WHERE unite_organisation.id = :id");
 
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $datas = array();

            $nombreLigne = $stmt->rowCount();
            
            if($nombreLigne > 0)
                { 
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;

                            $datas['entite'][]=$resultat;
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