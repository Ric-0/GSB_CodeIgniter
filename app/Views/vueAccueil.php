<?php

$Modele = new \App\Models\Modele();

if(isset($_SESSION['login'])){
    $id = $Modele->trouveID($_SESSION['login']);
}
else{
    $id = null;
}
echo base_url('/public/css/global.css');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>GSB</title>

    <!--Meta data -->

    <meta name="Description" content="GSB (Galaxy Swiss Bourdin)" >
    <meta name="keywords" content="GSB, gsb, Galaxy Swiss Bourdin, galaxy swiss bourdin" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- links stylesheets -->

    <link rel="stylesheet" href="<?php echo base_url("/public/bootstrap/css/bootstrap.css"); ?>" />
    <link rel="stylesheet"href="<?php echo base_url('/public/css/global.css'); ?>" />

    <!-- icon -->

    <link rel="icon" href="<?php echo base_url('/public/images/picture_02.png'); ?>" />

    <!-- link google fonts -->

    <link href="<?php echo base_url('/public/fonts/Sanchez/Sanchez-Regular.ttf'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('/public/fonts/Gupter/Gupter-Regular.ttf'); ?>" rel="stylesheet" type="text/css">

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
                            <a class="nav-link" href="#">Accueil</a>
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

        <div>
        <h1 data-aos="fade-down">Galaxy Swiss Bourdin</h1>
        <h4 data-aos="fade-up" data-aos-delay="200">La santé avant toutes autres choses</h4>
        </div>
        <div class="col-lg-6 offset-lg-1">
            <p class="headingTxt" data-aos="fade-right" data-aos-delay="400">Depuis plus d’un siècle, GSB a fait de nombreuses découvertes et mis au point des médicaments innovants qui ont marqué l’histoire de la médecine et contribué à prévenir et traiter des maladies graves et fréquentes. <br>GSB a acquis une position de pionnier reconnue à travers le monde, en se mobilisant pour développer des médicaments à haute valeur thérapeutiques dans ses domaines d’expertise : les neurosciences, l’oncologie, l’endocrinologie, la santé de la femme, les soins intensifs et les maladies infectieuses. <br>GSB a mobilisé tous ses efforts pour relever le fabuleux défi de faire progresser la science et la santé. <br>En tant qu’entreprise leader dans l’innovation, GSB développe un portefeuille croissant de molécules de première classe, afin de répondre aux besoins médicaux majeurs à travers le monde.</p>
            <button class="button headerButton" data-aos="fade-right" data-aos-delay="100" style="vertical-align:middle"><span><a class="js-scrollTo" href="#trip">Rédaction</a></span></button>
        </div>
    </header>

    <main>
        <div class="row primary_div right_div">
            <div data-aos="fade-right" class="col-lg-6">
                <h2>Consultation de fiches de frais</h2>
                <p>Afin de consulter vos fiches, veuillez cliquer sur l'image située à droite de ce texte.</p>
            </div>
            <div class=" col-lg-3" data-aos="fade-left">
                <?php
                    if($id == null){
                ?>
                    <figure><a href="index.php?action=connexion"><img src="<?php echo base_url('/public/images/consultation_des_frais.png'); ?>" alt="solar aurelion logo" height="400px"></a></figure>
                <?php
                    }
                    else{
                ?>
                    <figure><a href="index.php?action=consultation"><img src="<?php echo base_url('/public/images/consultation_des_frais.png'); ?>" alt="solar aurelion logo" height="400px"></a></figure>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="row primary_div left_div">
            <a class="anchor" id="trip"></a>
            <div class="col-lg-3"  data-aos="fade-right">
                <?php
                    if($id == null){
                ?>
                    <figure><a href="index.php?action=connexion"><img src="assets/images/redaction.png" alt="space hotel" height="400px"></a></figure>
                <?php
                    }
                    else{
                ?>
                    <figure><a href="index.php?action=redaction"><img src="assets/images/redaction.png" alt="space hotel" height="400px"></a></figure>
                <?php
                    }
                ?>
            </div>
            <div class="offset-lg-2 col-lg-6" data-aos="fade-left">
                <h2>Redaction de fiches de frais</h2>
                <p>Dans le but de remplir une fiche de frais, veuillez cliquer sur l'image située à gauche de ce texte.</p>
            </div>
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
