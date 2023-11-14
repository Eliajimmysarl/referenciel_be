<?php

   $processusId=$json_decode->processus_id;

   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         $stmt = $dbh->prepare( "SELECT composant_processus.id, composant_processus.activite, composant_processus.lien_code, composant_processus.descriptions, composant_processus.processus_id, processus.nom AS processus_nom FROM `composant_processus` INNER JOIN processus ON composant_processus.processus_id=processus.id WHERE composant_pocessus.processus_id=? ");

         $stmt->bindParam(1, $processusId);

         $stmt->execute();

         $datas = array();

         $nombreLigne = $stmt->rowCount();
            
         if($nombreLigne > 0)
            { 
               while($resultat=$stmt->fetch(PDO::FETCH_ASSOC))  
                  {
                     $datas["code"]  = 200;

                     $datas['composant_processus'][]=$resultat;
                  }
            }
         else
            {
               $datas["code"]  = 400;
      
               $datas['composant_processus'][]="Ressource not found";
            }
               
         echo json_encode($datas);
      }

   catch (PDOException $e)
      {
         print "Erreur !: " . $e->getMessage() . "<br/>";
              
         die();
      }
   
   ?>