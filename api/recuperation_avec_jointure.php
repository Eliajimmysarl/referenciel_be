<?php

   $applicationId=$json_decode->application_id;

   $entiteId=$json_decode->entite_id; 

   $composantId=$json_decode->composant_id; 

   $methode=$json_decode->methode; 

   $uri=$json_decode->uri; 


   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         
         $stmt = $dbh->prepare("SELECT api.id, api.application_id, api.entite_id, api.composant_id, api.methode, api.uri, applications.id, applications.nom AS application_nom, entite.id, entite.nom AS entite_nom, composant.id, composant.nom AS composant_nom FROM `api` INNER JOIN applications ON api.application_id=applications.id INNER JOIN entite ON api.entite_id=entite.id INNER JOIN composant ON api.composant_id=composant.id WHERE api.application_id= ? AND api.entite_id= ? AND api.composant_id= ? ");

         $stmt->bindParam(1, $applicationId);
                     
         $stmt->bindParam(2, $entiteId);

         $stmt->bindParam(3, $composantId);

         $stmt->execute();

         $datas = array();

         $nombreLigne = $stmt->rowCount();
              
         if($nombreLigne > 0)
            { 
               while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                  {
                     $datas["code"]  = 200;

                     $datas['api'][]=$resultat;
                  }
            }
         else
            {
               $datas["code"]  = 400;
      
               $datas['api'][]="Ressource not found";
            }
               
         echo json_encode($datas);
      }

   catch (PDOException $e)
      {
         print "Erreur !: " . $e->getMessage() . "<br/>";
              
         die();
      }
   
   ?>