<?php

//Databse Connection file
include('./dbconnection.php');
if (
    isset($_POST['auteurs'])
    && isset($_POST['type_doc'])
    && isset($_POST['ecole'])
    && isset($_POST['tels'])
    && isset($_POST['m_memoire'])
    && isset($_POST['m_stage'])
    && isset($_POST['mention'])
    && isset($_POST['filiere'])
    && isset($_POST['annee'])
    && isset($_POST['auteur_token'])
    && isset($_POST['theme'])
    && isset($_POST['description'])
) {

    $auteurs = $_POST['auteurs'];
    $auteur_token = $_POST['auteur_token'];
    $type_doc = $_POST['type_doc'];
    $ecole = $_POST['ecole'];
    $m_memoire = $_POST['m_memoire'];
    $m_stage = $_POST['m_stage'];
    $tels = $_POST['tels'];
    $mention = $_POST['mention'];
    $filiere = $_POST['filiere'];
    $annee = $_POST['annee'];
    $theme = $_POST['theme'];
    $description = $_POST['description'];

     //verify if token points to a connected user
    $query = mysqli_query($con, "select * from internaute where token='$auteur_token'");
    $count = 0;
    if ($row = mysqli_fetch_array($query)){
        $internaute = $row;
    }else{
        echo "<script>alert('Veuillez d'abord vous connecter !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }


    //verify if a document with same infos alreafy exists
    $query = mysqli_query($con, "select * from document where theme='$theme' && filiere='$filiere' && annee='$annee' && description='$description' ");
    $count = 0;
    while ($row = mysqli_fetch_array($query)) $count++;

    if ($count != 0) {
        echo "<script>alert('Un document avec ces informations est déjà enregistré !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Userspage/Enregistrement.php'; </script>";
        exit;
    }

    $path_to_docu = upload_files(
        "./uploads/documents/",
        "/uploads/documents/",
        "fichier_doc",
        ["pdf"],
        "Le fichier du document n'est pas valide ! Types autorisés : PDF.",
        15000000,
        "Le fichier du document est trop grand ! Taille max : 15Mb."
    );

    $path_to_apercu = upload_files(
        "./uploads/apercus/",
        "/uploads/apercus/",
        "apercu_doc",
        ["jpg", "png", "jpeg"],
        "Le fichier de l'aperçu n'est pas valide ! Types autorisés : JPG, PNG & JPEG.",
        5000000,
        "Le fichier de l'aperçu est trop grand ! Taille max : 500kb."
    );

    $created_at = new DateTime();
    $created_at = $created_at->format("Y-m-d H:i:s");
    $auteur_id = $internaute['id_internaute'];
    // Query for data insertion
    $sql = "insert into document(auteur_id, auteurs, type_doc, ecole, tels, fichier_doc, apercu_doc, m_memoire, m_stage, mention, theme, filiere, annee, description, created_at) value( $auteur_id, '$auteurs', '$type_doc', '$ecole', '$tels', '$path_to_docu', '$path_to_apercu', '$m_memoire', '$m_stage', '$mention', '$theme', '$filiere', '$annee', '$description', '$created_at' )";
   // echo $sql; exit;
    $query = mysqli_query($con, $sql);

    if ($query) {

         echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Userspage/Enregistrement_success.html'; </script>";
        
    } else {
        echo "<script>alert('Une erreur s\'est produite. Veuillez réessayer !');</script>";
        echo mysqli_error($con);
        //echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
    }

} else {
    echo "<script>alert('Certaines informations sont manquantes !');</script>";
    echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Userspage/Enregistrement.php'; </script>";
    exit;
}

function upload_files($target_dir, $target_dir_bd, $file_field_name, $types_allowed, $types_allowed_error_msg, $max_file_size, $max_file_size_error_msg)
{

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = uniqid() . "-" . basename($_FILES[$file_field_name]["name"]);
    $target_file = $target_dir . $file_name;
    $path_to_file = $target_dir_bd . $file_name;

    //echo $target_file; exit;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $msg = null;

    // Check file size
    if ($_FILES[$file_field_name]["size"] > $max_file_size) {
        $uploadOk = 0;
        echo "<script>alert('" . $max_file_size_error_msg . "');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Userspage/Enregistrement.php'; </script>";
        exit;
    }

    // Allow certain file formats
    if (
        !in_array($imageFileType, $types_allowed)
    ) {
        $uploadOk = 0;
        echo "<script>alert('" . $types_allowed_error_msg . "');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Userspage/Enregistrement.php'; </script>";
        exit;
    }

    if (!move_uploaded_file($_FILES[$file_field_name]["tmp_name"], $target_file)) {
        echo "<script>alert('Une erreur s\'est produite lors du téléversement de la photo.');</script>";
        exit;
        //echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
    }
    return $path_to_file;
}
