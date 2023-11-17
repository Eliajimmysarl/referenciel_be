<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
    
    
    $applicationId=$json_decode->application_id;

    $uniteOrganisationId=$json_decode->unite_organisation_id;
    
    $nom=$json_decode->nom; 

    $types=$json_decode->types;

    $descriptions=$json_decode->descriptions; 
    
    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO acteur (application_id, unite_organisation_id, nom, types, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $uniteOrganisationId);

            $stmt->bindParam(3, $nom);

            $stmt->bindParam(4, $types);

            $stmt->bindParam(5, $descriptions);

            $stmt->bindParam(6, $dateCreation);

            $stmt->bindParam(7, $dateUpdate);

            $stmt->bindParam(8, $heureCreation);

            $stmt->bindParam(9, $heureUpdate);

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

                    $data["unite_organisation_id"]  = "$uniteOrganisationId";
                    
                    $data["nom"]  = "$nom";

                    $data["types"]  = "$types";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";

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