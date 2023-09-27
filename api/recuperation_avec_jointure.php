<?php

   $selec=$json_decode->selec;

   $optionsRadios=$json_decode->optionsRadios;

   try
      {
         $dbh = new PDO('mysql:host=localhost;dbname='.$db, $user, $pass);

         $stmt = $dbh->prepare("SELECT test.id, test.telephone, test.select, test.dates, test.email, test.optionsRadios, selections.id, selections.nom, options.id, options.nom FROM `test` INNER JOIN selections ON test.selec=selections.id INNER JOIN options ON test.selec=options.id WHERE test.selec= ? AND test.optionsRadios= ? ");

         $stmt->bindParam(1, $selec);
                     
         $stmt->bindParam(2, $optionsRadios);

         $stmt->execute();

         $datas = array();

         $nombreLigne = $stmt->rowCount();
            
         if($nombreLigne > 0)
            { 
               while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                  {
                     $datas["code"]  = 200;

                     $datas['test'][]=$resultat;
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