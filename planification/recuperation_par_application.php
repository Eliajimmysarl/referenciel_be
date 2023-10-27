<?php

   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         $stmt = $dbh->prepare("SELECT planification.user_id, planification.composant_id, planification.application_id, planification.statut, planification.remarque, planification.date_debut, planification.date_fin, composant.nom, composant.id FROM `planification` INNER JOIN composant ON composant.id=planification.composant_id WHERE planification.application_id= ? AND planification.user_id= ? ");

         $stmt->bindParam(1, $applicationId);

         $stmt->bindParam(2, $userId);
  

         $stmt->execute();

         $datas = array();

         $nombreLigne = $stmt->rowCount();
              
         if($nombreLigne > 0)
            { 
               while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                  {
                     $datas["code"]  = 200;

                     $datas['planification'][]=$resultat;
                  }
            }
         else
            {
               $datas["code"]  = 400;
      
               $datas['planification'][]="Ressource not found";
            }
               
         echo json_encode($datas);
      }

   catch (PDOException $e)
      {
         print "Erreur !: " . $e->getMessage() . "<br/>";
              
         die();
      }
   
   ?>