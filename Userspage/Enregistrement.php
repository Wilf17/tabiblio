<?php
if (isset($_COOKIE['t_k'])) {

  include('../main.php');

  $token = $_COOKIE['t_k'];
  //verify if internaute existswith token 
  $query = mysqli_query($con, "select * from internaute where token='$token'");
  $count = 0;
  //if it exists
  if ($row = mysqli_fetch_array($query)) {
    setcookie("t_k", $token);
    $internaute = $row;
  } else {
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
  <title>Enregistrer mon document</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome-free-6.1.1-web\css\all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body style="background-image:url(assets/images/texture-1444067_1280.jpg); background-size:cover;background-attachment:fixed;background-position: center;">
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
          <nav class="main-nav"><a href="#" class="logo"><img src="assets/images/logo.jpeg" class="rounded mx-auto float-start mon_logo"></a>
            <ul class="nav">
              <li class="scroll-to-section"><a href="index.php"><button type="button" class="btn btn-light"><i class="fa-solid fa-house-user"></i></button></a></li>
              <li class="scroll-to-section"><a href="Monprofile.php">Mon Profile</a></li>
              <li class="scroll-to-section"><a href="Enregistrement.php">Enregistrer document</a></li>
              <li class="scroll-to-section"><a href="Tableaudebord.php">Tableau de bord</a></li>
              <li class="scroll-to-section">
                <form class="d-flex" role="search">
                  <input class="form-control me-2" style="width:80%" type="search" placeholder="Rechercher" aria-label="Search">
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
  <section class="container mb-4" style="margin-top:80px">
    <h3>Enregistrer votre document sur la plateforme en remplissant le formulaire ci-dessous</h3>
  </section>
  <section style="display:flex;justify-content:center;align-items:center; width:100%">
    <div class="col-lg-6">
      <div class="contact-form">
        <form id="contact" action="http://api-tabiblio.loc:81/new-docu.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-12">
              <h4>Enregistrer mon doucment</h4>
            </div>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <input name="auteurs" type="text" id="Auteur" placeholder="Auteur(s) du doc*" required>
              </fieldset>
            </div>
            <input name="auteur_token" style="display: none;" value="<?php echo $internaute['token'] ?>" type="text" hidden>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <select value="type_doc" name="type_doc" id="Type-document">
                  <option value="type_doc">Type de document</option>
                  <option name="Memoire" id="M1">Mémoire</option>
                  <option name="Rapport de stage" id="M2">Rapport de stage</option>
                </select>
              </fieldset>
            </div>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <select value="ecole" name="ecole" id="MonEcole">
                  <option value="ecole">Choisissez votre écoles</option>
                  <?php
                  $query = mysqli_query($con, "select * from ecole");
                  $count = 0;
                  //if it exists
                  while ($row = mysqli_fetch_array($query)) {
                  ?>

                    <option name="ecole" value="<?php echo $row['nom'] ?>" id="M1"><?php echo $row['nom'] ?></option>

                  <?php
                  }
                  ?>
                  
                </select>
              </fieldset>
            </div>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <input name="tels" type="number" id="Num-momo" placeholder="Vos numéros momos*" required>
              </fieldset>
            </div>
            <div class="col-lg-6 col-sm-12">
              Document
              <fieldset>
                <input name="fichier_doc" type="File" id="file" required>
              </fieldset>
            </div>
            <div class="col-lg-6 col-sm-12">
              Aperçu du document
              <fieldset>
                <input name="apercu_doc" type="file" id="file" required>
              </fieldset>
            </div>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <input name="m_memoire" type="text" id="MM" placeholder="Nom du Maître de mémoire*(Si neccessaire)">
              </fieldset>
            </div>
            <div class="col-lg-6 col-sm-12">
              <fieldset>
                <input name="m_stage" type="text" id="MS" placeholder="Nom du Maître de stage*" required>
              </fieldset>
            </div>
            <div class="col-md-6 col-sm-12">
              <fieldset>
                <select value="mention" name="mention" id="Mention*">
                  <option value="mention">Mention</option>
                  <option name="Honnorable" id="H1">Honnorable</option>
                  <option name="TrèsB" id="T1">Très Bien</option>
                  <option name="Bien" id="B1">Bien</option>
                  <option name="AssezB" id="A1">Assez Bien</option>
                  <option name="Passable" id="P1">Passable</option>
                </select>
              </fieldset>
            </div>
            <div class="col-md-6 col-sm-12">
              <fieldset>
                <input name="theme" type="text" id="Theme" placeholder="Thème*" required>
              </fieldset>
            </div>
            <div class="col-md-6 col-sm-12">
              <fieldset>
                <input name="annee" type="text" id="annee" placeholder="Année de soutenance*" required>
              </fieldset>
            </div>
            <div class="col-md-6 col-sm-12">
              <fieldset>
                <input name="filiere" type="text" id="filiere" placeholder="Filière*" required>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <textarea name="description" rows="12" id="message" placeholder="description/résumé de votre document*" required></textarea>
              </fieldset>
            </div>
            <div class="col-lg-12">
              <fieldset>
                <button type="submit" id="form-submit" class="main-button-icon">Enregistrer</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <footer Style="background:none">
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
</body>

</html>