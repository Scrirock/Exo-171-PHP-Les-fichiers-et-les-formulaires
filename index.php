<?php

/**
 * 1. Créez un formulaire classique contenant un champs input de type file
 * 2. Faites pointer l'action sur la page fichier.php ( que vous créerez )
 * 3. Gérez l'upload du fichier, le fichier doit être stocké dans le répertoire upload de votre site
 * 4. Gérez tous les cas de figure:
 *    - Le fichier doit être une image
 *    - On ne peut pas uploader de fichier image de plus de 3Mo
 *    - Les fichiers doivent être renommés
 *    - Affichez les erreurs sur la page index.php s'il y en a ( fichier non présent, erreur d'upload, etc... )
 * ( BONUS )
 * 5. Une fois l'upload terminé, enregistrez le nom du fichier uploadé dans le fichier file.json ( que vous créerez s'il n'existe pas )
 *    Attention, trouvez une solution pour que le fichier contienne du JSON valide !
 * 6. Affichez sur la page index les fichiers ayant déjà été uploadés.
 */

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formulair</title>
</head>
<body>

    <form action="fichier.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit">
    </form>

    <?php

        if (isset($_GET["success"])){
            echo "fichier envoyé sans erreur";
        }
        elseif (isset($_GET["e"])){
            $errors = base64_decode($_GET["e"]);
            $errors = json_decode($errors);
            foreach ($errors as $error){
                echo $error."<br>";
            }
        }
    ?>

</body>
</html>