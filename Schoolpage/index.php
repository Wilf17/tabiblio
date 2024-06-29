<?php

function login_form()
{
?>
  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://tabiblio.loc:81/css\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://tabiblio.loc:81/fontawesome-free-6.1.1-web\css\all.min.css">
    <link rel="stylesheet" href="http://tabiblio.loc:81/style.css">
    <title>Tabiblio - Connexion</title>
  </head>

  <body style="background-image:url(http://tabiblio.loc:81/Assets/triangles-1430105_1280.png); background-size:cover;background-attachment:fixed;background-position: center;">
    <!--page de'inscription reussi pour l'utilisateur//////////////////////////////////////////////////////////////////////////////////////////////-->
    <section style="display:grid;justify-content:center;align-items: center;color:white;height:50vh;">
      <h1>Bienvenue à Tabiblio !</h1>
      <p>Connectez-vous à votre compte pour commencer.</p>
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
                  <input class="Ip1" name="type" value="ecole" style="display: none" hidden>
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
<?php
}

//if token provided
if (isset($_GET['t_k']) || isset($_COOKIE['t_k'])) {
  // verify if token is correct
  include('../main.php');
  //verify if ecole existswith token 
  $query = mysqli_query($con, "select * from ecole where token='$token'");
  $count = 0;
  //if it exists
  if ($row = mysqli_fetch_array($query)) {
    setcookie("t_k", $token);
    $ecole = $row;
  } else {

    //if it not exists login form
    login_form();
    exit;
  }


?>


<?php

  //if token not provided
} else {
  login_form();
  exit;
}
?>
?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>Acceuil TaBiblio</title>
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
                0
            </button></a>
        </li>
      </ul>
    </nav>
  </header>
  <section class="section main-banner" id="top" data-section="section1">
    <video autoplay muted loop id="bg-video">
      <source src="assets/media/01.mp4" type="video/mp4">
    </video>
    <div class="video-overlay header-text">
      <div class="caption">
        <h6>Gérer la bibliothèque de votre école facilement</h6>
        <h2><em>Ta</em>Biblio</h2>
      </div>
    </div>
  </section>
  <section class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="features-post">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-pencil"></i>Controler la gestion de vos ressources</h4>
              </div>
              <div class="content-hide">
                <p>Vous jouez un rôle important dans la mise en place de cette plateforme en ligne. Vous êtes invités à contrôler le flux des ressources entrants qui devront être publié sur la plateforme.</p>
                <p class="hidden-sm">Vous jouez un rôle important dans la mise en place de cette plateforme en ligne. Vous êtes invités à contrôler le flux des ressources entrants qui devront être publié sur la plateforme.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="features-post second-features">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-graduation-cap"></i>Privilégier la qualité</h4>
              </div>
              <div class="content-hide">
                <p>Nous privilégions toujours la qualité des services proposés aux utilisateurs de la plateforme. C'est pour cela que vous avez la possibilité de filtrer les contenus provenants de votre établissement qui seront publiés sur notre application.</p>
                <p class="hidden-sm">Nous privilégions toujours la qualité des services proposés aux utilisateurs de la plateforme. C'est pour cela que vous avez la possibilité de filtrer les contenus provenants de votre établissement qui seront publiés sur notre application.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="features-post third-features">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-book"></i>Certifier les contenus</h4>
              </div>
              <div class="content-hide">
                <p>Les documents déposés sur la plateforme doivent pouvoir être retracer. C'est pour cela qu'il est impérativement important que vous certifiez que ces documents proviennent de votre établissement pour plus de sécurité pour la plateforme.</p>
                <p class="hidden-sm">Les documents déposés sur la plateforme doivent pouvoir être retracer. C'est pour cela qu'il est impérativement important que vous certifiez que ces documents proviennent de votre établissement pour plus de sécurité pour la plateforme.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section courses" data-section="section4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Quelques document de vos étudiants</h2>
          </div>
        </div>
        <div class="owl-carousel owl-theme">
          <div class="item"><img src="assets/images/courses-01.png" alt="website template image">
            <div class="down-content">
              <h4>Nom Auteurs document</h4>
            </div>
          </div>
          <div class="item"><img src="assets/images/courses-01.png" alt="website template image">
            <div class="down-content">
              <h4>Nom Auteurs document</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
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