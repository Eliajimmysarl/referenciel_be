<?php

    $texte=$json_decode->texte;

    $selec=$json_decode->selec; 

    $dates=$json_decode->dates; 

    $telephone=$json_decode->telephone; 

    $email=$json_decode->email; 

    $passwords=$json_decode->passwords; 

    $optionsRadios=$json_decode->optionsRadios;

    $dateCreation = date("Y-m-d");
    
    $heureCreation = date("H:i:s");

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_test, $user_test, $pass_test);

            $stmt = $dbh->prepare("INSERT INTO test (texte, selec, dates, telephone, email, passwords, optionsRadios,  date_creation, heure_creation) VALUES (?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $texte);

            $stmt->bindParam(2, $selec);

            $stmt->bindParam(3, $dates);

            $stmt->bindParam(4, $telephone);

            $stmt->bindParam(5, $email);

            $stmt->bindParam(6, $passwords);

            $stmt->bindParam(7, $optionsRadios);

            $stmt->bindParam(8, $dateCreation);
             
            $stmt->bindParam(9, $heureCreation);

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

                    $data["text"]  = "$texte";

                    $data["select"]  = "$selec";

                    $data["email"]  = "$email";

                    $data["dates"]  = "$dates";

                    $data["telephone"]  = "$telephone";

                    $data["optionsRadios"]  = "$optionsRadios";

                    $data["reponse"]  = "Le test $text $select avec l'id $id est cree";  
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