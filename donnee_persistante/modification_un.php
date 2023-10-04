<?php

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

    $dateUpdate = date("Y-m-d");
    
    $heureUpdate = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            $stmt = $dbh->prepare("UPDATE donnee_persistante SET application_id=?, entite_id=?, nom=?, types=?, taille=?, defaut=?, valeur=?, indexe=?, cle_primaire=?, descriptions=?, date_update=?, heure_update=? WHERE id=? ");

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

            $stmt->bindParam(11, $dateUpdate);

            $stmt->bindParam(12, $heureUpdate);

            $stmt->bindParam(13, $id);

            $stmt->execute();          
   
            $data["code"]  = 200;

            $data["id"]  = "$id";

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

            $data["date_update"]  = "$dateUpdate";

            $data["heure_update"]  = "$heureUpdate";

            echo json_encode( $data );
            
                $dbh = null;
                    
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();

        }
        
?>    