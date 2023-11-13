<?php

$applicationId=$json_decode->application_id;

$uniteOrganisationId=$json_decode->unite_organisation_id;
   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         $stmt = $dbh->prepare("SELECT acteur.id, acteur.nom AS acteur_nom, acteur.application_id, acteur.types, acteur.descriptions, applications.nom AS applications_nom, unite_organisation.nom AS unite_organisation_nom FROM `acteur` INNER JOIN applications ON acteur.application_id=applications.id INNER JOIN unite_organisation ON acteur.unite_organisation_id=unite_organisation.id WHERE acteur.unite_organisation_id=? ");

         $stmt->bindParam(1, $uniteOrganisationId);

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

   catch (PDOException $e)
      {
         print "Erreur !: " . $e->getMessage() . "<br/>";
              
         die();
      }
   
   ?>