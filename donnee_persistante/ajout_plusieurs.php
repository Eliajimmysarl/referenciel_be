<?php

    $application_id=$json_decode->application_id;

    $composant_id=$json_decode->composant_id; 

    $entite_id=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $types=$json_decode->types; 

    $descriptions=$json_decode->descriptions; 

    $date_creation = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            for($i=0; $i < count($donnee_echanges); ++$i)
                {
                    $application_id= $donnee_echanges[$i][0];
               
                    $composant_id= $donnee_echanges[$i][1];

                    $entite_id= $donnee_echanges[$i][2];

                    $nom= $donnee_echanges[$i][3];

                    $types= $donnee_echanges[$i][4];

                    $descriptions= $donnee_echanges[$i][5];

                    $stmt = $dbh->prepare("INSERT INTO donnee_echange (application_id, composant_id,  entite_id, nom, types, descriptions, date_creation, heure_creation) VALUES (?,?,?,?,?,?,?,?)");

                    $stmt->bindParam(1, $application_id);

                    $stmt->bindParam(2, $composant_id);

                    $stmt->bindParam(3, $entite_id);

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