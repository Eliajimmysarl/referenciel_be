<?php 
    $imageId=$_POST['image_id'];
                    
    $photo=$_FILES["image"]["name"];
                    
    $ext = pathinfo($photo, PATHINFO_EXTENSION);
                    
    $destination = './image/'.$imageId.".". $ext;
                    
    $titrephoto = $imageId.".". $ext;
                    
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    
    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    
    $data["code"]  = 201;
                            
    $data["message"]  = "Ressource $titrephoto created";
 
    echo json_encode($data);