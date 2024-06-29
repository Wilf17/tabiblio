<?php
//Databse Connection file
include('../dbconnection.php');
if (
    isset($_POST['nom'])
    && isset($_POST['prenom'])
    && isset($_POST['mdp'])
    && isset($_POST['tel'])
    && isset($_POST['email'])
) {
    //getting the post values
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mdp'];
    $mdp_ = $_POST['mdp_'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $photo = $_FILES['photo'];

    if ($mdp != $mdp_) {
        echo "<script>alert('Les mots de passe ne sont pas identiques !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }

    //verify if a internaute alreafy exists
    $query = mysqli_query($con, "select * from internaute where email='$email' or tel='$tel'");
    $count = 0;
    while ($row = mysqli_fetch_array($query)) $count++;

    if ($count != 0) {
        echo "<script>alert('Un internaute avec ces informations est déjà enregistré !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }

    //verify if a ecole alreafy exists
    $query = mysqli_query($con, "select * from ecole where email='$email'");
    $count = 0;
    while ($row = mysqli_fetch_array($query)) $count++;

    if ($count != 0) {
        echo "<script>alert('Un utiliateur avec ces informations est déjà enregistré !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }


    $target_dir = "../uploads/internaute/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = uniqid() . "-" . basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $file_name;
    $path_to_file = "/uploads/internaute/" . $file_name;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $msg = null;
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "<script>alert('Le fichier de la photo n\'est pas une image !');</script>";
            echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
            exit;
        }
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        $uploadOk = 0;
        echo "<script>alert('Le fichier de la photo est trop grand ! Taille max : 500kb.');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $uploadOk = 0;
        echo "<script>alert('Le fichier de la photo n\'est pas valide ! Types autorisés : JPG, JPEG, PNG & GIF.');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Le fichier de la photo n\'a pas pu être téléversé !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";

            // Query for data insertion
            $query = mysqli_query($con, "insert into internaute(nom, prenom, mdp, tel, email, photo) value( '$nom','$prenom', '$mdp', '$tel', '$email', '$path_to_file' )");

            if ($query) {

                // echo "<script type='text/javascript'> document.location ='index.php'; </script>";
            } else {
                echo "<script>alert('Une erreur s\'est produite. Veuillez réessayer !');</script>";
                echo mysqli_error($con);
                //echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
            }
        } else {
            echo "<script>alert('Une erreur s\'est produite lors du téléversement de la photo.');</script>";
            echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
            exit;
        }
    }
} else {
    echo "<script>alert('Certaines informations sont manquantes !');</script>";
    echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://tabiblio.loc:81/css\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://tabiblio.loc:81/fontawesome-free-6.1.1-web\css\all.min.css">
    <link rel="stylesheet" href="http://tabiblio.loc:81/style.css">
    <title>Inscription réussie👻</title>
</head>

<body style="background-image:url(http://tabiblio.loc:81/Assets/triangles-1430105_1280.png); background-size:cover;background-attachment:fixed;background-position: center;">
    <!--page de'inscription reussi pour l'utilisateur//////////////////////////////////////////////////////////////////////////////////////////////-->
    <section style="display:grid;justify-content:center;align-items: center;color:white;height:50vh;">
        <h1>Inscription Réussie !</h1>
        <p>Bienvenue sur Tabiblio. Connectez-vous à votre compte pour commencer.</p>
        <button style="background-color:#d63384" type="button" class="btn btn-outline; btnConnexion me-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Se connecter</button>

        <!-- Pop-Up Se Connecter///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Inscription" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="Con09][nexion">Entrez les informations de votre compte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="Formulaire" action="http://api-tabiblio.loc:81/login.php" method="post" autocomplete="on" id="Connect">
                            <div>
                                <p>Veuillez entrer votre adresse mail
                                <div class="pa1"><i class="fa-solid fa-envelope"></i>
                                    <input class="Ip1" type="email" name="email" placeholder="Adresse mail" required>
                                </div>
                                </p>
                                <p>Veuillez entrer votre mot de passe
                                <div class="pa1"><i class="fa-solid fa-lock"></i>
                                    <input class="Ip1" type="password" name="mdp" placeholder="Entrez un mot de passe" required>
                                </div>
                                </p>
                                <input class="Ip1" name="type" value="internaute" style="display: none" hidden>
                                <p style="text-align:center">
                                    <button type="submit" style="width:60%;" class="btn btn-success">Login</button>
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="http://tabiblio.loc:81/js\bootstrap.bundle.min.js"></script>
</body>

</html>