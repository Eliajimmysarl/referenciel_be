<?php

    $myjson=file_get_contents('php://input');

    $json_decode= json_decode($myjson);
    
    $application_id=$json_decode->application_id;

    $entite_id=$json_decode->entite_id; 

    $nom=$json_decode->nom; 

    $types=$json_decode->types; 

    $taille=$json_decode->taille; 

    $defaut=$json_decode->defaut;

    $valeur=$json_decode->valeur;

    $indexe=$json_decode->indexe;

    $cle_primaire=$json_decode->cle_primaire;

    $descriptions=$json_decode->descriptions; 

    $date_creation = date("Y-m-d");

    $date_update = date("Y-m-d");
    
    $heure_creation = date("H:i:s");

    $heure_update = date("H:i:s");    
    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            $stmt = $dbh->prepare("INSERT INTO donnee_persistante (application_id, entite_id, nom, types, taille, defaut, valeur, indexe, cle_primaire, descriptions, date_creation, date_update, heure_creation, heure_update) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $application_id);

            $stmt->bindParam(2, $entite_id);

            $stmt->bindParam(3, $nom);

            $stmt->bindParam(4, $types);

            $stmt->bindParam(5, $taille);

            $stmt->bindParam(6, $defaut);

            $stmt->bindParam(7, $valeur);

            $stmt->bindParam(8, $indexe);

            $stmt->bindParam(9, $cle_primaire);

            $stmt->bindParam(10, $descriptions);

            $stmt->bindParam(11, $id);

            $stmt->bindParam(12, $date_creation);

            $stmt->bindParam(13, $date_update);

            $stmt->bindParam(14, $heure_creation);

            $stmt->bindParam(15, $heure_update);

           

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

                    $data["entite_id"]  = "$entite_id";

                    $data["nom"]  = "$nom";

                    $data["types"]  = "$types";

                    $data["taille"]  = "$taille";

                    $data["defaut"]  = "$defaut";

                    $data["valeur"]  = "$valeur";

                    $data["indexe"]  = "$indexe";

                    $data["cle_primaire"]  = "$cle_primaire";

                    $data["descriptions"]  = "$descriptions";

                    $data["date_creation"]  = "$date_creation";

                    $data["date_update"]  = "$date_update";

                    $data["heure_creation"]  = "$heure_creation";

                    $data["heure_update"]  = "$heure_update";


                    $data["reponse"]  = "Le test $application_id $entite_id avec l'id $id est cree";  
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