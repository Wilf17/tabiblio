<?php

if (isset($_COOKIE['t_k'])) {

  include('../main.php');

  $token = $_COOKIE['t_k'];
  //verify if ecole existswith token 
  $query = mysqli_query($con, "select * from ecole where token='$token'");
  $count = 0;
  //if it exists
  if ($row = mysqli_fetch_array($query)) {
    //setcookie("t_k", $token);
    $ecole = $row;

    //get the documents
    $nom_ecole = $ecole['nom'];
    $sql = "select * from document where ecole='$nom_ecole'";
    //echo $sql; exit;
    $query = mysqli_query($con, $sql);
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
  <title>Gérer mes demandes</title>
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
  </header>
  <section class="section courses" data-section="section4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Demandes d'enregistrement en attente</h2>
          </div>
        </div>
        <div class="owl-carousel owl-theme" >
          <?php
          $index = 1;
          while ($row = mysqli_fetch_array($query)) {
          ?>
            <div class="item"><img src="<?php echo API_URL . $row['apercu_doc'] ?>" alt="website template image">
              <div class="down-content">
                <h4><a href="Gestiondemande.php?doc=<?php echo $row['id_document'] ?>"><button type="button" class="btn btn-primary">Ouvrir</button></a>
                  <?php

                  if ($row['validated_at'] != null) {
                  ?>

                   Validé ✓

                  <?php
                  }

                  ?>
                </h4>

              </div>
            </div>

          <?php
          }
          ?>

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