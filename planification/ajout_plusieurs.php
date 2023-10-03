<?php

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");

    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");  

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            for($i=0; $i < count($planifications); ++$i)
                {
                    $userId= $planifications[$i][0];
               
                    $composantId= $planifications[$i][1];

                    $dateDebut= $planifications[$i][2];

                    $dateFin= $planifications[$i][3];

                    $remarque= $planifications[$i][4];

                    $stmt = $dbh->prepare("INSERT INTO planification (user_id, composant_id, date_debut, date_fin, remarque, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?)");

                    $stmt->bindParam(1, $userId);

                    $stmt->bindParam(2, $composantId);
        
                    $stmt->bindParam(3, $dateDebut);
        
                    $stmt->bindParam(4, $dateFin);
        
                    $stmt->bindParam(5,  $remarque);
        
                    $stmt->bindParam(6, $date_creation);
        
                    $stmt->bindParam(7, $date_update);
        
                    $stmt->bindParam(8, $heure_creation);
        
                    $stmt->bindParam(9, $heure_update);

                    $stmt->execute();
                }
            
            $last = $dbh->lastInsertId();
              
            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["planification"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["planification"]  = "Ressource created";
                }
            
            echo json_encode($data);
        
            $dbh = null; 
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
?>