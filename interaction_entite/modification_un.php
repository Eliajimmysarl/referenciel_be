<?php

$composantEntiteId=$json_decode->composant_id;

$entiteId=$json_decode->entite_id; 

$model=$json_decode->model; 

$view=$json_decode->view; 

$interface=$json_decode->interface; 

$services=$json_decode->services; 

$descriptions=$json_decode->descriptions; 

$dateUpdate = date("Y-m-d");

$heureUpdate = date("H:i:s");    

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass); 

            $stmt = $dbh->prepare("UPDATE interaction_entite SET composant_entite_id=?, entite_id=?, model=?, view=?, interface=?, services=?, descriptions=?, date_update=?,  heure_update=? WHERE id=?");

            $stmt->bindParam(1, $composantEntiteId);

            $stmt->bindParam(2, $entiteId);

            $stmt->bindParam(3, $model);

            $stmt->bindParam(4, $view);

            $stmt->bindParam(5, $interface);

            $stmt->bindParam(6, $services);

            $stmt->bindParam(7, $descriptions);

            $stmt->bindParam(8, $dateUpdate);

            $stmt->bindParam(9, $heureUpdate);

            $stmt->bindParam(10, $id);

            $stmt->execute();

           
            $data["code"]  = 200;

            $data["id"]  = "$id";

            $data["composant_entite_id"]  = "$composantEntiteId";

            $data["entite_id"]  = "$entiteId";

            $data["model"]  = "$model";

            $data["view"]  = "$view";

            $data["interface"]  = "$interface";

            $data["services"]  = "$services";

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