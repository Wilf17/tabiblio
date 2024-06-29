<?php
//Databse Connection file
include('./dbconnection.php');

function proceed_login($con, $email, $table, $redir_url)
{
    $token = md5(uniqid("", true)) . md5(uniqid($email, true));
    $query = mysqli_query($con, "update $table set token='$token' where email='$email'");
    if ($query) {
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81/" . $redir_url . "/index.php?t_k=" . $token . "'; </script>";
    } else {
        echo "<script>alert('Une erreur s\'est produite. Veuillez réessayer !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        echo mysqli_error($con);
    }
}

if (
    isset($_POST['email'])
    && isset($_POST['mdp'])
) {

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    //verify if it is internaute
    $query = mysqli_query($con, "select * from internaute where email='$email'");
    $count = 0;

    if ($row = mysqli_fetch_array($query)) {
        if ($row['mdp'] == $mdp) {
            proceed_login($con, $email, "internaute", "Userspage");
        } else {
            echo "<script>alert('Le mot de passe fourni n\'est pas correct !');</script>";
            echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
            exit;
        }
    } else {

        //verify if ecole
        $query = mysqli_query($con, "select * from ecole where email='$email'");
        $count = 0;
        if ($row = mysqli_fetch_array($query)) {
            proceed_login($con, $email, "ecole", "Schoolpage");
        } else {
            echo "<script>alert('L\'e-mail fourni ne correspond à aucun utilisateur !');</script>";
            echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
            exit;
        }
    }
} else {
    echo "<script>alert('Certaines informations sont manquantes !');</script>";
    echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
    exit;
}
