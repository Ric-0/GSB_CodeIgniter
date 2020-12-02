<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Rédaction des fiches</title>


    <!-- links stylesheets -->

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url('/public/css/redaction.css'); ?>" />

    <!-- icon -->

    <link rel="icon" href="assets/images/logo.png" />

    <!-- link aos -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- link google fonts -->

    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">

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
                            <a class="nav-link" href="index.php?action=consultation">Consultation</a>
                        </li>
                        <!-- End /.navbar-iten -->
                        <!-- Start ./navbar-item -->
                        <li class="nav-item active-li">
                            <a class="nav-link" href="index.php?action=redaction">Rédaction</a>
                        </li>
                        <li class="nav-item active-li">
                            <a class="nav-link" href="index.php?action=deconnexion">Deconnexion</a>
                        </li>
                    </ul>
                    <!-- End /.navbar-nav -->
                </div>
            </nav>
        </div>

    </header>
    <main>
        <div class=" big_div offset-lg-1 col-lg-10">
            <h1>Modification de votre fiche de frais (<?php echo $_SESSION['mois']; ?>)</h1>
            <form action="index.php?action=modifValidate" method="post">
                <article>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h3 class="mb-0">
                                    <p class="btn btn-light">
                                    Frais Forfait : </p>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="uneetape"><b>Nombre d'étape(s) :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="<?php echo $_SESSION['quantiteEtp'] ?>" name="uneetape" value="<?php echo $_SESSION['quantiteEtp'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unkm"><b>Nombre de kilométrique(s) (km):</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="<?php echo $_SESSION['quantiteKm'] ?>" name="unkm" value="<?php echo $_SESSION['quantiteKm'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unenuit"><b>Nombre de nuit d'hotel :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="<?php echo $_SESSION['quantiteNui'] ?>" name="unenuit" value="<?php echo  $_SESSION['quantiteNui'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unrepas"><b>Nombre de repas :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="<?php echo $_SESSION['quantiteRep'] ?>" name="unrepas" value="<?php echo $_SESSION['quantiteRep']  ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="container">
                    <div class="row zonebtn">
                        <button class="btn-test" type="submit" name="validate">Modifier votre Frais Forfait</button>
                        <a href="index.php?action=consultation"><button type="button" class="cancelbtn btn-test">Annuler</button></a>
                    </div>
                </div>
            </form>
