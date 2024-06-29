<?php

if (isset($_COOKIE['t_k'])) {

  include('../main.php');

  function echo_date_pretty($date_string)
  {

    $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_string);
    //if moins de 24h ago
    if (time() - $date->getTimestamp() < (1000 * 60 * 60 * 24)) {
      echo time_elapsed_string($date_string, true);
    } else {
      // echo (time() * 1000); exit;  
      echo $date->format('d/m/Y à H:i');
    }
  }

  $token = $_COOKIE['t_k'];
  //verify if internaute existswith token 
  $query = mysqli_query($con, "select * from internaute where token='$token'");
  $count = 0;
  //if it exists
  if ($row = mysqli_fetch_array($query)) {
    //setcookie("t_k", $token);
    $internaute = $row;

    //get the documents
    $auteur_id = $internaute['id_internaute'];
    $sql = "select * from document where auteur_id=$auteur_id";

    $query = mysqli_query($con, $sql);
    if (!$query) {
      echo "<script>alert('Une erreur s\'est produite. Veuillez réessayer !');</script>";
      echo mysqli_error($con);
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
  <title>Tableau de bord User</title>
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
  <section style="margin-top:80px">
   <!--  <h3 style="text-align:center" class="mb-5">Mes documents téléchargés</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col-3">#</th>
          <th scope="col-3">Type</th>
          <th scope="col-3">Date télechargement</th>
          <th scope="col-3">Documents</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mémoire</td>
          <td>12/07/2022</td>
          <td>(Recuperer le document en question)</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Rapport de stage</td>
          <td>21/11/2022</td>
          <td>(Recuperer le document en question)</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>.......</td>
          <td>.......</td>
          <td>.......</td>
        </tr>
      </tbody>
    </table> -->
    <h3 style="text-align:center" class="mb-5 mt-5">Mes documents enregistrés</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Type</th>
          <th scope="col">Thème</th>
          <th scope="col">Date d'enregistrement</th>
          <th scope="col">Date de validation</th>
          <th scope="col">Document</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $index = 1;
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <th scope="row"> <?php echo $index++ ?> </th>
            <td> <?php echo $row['type_doc'] ?> </td>
            <td> <?php echo $row['theme'] ?> </td>
            <td> <?php echo_date_pretty($row['created_at']); ?> </td>
            <td> <?php echo ($row['validated_at'] == null ? 'En attente...' : echo_date_pretty($row['validated_at'])); ?> </td>
            <td><a style="color: black; font-weight: bold;" href="<?php echo API_URL . $row['fichier_doc'] ?>">Téléchager ↓</a></td>
          </tr>

        <?php
        } ?>



      </tbody>
    </table>
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