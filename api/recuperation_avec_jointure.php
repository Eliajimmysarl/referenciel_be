<?php

   $application_id=$json_decode->application_id;

   $entite_id=$json_decode->entite_id; 

   $composant_id=$json_decode->composant_id; 

   $methode=$json_decode->methode; 

   $uri=$json_decode->uri; 


   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         
         $stmt = $dbh->prepare("SELECT api.id, api.application_id, api.entite_id, api.composant_id, api.methode, api.uri, applications.id, entite.id, composant.id FROM `api` INNER JOIN applications ON api.application_id=applications.id INNER JOIN entite ON api.entite_id=entite.id INNER JOIN composant ON api.composant_id=composant.id WHERE api.application_id= ? AND api.entite_id= ? AND api.composant_id= ? ");

         $stmt->bindParam(1, $application_id);
                     
         $stmt->bindParam(2, $entite_id);

         $stmt->bindParam(2, $composant_id);

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