<?php

    $textes=$json_decode->text;

    $dateUpdate = date("Y-m-d");
    
    $heureUpdate = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            for($i=0; $i < count($textes); ++$i)
                {
                    $id = $textes[$i][0];

                    $texte = $textes[$i][1];
               
                    $selec = $textes[$i][2];

                    $dates = $textes[$i][3];

                    $telephone = $textes[$i][4];
               
                    $email = $textes[$i][5];

                    $stmt = $dbh->prepare("UPDATE test SET texte=?, selec=?,  dates=?, telephone=?, email=?, date_update=?,  heure_update=? WHERE id=$id");

                    $stmt->bindParam(1, $texte);

                    $stmt->bindParam(2, $selec);

                    $stmt->bindParam(3, $dates);

                    $stmt->bindParam(4, $telephone);

                    $stmt->bindParam(5, $email);

                    $stmt->bindParam(6, $dateUpdate);

                    $stmt->bindParam(7, $heureUpdate);

                    $stmt->execute();
                }
            
          
            $data["code"]  = 200;

            $data["message"]  = "Ressource created";
                
            echo json_encode($data);
        
            $dbh = null; 
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
?>