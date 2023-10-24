<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
   
    $applicationId=$json_decode->application_id;

    $composantId=$json_decode->composant_id; 

    $entiteId=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $types=$json_decode->types; 

    $descriptions=$json_decode->descriptions; 

    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");    
    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO donnee_echange (application_id, composant_id, entite_id, nom, types, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $composantId);

            $stmt->bindParam(3, $entiteId);

            $stmt->bindParam(4, $nom);

            $stmt->bindParam(5, $types);

            $stmt->bindParam(6, $descriptions);

            $stmt->bindParam(7, $dateCreation);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureCreation);

            $stmt->bindParam(10, $heureUpdate);

           

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

                    $data["composant_id"]  = "$composantId";

                    $data["entite_id"]  = "$entiteId";

                    $data["nom"]  = "$nom";

                    $data["types"]  = "$types";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";


                    $data["reponse"]  = "Le test $applicationId $entiteid avec l'id $id est cree";  
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