<?php

   $applicationId=$json_decode->application_id;

   $nom=$json_decode->nom; 

   $descriptions=$json_decode->descriptions;

   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

         $stmt = $dbh->prepare(" SELECT entite.id, entite.nom AS entite_nom, entite.application_id, applications.nom AS applications_nom FROM `entite` INNER JOIN applications ON entite.application_id=applications.id WHERE entite.application_id=? ");

         $stmt->bindParam(1, $id);

         $stmt->bindParam(2, $entite_nom);

         $stmt->bindParam(3, $application_id);
         $stmt->bindParam(4, $applications_nom);

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