<?php

    try {
    
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("DELETE FROM planification WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT planification.user_id, planification.composant_id, planification.statut, planification.remarque, planification.date_debut, planification.date_fin, composant.nom, composant.id FROM `planification` INNER JOIN composant ON composant.id=planification.composant_id ");
                                
            $stmt->execute();
                    
            $datas = array();
                    
            while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $datas["code"]  = 200;

                    $datas['planification'][]=$resultat;
                }
                                
            echo json_encode( $datas);

        }

    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
           
?>