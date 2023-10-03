<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
    
    $applicationId=$json_decode->application_id;

    $entiteId=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $types=$json_decode->types; 

    $taille=$json_decode->taille; 

    $defaut=$json_decode->defaut;

    $valeur=$json_decode->valeur;

    $indexe=$json_decode->indexe;

    $clePrimaire=$json_decode->cle_primaire;

    $descriptions=$json_decode->descriptions; 

    $dateCreation = date("Y-m-d");

    $dateCpdate = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    $heureUpdate = date("H:i:s");    
    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO donnee_persistante (application_id, entite_id, nom, types, taille, defaut, valeur, indexe, cle_primaire, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $applicationId);

            $stmt->bindParam(2, $entiteId);

            $stmt->bindParam(3, $nom);

            $stmt->bindParam(4, $types);

            $stmt->bindParam(5, $taille);

            $stmt->bindParam(6, $defaut);

            $stmt->bindParam(7, $valeur);

            $stmt->bindParam(8, $indexe);

            $stmt->bindParam(9, $clePrimaire);

            $stmt->bindParam(10, $descriptions);

            $stmt->bindParam(11, $dateCreation);

            $stmt->bindParam(12, $dateUpdate);

            $stmt->bindParam(13, $heureCreation);

            $stmt->bindParam(14, $heureUpdate);

             

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

                    $data["entite_id"]  = "$entiteId";

                    $data["nom"]  = "$nom";

                    $data["types"]  = "$types";

                    $data["taille"]  = "$taille";

                    $data["defaut"]  = "$defaut";

                    $data["valeur"]  = "$valeur";

                    $data["indexe"]  = "$indexe";

                    $data["cle_primaire"]  = "$clePrimaire";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$dateCreation";

                    $data["date_update"]  = "$dateUpdate";

                    $data["heure_creation"]  = "$heureCreation";

                    $data["heure_update"]  = "$heureUpdate";


                    $data["reponse"]  = "Le test $applicationId $entiteId avec l'id $id est cree";  
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