<?php

   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $stmt = $dbh->prepare(" SELECT entite.id, entite.nom AS entite_nom, entite.application_id, applications.nom AS applications_nom FROM `entite` INNER JOIN applications ON entite.application_id=applications.id WHERE entite.application_id=? ");

         $stmt->execute();
                
         $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         echo '<pre>';
         print_r($resultat);
         echo '</pre>';
     }
           
     catch(PDOException $e){
         echo "Erreur : " . $e->getMessage();
     }
   
   ?>