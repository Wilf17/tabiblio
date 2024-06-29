<?php


//Databse Connection file
include('./dbconnection.php');
if (
    isset($_POST['token'])
    && isset($_POST['id_document'])
    && isset($_POST['submit'])
) {

    $token = $_POST['token'];
    $id_document = $_POST['id_document'];
    $submit = $_POST['submit'];

    //verify if token points to a connected user
    $query = mysqli_query($con, "select * from ecole where token='$token'");
    $count = 0;
    if ($row = mysqli_fetch_array($query)) {
        $ecole = $row;
    } else {
        echo "<script>alert('Veuillez d'abord vous connecter !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }


    //get a document
    $query = mysqli_query($con, "select * from document where id_document=$id_document");
    $count = 0;
    if ($row = mysqli_fetch_array($query)) {
        $document = $row;
    } else {
        echo "<script>alert('Le dodument n\'existe pas !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Schoolpage/Gestiondemande.php'; </script>";
        exit;
    }

    $ecole_nom = $ecole['nom'];
    $sql = "";
    if ($submit == "null") {
        // Query for data insertion
        $sql = "update document set validated_at=null, validated_by='$ecole_nom' where id_document=$id_document";
    } else {
        // Query for data insertion
        $sql = "update document set validated_at='$submit', validated_by='$ecole_nom' where id_document=$id_document";
    }

   // echo $sql; exit;
    $query = mysqli_query($con, $sql);

    if ($query) {

        echo "<script>alert('Document bien traité !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Schoolpage/GererDemande.php'; </script>";
    } else {
        echo "<script>alert('Une erreur s\'est produite. Veuillez réessayer !');</script>";
        echo mysqli_error($con);
        //echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
    }
} else {
    echo "<script>alert('Certaines informations sont manquantes !');</script>";
    echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/Schoolpage/Gestiondemande.php'; </script>";
    exit;
}
