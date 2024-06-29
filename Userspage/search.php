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
<?php
}

//if token provided
if (isset($_GET['search']) &&  isset($_COOKIE['t_k'])) {
  // verify if token is correct
  include('../main.php');
  //verify if internaute existswith token 
  $query = mysqli_query($con, "select * from internaute where token='$token'");
  $count = 0;
  //if it exists
  if ($row = mysqli_fetch_array($query)) {
    setcookie("t_k", $token);
    $internaute = $row;
  } else {

    //if it not exists login form
    login_form();
    exit;
  }

  $search = $_GET['search'];
  $query = mysqli_query($con, "select * from document where auteurs LIKE '%$search%' or type_doc LIKE '%$search%' or ecole LIKE '%$search%' or m_memoire LIKE '%$search%' or m_stage LIKE '%$search%' or theme LIKE '%$search%' or filiere LIKE '%$search%' or description LIKE '%$search%'");


?>


<?php

  //if token not provided
} else {
  login_form();
  exit;
}
?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <title>Recherche Tabiblio</title>
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
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav w-100"><a href="index.php?t_k=<?php echo $token; ?>" class="logo"><img src="assets/images/logo.jpeg" class="rounded mx-auto float-start mon_logo"></a>
            <ul class="nav">
              <li class="scroll-to-section"><a href="index.php?t_k=<?php echo $token; ?>"><button type="button" class="btn btn-light"><i class="fa-solid fa-house-user"></i></button></a></li>
              <li class="scroll-to-section"><a href="Monprofile.php">Mon Profile</a></li>
              <li class="scroll-to-section"><a href="Enregistrement.php">Enregistrer document</a></li>
              <li class="scroll-to-section"><a href="Tableaudebord.php">Tableau de bord</a></li>
              <li class="scroll-to-section">
                <form class="d-flex" action="./search.php" method="get">
                  <input class="form-control me-2" style="width:80%" name="search" placeholder="Rechercher" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit"><i class=" text-muted fas fa-search"></i></button>
                </form>
              </li>
              <li class="scroll-to-section"><a href="Notification.html">
                  <button type="button" class="btn btn-danger position-relative"><i class="fa-solid fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                      0
                  </button></a>
              </li>
              <li class="scroll-to-section"><img style="max-width:40px; border-radius: 3em;" src="<?php echo API_URL . $internaute['photo'] ?>" alt="Pp"></li>
            </ul>
            <a class="menu-trigger"><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>


  <section class="section" id="menu">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-heading">
            <h6>Recherche pour : <?php echo $search; ?></h6>
            <h2>Document trouvés</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-item-carousel">
      <div class="col-lg-12">
        <div class="owl-menu-item owl-carousel">

          <?php

          while ($row = mysqli_fetch_array($query)) { ?>

            <div class="item">
              <div class="card card1">
                <div class="price">
                  <h6><a href="https://www.fedapay.com/?v=ddd70bbaf5be">
                      <button type="button" class="btn btn-danger position-relative">200f
                      </button></a></h6>
                </div>
                <div class="info">
                  <h1 class="title"><?php echo $row['theme'] ?></h1>
                  <p class="description"><?php echo $row['description'] ?></p>
                  <div class="main-text-button">
                    <div class="scroll-to-section"><a href="<?php echo $row['fichier_doc'] ?>">Télecharger<i class="fa fa-angle-down"></i></a></div>
                  </div>
                </div>
              </div>
            </div>

          <?php
          }
          ?>

        </div>
      </div>
    </div>
  </section>

  <section class="section" id="reservation">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="left-text-content">
            <div class="section-heading">
              <h6>Contactez Nous</h6>
              <h2>Pour tout vos projets web ou informatique vous pouvez nous joindre nous serions ravis de vous aider</h2>
            </div>
            <p>Ceci est l'adresse des réalisateurs de ce projet</p>
            <div class="row">
              <div class="col-lg-6">
                <div class="phone"><i class="fa fa-phone"></i>
                  <h4>Phone</h4>
                  <span><a href="#">+229 96-15-82-05</a><br>
                    <a href="#">+229 67-79-99-32</a></span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="message"><i class="fa fa-envelope"></i>
                  <h4>Emails</h4>
                  <span><a href="mailto:tabiblio22@gmail.com">tabiblio22@gmail.com</a></span>
                  <span><a href="mailto:wilflht@gmail.com">wilflht@gmail.com</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-xs-12">
          <div class="right-text-content">
            <ul class="social-icons">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="logo"><a href="#"><img src="assets/images/logo.jpeg" alt="website template image"></a></div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="left-text-content">
            <p>&copy; Copyright Tabiblio<br>
              Made with♥by Wilfrid✨
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/custom.js"></script>

  </div>
</body>

</html>