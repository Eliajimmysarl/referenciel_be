<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
    
    
    $composantEntiteId=$json_decode->composant_id;

    $entiteId=$json_decode->entite_id; 

    $model=$json_decode->model; 

    $view=$json_decode->view; 

    $interface=$json_decode->interface; 

    $services=$json_decode->services; 

    $descriptions=$json_decode->descriptions; 
    
    $dateCreation = date("Y-m-d");

    $dateUpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");
   
    $heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO interaction_entite ( composant_entite_id, entite_id, model, view, interface, services, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $composantEntiteId);

            $stmt->bindParam(2, $entiteId);

            $stmt->bindParam(3, $model);

            $stmt->bindParam(4, $view);

            $stmt->bindParam(5, $interface);

            $stmt->bindParam(6, $services);

            $stmt->bindParam(7, $descriptions);

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

                    $data["composant_entite_id"]  = "$composantEntiteId";

                    $data["entite_id"]  = "$entiteId";

                    $data["model"]  = "$model";

                    $data["view"]  = "$view";

                    $data["interface"]  = "$interface";

                    $data["services"]  = "$services";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";

                    $data["reponse"]  = "Le test $entiteId $entiteId avec l'id $id est cree";  
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