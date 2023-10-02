<?php

    $application_id=$json_decode->application_id;

    $couche=$json_decode->couche; 

    $plateforme=$json_decode->plateforme; 

    $entite_id=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $descriptions=$json_decode->descriptions; 

    $url_code=$json_decode->url_code;

    $date_creation = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            for($i=0; $i < count($composants); ++$i)
                {
                    $application_id= $composants[$i][0];
               
                    $couche= $composants[$i][1];

                    $plateforme= $composants[$i][2];

                    $entite_id= $composants[$i][3];

                    $nom= $composants[$i][4];

                    $descriptions= $composants[$i][5];

                    $url_code= $composants[$i][6];

                    $stmt = $dbh->prepare("INSERT INTO composant (application_id, couche, plateforme, entite_id, nom, descriptions, url_code, date_creation, heure_creation) VALUES (?,?,?,?,?,?,?,?,?)");

                    $stmt->bindParam(1, $application_id);

                    $stmt->bindParam(2, $couche);

                    $stmt->bindParam(3, $plateforme);

                    $stmt->bindParam(4, $entite_id);

                    $stmt->bindParam(5, $nom);

                    $stmt->bindParam(6, $descriptions);

                    $stmt->bindParam(7, $url_code);

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