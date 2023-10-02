<?php

   $application_id=$json_decode->application_id;

   $composant_id=$json_decode->composant_id; 

   $entite_id=$json_decode->entite_id; 

   $nom=$json_decode->nom; 

   $types=$json_decode->types; 

   $descriptions=$json_decode->descriptions; 


   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         $stmt = $dbh->prepare("SELECT donnee_echange.id, donnee_echange.application_id, donnee_echange.entite_id, donnee_echange.composant_id, donnee_echange.nom, applications.id, entite.id, composant.id FROM `donnee_echange` INNER JOIN applications ON donnee_echange.application_id=applications.id INNER JOIN entite ON donnee_echange.entite_id=entite.id INNER JOIN composant ON donnee_echange.composant_id=composant.id WHERE donnee_echange.application_id= ? AND donnee_echange.composant_id= ? AND donnee_echange.entite_id= ? ");

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