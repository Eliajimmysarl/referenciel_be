<?php

    $textes=$json_decode->text;

    $dateCreation = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            for($i=0; $i < count($textes); ++$i)
                {
                    $text = $textes[$i][0];
               
                    $select = $textes[$i][1];

                    $stmt = $dbh->prepare("INSERT INTO test (texte, selec, , date_creation, heure_creation) VALUES (?,?,?,?)");

                    $stmt->bindParam(1, $text);
        
                    $stmt->bindParam(2, $select);
                    
                    $stmt->bindParam(3, $dateCreation);
             
                    $stmt->bindParam(4, $heureCreation);

                    $stmt->execute();
                }
            
            $last = $dbh->lastInsertId();
              
            if($last==0)
                {
                    $data["code"]  = 400;

                    $data["message"]  = "Ressource not created";
                }
            else
                {
                    $data["code"]  = 201;

                    $data["message"]  = "Ressource created";
                }
            
            echo json_encode($data);
        
            $dbh = null; 
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
?>