<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);

    $application_id=$json_decode->application_id;

    $couche=$json_decode->couche; 

    $plateforme=$json_decode->plateforme; 

    $entite_id=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $descriptions=$json_decode->descriptions; 

    $url_code=$json_decode->url_code;

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");  

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO composant (application_id, couche, plateforme, entite_id, nom, descriptions, url_code, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $couche);

            $stmt->bindParam(3, $plateforme);

            $stmt->bindParam(4, $entite_id);

            $stmt->bindParam(5, $nom);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $url_code);

            $stmt->bindParam(8, $id);

            $stmt->bindParam(9, $date_creation);

            $stmt->bindParam(10, $date_update);

            $stmt->bindParam(11, $heure_creation);

            $stmt->bindParam(12, $heure_update);


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

                    $data["application_id"]  = "$application_id";

                    $data["couche"]  = "$couche";

                    $data["plateforme"]  = "$plateforme";

                    $data["entite_id"]  = "$entite_id";

                    $data["nom"]  = "$nom";

                    $data["descriptions"]  = "$descriptions";

                    $data["url_code"]  = "$url_code";

                    $data["reponse"]  = "Le test $application_id $nom avec l'id $id est cree";  
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