<?php

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            for($i=0; $i < count($donnee_echanges); ++$i)
                {
                    $applicationId= $donnee_echanges[$i][0];
               
                    $composantId= $donnee_echanges[$i][1];

                    $entiteId= $donnee_echanges[$i][2];

                    $nom= $donnee_echanges[$i][3];

                    $types= $donnee_echanges[$i][4];

                    $descriptions= $donnee_echanges[$i][5];

                    $stmt = $dbh->prepare("INSERT INTO donnee_echange (application_id, composant_id,  entite_id, nom, types, descriptions, date_creation, heure_creation) VALUES (?,?,?,?,?,?,?,?)");

                    $stmt->bindParam(1, $applicationId);

                    $stmt->bindParam(2, $composantId);

                    $stmt->bindParam(3, $entiteId);

                    $stmt->bindParam(4, $nom);

                    $stmt->bindParam(5, $types);

                    $stmt->bindParam(6, $descriptions);

                    $stmt->execute();
                }
            
            $last = $dbh->lastInsertId();
              
            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["message"]  = "Ressource created";
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