<?php

if (isset($_COOKIE['t_k'])) {

    include('../main.php');
    if (!isset($_GET['doc'])) {
        echo "<script>alert('Aucun document sélectionné !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
        exit;
    }

    $doc_id = $_GET['doc'];
    $token = $_COOKIE['t_k'];
    //verify if ecole existswith token 
    $query = mysqli_query($con, "select * from ecole where token='$token'");
    $count = 0;
    //if it exists
    if ($row = mysqli_fetch_array($query)) {
        //setcookie("t_k", $token);
        $ecole = $row;

        //get the documents
        $sql = "select * from document where id_document=$doc_id";

        $query = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_array($query)) {
            $document = $row;
        } else {
            echo "<script>alert('Document non trouvé !');</script>";
            echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Veuillez d'abord vous connecter !');</script>";
        echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
    }
} else {
    echo "<script>alert('Veuillez d'abord vous connecter !');</script>";
    echo "<script type='text/javascript'> document.location ='http://tabiblio.loc:81'; </script>";
}

?>


<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Gestion des demandes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web\css\all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <script type="text/javascript">
        (function() {
            var bsa = document.createElement('script');
            bsa.type = 'text/javascript';
            bsa.async = true;
            bsa.src = '../../../../../../../s3.buysellads.com/ac/bsa.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
        })();
    </script>
    <header class="main-header clearfix" role="header">
        <div class="logo"><a href="#"><em>Ta</em>Biblio</a></div>
        <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
        <nav id="menu" role="navigation" class="main-nav w-100">
            <ul class="main-menu">
                <li><a href="index.html"><button type="button" class="btn btn-light"><i class="fa-solid fa-house-user"></i></button></a></li>
                <li><a href="EnregistrementFil.html">Mes filières</a></li>
                <li><a href="GererDemande.php">Gérer les demandes d'enregistrement</a></li>
                <li><a href="DashbordSchool.html">Tableau de bord</a></li>
                <li style="padding: 0.2em; border-radius: 0.5em; background-color: white;"><img style="max-width:40px" class="rounded" src="<?php echo API_URL . $ecole['logo'] ?>" alt="Pp"></li>
                <li><a href="Notification.html">
                        <button type="button" class="btn btn-light position-relative"><i class="fa-solid fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                0</span>
                        </button></a>
                </li>
            </ul>
        </nav>
    </header>
    <section class="section courses" data-section="section4" style="margin-top:80opx">
        <form action="http://api-tabiblio.loc:81/valider-docu.php" method="post">
            <table class="table w-100 mb-4" style="color:white">
                <thead>
                    <tr>
                        <th scope="col-6">Auteur(s)</th>
                        <th scope="col-6">....</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Type du document</th>
                        <td><?php echo $document['type_doc'] ?></td>>
                    </tr>
                    <tr>
                        <th scope="row">Ecole</th>
                        <td><?php echo $document['ecole'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Document</th>
                        <td><a style="color: white; font-weight: bold;" href="<?php echo API_URL . $document['fichier_doc'] ?>">Téléchager ↓</a></td>
                    </tr>
                    <tr>
                        <th scope="row">Nom du Maître de mémoire</th>
                        <td><?php echo $document['m_memoire'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Nom du Maître de stage</th>
                        <td><?php echo $document['m_stage'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Mentions</th>
                        <td><?php echo $document['mention'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Thème</th>
                        <td><?php echo $document['theme'] ?></td>
                    </tr>
                </tbody>
            </table>
            <input type="text" name="token" value="<?php echo $token; ?>" hidden>
            <input type="text" name="id_document" value="<?php echo $document['id_document']; ?>" hidden>
            <div class="row">

                <button type="submit" name="submit" value="<?php echo date('Y-m-d H:i:s') ?>" class="btn btn-success col-4">Valider</button>

                <div class="col-4"></div>

                <button type="submit" name="submit" value="null" class="btn btn-danger col-4">Rejeter</button>

            </div>
        </form>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Copyright 2022 TaBiblio | Design: Made with♥by Wilfrid✨
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>