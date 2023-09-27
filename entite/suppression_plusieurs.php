<?php

    $textes=$json_decode->text;

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            for($i=0; $i < count($textes); ++$i)
                {
                    $id = $textes[$i][0];
                   
                    $stmt = $dbh->prepare("DELETE FROM test WHERE id = :id");

                   $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    $stmt->execute();
                }
            
          
            $data["code"]  = 200;

            $data["message"]  = "Ressource Deleted";
                
            echo json_encode($data);
        
            $dbh = null; 
        }
    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
?>