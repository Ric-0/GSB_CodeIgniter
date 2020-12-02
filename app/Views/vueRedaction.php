<?php
$Modele = new \App\Models\Modele();

$Controllers = new \App\Controllers\Controleur();

$id = $Modele->trouveID($_SESSION['login']);

$Controllers->testID($id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Rédaction des fiches</title>


    <!-- links stylesheets -->

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="public/css/redaction.css" />

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
            <h1>Rédaction de fiche de frais</h1>
            <form action="index.php?action=ff" method="post">
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
                                            <label for="uneetape"><b>Forfait étape :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="Forfait étape" name="uneetape" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unkm"><b>Frais kilométriques (km):</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="Kilomètres effectué" name="unkm" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unenuit"><b>Frais d'hotel :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="Nombre de nuit" name="unenuit" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unrepas"><b>Frais de repas :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="Nombre de repas" name="unrepas" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="container">
                    <div class="row zonebtn">
                        <button class="btn-test" type="submit" name="validate">Valider votre Frais Forfait</button>
                        <a href="index.php"><button type="button" class="cancelbtn btn-test">Annuler</button></a>
                    </div>
                </div>
            </form>
            <form action="index.php?action=hf" method="post">
                <article>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h3 class="mb-0">
                                    <p class="btn btn-light">
                                    Frais Hors Forfait : </p>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="unedate"><b>Date (jj/mm/aaaa) :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="date" placeholder="Entrez la date de la préstation" name="unedate" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="untype"><b>Type :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" placeholder="Entrez le type de la préstation" name="untype" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="uncouts"><b>Coûts (€) :</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="number" placeholder="Entrez le coûts" name="uncouts" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="container">
                    <div class="row zonebtn">
                        <button class="btn-test" type="submit" name="validate">Valider votre Frais Hors Forfait</button>
                        <a href="index.php"><button type="button" class="cancelbtn btn-test">Annuler</button></a>
                    </div>
                </div>
            </form>
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
