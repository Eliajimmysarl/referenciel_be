<?php

    try {
    
            $dbh = new PDO('mysql:host=localhost;dbname='.$db_referentiel, $user, $pass);

            $stmt = $dbh->prepare("DELETE FROM entite WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt = $dbh->prepare("SELECT *FROM entite  ORDER BY id");
                    
            $stmt->execute();
                    
            $datas = array();
                    
                    while($resultat=$stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $datas["code"]  = 200;

                            $datas['entite'][]=$resultat;
                        }
                                
            echo json_encode( $datas);

        }

    catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage() . "<br/>";

            die();
        }
            
?>