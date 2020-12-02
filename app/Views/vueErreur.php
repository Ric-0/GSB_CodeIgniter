<?php
$Modele = new \App\Models\Modele();

$id = $Modele->trouveID($_SESSION['login']);

$Controllers = new \App\Controllers\Controleur();

$Controllers->testID($id);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>GSB - Consultation</title>

    <!--Meta data -->

    <meta name="Description" content="GSB (Galaxy Swiss Bourdin)" >
    <meta name="keywords" content="GSB, gsb, Galaxy Swiss Bourdin, galaxy swiss bourdin" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- links stylesheets -->

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="public/css/consultation.css" />

    <!-- icon -->

    <link rel="icon" href="assets/images/picture_02.png" />

    <!-- link aos -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- link google fonts -->

    <link href="https://fonts.googleapis.com/css?family=Sanchez&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gupter&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <a class="anchor" id="top"></a>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg fixed-top">
                <a class="navbar-brand js-scrollTo" href="#top"><img src="assets/images/picture_02.png" alt="Logo Top" title="Logo de Solar Aurelion" height="60px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Start /.navbar-nav -->
                    <ul class="navbar-nav mr-auto w-100 d-flex justify-content-end">
                        <!-- Start ./navbar-item -->
                        <li class="nav-item active-li">
                            <a class="nav-link" href="index.php?action=accueil">Accueil</a>
                        </li>
                        <!-- End /.navbar-iten -->
                        <!-- Start ./navbar-item -->
                        <li class="nav-item active-li">
                            <?php
                                if($id == null){
                            ?>
                            <a class="nav-link" href="index.php?action=connexion">Consultation</a>
                            <?php
                                }
                                else{
                            ?>
                            <a class="nav-link" href="index.php?action=consultation">Consultation</a>
                            <?php
                                }
                            ?>
                        </li>
                        <!-- End /.navbar-iten -->
                        <!-- Start ./navbar-item -->
                        <li class="nav-item active-li">
                            <?php
                                if($id == null){
                            ?>
                            <a class="nav-link" href="index.php?action=connexion">Rédaction</a>
                            <?php
                                }
                                else{
                            ?>
                            <a class="nav-link" href="index.php?action=redaction">Rédaction</a>
                            <?php
                                }
                            ?>
                        </li>
                        <li class="nav-item active-li">
                            <?php
                                if($id == null){
                            ?>
                            <a class="nav-link" href="index.php?action=connexion">Connexion</a>
                            <?php
                                }
                                else{
                            ?>
                            <a class="nav-link" href="index.php?action=deconnexion">Deconnexion</a>
                            <?php
                                }
                            ?>
                        </li>
                    </ul>
                    <!-- End /.navbar-nav -->
                </div>
            </nav>
        </div>
    </header>
        <main>
            <div class=" big_div offset-lg-1 col-lg-10">
              <p>Une erreur est survenue : <?= $_SESSION['msg'] ?></p><br><br>

            </div>
        </main>
        <footer>
            <div>
                <p> Copyright © 2020 <br> Tous droits réservés GSB <br> Réalisé par Mateo Melo / David Jego / Nicolas Prevost</p>
            </div>
        </footer>

    <script src="public/js/test.js"></script>

    <script src="public/bootstrap/js/bootstrap.min.js"></script>

    <script src="public/js/scroll.js"></script>

</body>

</html>
