<?php

    try {
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referenciel, $user, $pass);

            $stmt = $dbh->prepare("SELECT *FROM composant  ORDER BY id");

            $stmt->execute();

            $datas = array();

            $nombreLigne = $stmt->rowCount();
            
            if($nombreLigne > 0)
                { 
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;
                            
                            $datas['composant'][]=$resultat;
                        }
                }
            else
                {
                    $datas["code"]  = 400;
        
                    $datas['token'][]="Ressource not found";
                }   
            echo json_encode($datas);
            
        }
    catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
    }
?> 