<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $applicationId=$json_decode->application_id;

    $couche=$json_decode->couche; 

    $plateforme=$json_decode->plateforme; 

    $entiteId=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $descriptions=$json_decode->descriptions; 

    $urlCode=$json_decode->url_code;

    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");  

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO composant (application_id, couche, plateforme, entite_id, nom, descriptions, url_code, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $couche);

            $stmt->bindParam(3, $plateforme);

            $stmt->bindParam(4, $entiteId);

            $stmt->bindParam(5, $nom);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $urlCode);

            $stmt->bindParam(8, $dateCreation);

            $stmt->bindParam(9, $dateUpdate);

            $stmt->bindParam(10, $heureCreation);

            $stmt->bindParam(11, $heureUpdate);


            $stmt->execute();

            $last = $dbh->lastInsertId();

            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["id"]  = "$last";

                    $data["application_id"]  = "$applicationId";

                    $data["couche"]  = "$couche";

                    $data["plateforme"]  = "$plateforme";

                    $data["entite_id"]  = "$entiteId";

                    $data["nom"]  = "$nom";

                    $data["descriptions"]  = "$descriptions";

                    $data["url_code"]  = "$urlCode";

                    $data["reponse"]  = "Le test $applicationId $nom avec l'id $id est cree";  
                }
            
            echo json_encode( $data );
        
            $dbh = null; 
        }

    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
?>