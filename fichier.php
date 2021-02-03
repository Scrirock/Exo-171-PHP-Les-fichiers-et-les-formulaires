<?php

    $error = [];
    function getRngName($name): string
    {
        $ext = pathinfo($name);

        try{
            $bytes = random_bytes(15);
        }
        catch (Exception $e){
            $bytes = openssl_random_pseudo_bytes(15);
        }

        return bin2hex($bytes).".".$ext["extension"];
    }

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] === 0){

        $file = $_FILES["file"];
        $allowedImage = ['image/png', 'image/jpeg', 'image/webp'];
        if (in_array($file["type"], $allowedImage)){

            if ((int)$file["size"] <= 3 * 1024 * 1024){

                if (!is_dir("uploads")){
                    mkdir("uploads", "0755");
                }
                $name = getRngName($file["name"]);
                move_uploaded_file($file["tmp_name"], "uploads/". $name);
            }
            else $error[] = "image trop volumineuse.";
        }
        else $error[] = "n'envoyez que des .png, .jpeg, .webp";
    }
    else $error[] = "une erreur est survenue, réésayez.";

    if (count($error)){
        header("Location: index.php?e=". base64_encode(json_encode($error)));
    }
    else{
        header("Location: index.php?success");
    }

?>