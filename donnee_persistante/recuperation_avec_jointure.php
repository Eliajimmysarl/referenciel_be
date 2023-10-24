<?php

   $applicationId=$json_decode->application_id;

   $entiteId=$json_decode->entite_id;

   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

         $stmt = $dbh->prepare("SELECT donnee_persistante.id AS id_donnee_persistante, donnee_persistante.application_id, donnee_persistante.entite_id, donnee_persistante.nom, donnee_persistante.types, donnee_persistante.taille, donnee_persistante.defaut, donnee_persistante.valeur, donnee_persistante.indexe, donnee_persistante.cle_primaire, donnee_persistante.descriptions, applications.nom AS application_nom, entite.nom AS entite_nom FROM `donnee_persistante` INNER JOIN applications ON donnee_persistante.application_id=applications.id INNER JOIN entite ON donnee_persistante.entite_id=entite.id  WHERE donnee_persistante.application_id= ? AND donnee_persistante.entite_id= ? ");

         $stmt->bindParam(1, $applicationId);
                     
         $stmt->bindParam(2, $entiteId);

         $stmt->execute();

         $datas = array();

         $nombreLigne = $stmt->rowCount();
              
         if($nombreLigne > 0)
            { 
               while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                  {
                     $datas["code"]  = 200;

                     $datas['donnee_persistante'][]=$resultat;
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