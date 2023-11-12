<?php

    try 
        {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);
            
            $stmt = $dbh->prepare("SELECT interaction_processus.id, interaction_processus.processus_id, processus.nom AS processus_nom FROM `interaction_processus` INNER JOIN processus ON interaction_processus.processus_id=processus.id  WHERE interaction_processus.id = :id");
           
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $datas = array();

            $nombreLigne = $stmt->rowCount();
            
            if($nombreLigne > 0)
                { 
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;

                            $datas['interaction_processus'][]=$resultat;
                        }
                }
            else
                {
                    $datas["code"]  = 400;
        
                    $datas['interaction_processus'][]="Ressource not found";
                }
                
            echo json_encode($datas);
        }

   catch (PDOException $e)
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            
            die();
        }
    
  ?> 