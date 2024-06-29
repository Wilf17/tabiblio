<?php

if (isset($_COOKIE['t_k'])) {

  include('../main.php');

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
  <title>Mon Profile</title>
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
  <section style="margin-top:80px;">
    <h2>Les informations liées a votre compte:</h2>
    <table class="table mt-4 mb-4" style="background:rgb(255, 255, 255);">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Votre Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">E-mail</th>
          <th scope="col">Tel</th>
          <th scope="col">Photo de profil</th>
        </tr>
      </thead>
      <tbody style="height:100%">
        <tr>
          <th scope="row">→</th>
          <td> <?php echo $internaute['nom'] ?> </td>
          <td> <?php echo $internaute['prenom'] ?> </td>
          <td> <?php echo $internaute['email'] ?> </td>
          <td> <?php echo $internaute['tel'] ?> </td>
          <td><img style="max-width:25px" src="assets/images/author-01.png" alt="Pp"></td>
        </tr>
      </tbody>
    </table>
    <div class="container">
      <h4 class="mb-3" style="text-align:center">Nos politiques de confidentialités:</h4>
      <div class="row">
        <div class="col-6">
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus est similique iste perspiciatis tempora labore reprehenderit accusantium? Neque earum unde reiciendis, porro ullam quibusdam laudantium quos maxime, ducimus ipsam placeat error vero illum laborum, ratione accusantium hic ex architecto repellat voluptatibus recusandae atque eligendi dolores corporis? Eveniet earum quas id. Rerum sequi iure debitis cupiditate et porro reprehenderit officiis minus! Id illum reprehenderit magni consectetur? Hic deleniti ab quas quo? Sequi delectus quidem omnis aperiam. Distinctio praesentium ipsam quia ad beatae! Illum hic aperiam similique recusandae at, veritatis pariatur laudantium dignissimos tempora aliquam aspernatur earum, distinctio rem minus quis quod consequuntur molestias nemo quae quas nihil. Commodi ipsa libero quas voluptatem molestiae aliquid fuga. </p>
        </div>
        <div class="col-6">
          <p>Obcaecati totam aspernatur assumenda tempore? Magni cumque eligendi, debitis odio vitae assumenda. Maxime neque, perferendis quod quaerat qui minus reiciendis culpa fuga doloremque adipisci. Totam in nihil labore, laborum saepe cupiditate, esse ullam rem omnis facilis quasi aliquid suscipit. Voluptatum voluptatibus quibusdam rerum ducimus explicabo consectetur repudiandae ut quia ab illum quod maxime iure provident illo, quis, animi aut vel repellendus dolorem assumenda soluta sequi? Hic ipsum ex earum, minus officiis nam illum accusantium expedita animi fuga maiores, omnis id consequatur deleniti autem. Officiis molestias quam odio, aliquam consectetur dolorum illo sit. Rem quaerat veritatis veniam ipsa, quasi tempore perspiciatis, incidunt quis nam a nostrum ullam, deleniti expedita culpa beatae alias possimus quisquam? Corrupti suscipit nostrum necessitatibus eligendi? Dolorem, voluptatibus architecto cumque reiciendis laudantium veniam, soluta, perferendis possimus.</p>
        </div>
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