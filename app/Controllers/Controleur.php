<?php
namespace App\Controllers;
defined('base_url('public/')') OR exit('No direct script access allowed');

/**
 * Class Controleur
 *
 * Controleur provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends Controleur
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class Controleur extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend Controleur.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}

	/* ----------------------- Redirige vers l'accueil de site ----------------------- */

	public function index(){
		session_start();
		$Modele = new \App\Models\Modele();

		try {
			if(isset($_GET['action'])) {
				if($_GET['action'] == 'accueil') {
					$this->accueil();
				}
				elseif($_GET['action'] == 'consultation') {
					$this->consultation();
				}
				elseif($_GET['action'] == 'redaction') {
					$this->redaction();
				}
				elseif($_GET['action'] == 'connexion') {
					$this->connexion();
				}
				elseif($_GET['action'] == 'deconnexion') {
					$this->deconnexion();
				}
				elseif($_GET['action'] == 'login') {
					$this->connect($_POST['uname'],$_POST['psw']);
				}
				elseif($_GET['action'] == 'ff'){
					$Modele->insertff($Modele->trouveID($_SESSION['login']),$_POST['uneetape'],$_POST['unkm'],$_POST['unenuit'],$_POST['unrepas']);
				}
				elseif($_GET['action'] == 'hf') {
					$Modele->inserthf($Modele->trouveID($_SESSION['login']),$_POST['unedate'],$_POST['untype'],$_POST['uncouts']);
				}
				elseif ($_GET['action'] == 'modification') {
					$this->modifRecup($Modele->trouveID($_SESSION['login']));
				}
				elseif ($_GET['action']=='modifValidate') {
					$Modele->modifValidate2($Modele->trouveID($_SESSION['login']),$_POST['uneetape'],$_POST['unkm'],$_POST['unenuit'],$_POST['unrepas']);
				}
				else {
					$this->accueil();
				}
			}
			else {
				$this->accueil();
			}
		}
		catch (Exception $e) {

			erreur($e->getMessage());

		}
	}

	public function accueil() {
		echo view('vueAccueil');
	}

	/* ----------------------- Redirige vers la page de consultation des frais du Visiteur ----------------------- */

	public function consultation() {
		echo view('vueConsultation');
	}

	/* ----------------------- Redirige vers la page de rédaction des frais du Visiteur ----------------------- */

	public function redaction() {
		echo view('vueRedaction');
	}

	/* ----------------------- Redirige vers la page de connexion ----------------------- */

	public function connexion() {
		echo view('vueConnexion');
	}

	/* ----------------------- Permet au Visiteur de se déconnecter ----------------------- */

	public function deconnexion() {
		$_SESSION = array();
		session_destroy();
		$this->accueil();
	}

	/* ----------------------- Redirige vers la page d'erreur ----------------------- */

	public function erreur($msgErreur) {
		$_SESSION['msg'] = $msgErreur;
		echo view('vueErreur');
	}

	/* ----------------------- Redirige vers la page de modification des frais forfait ----------------------- */

	public function modifRecup($id) {
		$Modele = new \App\Models\Modele();

		$date = date('d/m/y');

	    $InfoFraisForfait=$Modele->modifffReturn($id,$this->returnMois($date));

		$_SESSION['quantiteEtp']=$InfoFraisForfait[1];
		$_SESSION['quantiteKm']=$InfoFraisForfait[2];
		$_SESSION['quantiteNui']=$InfoFraisForfait[3];
		$_SESSION['quantiteRep']=$InfoFraisForfait[4];

		$_SESSION['mois'] = $this->returnMois($date);

		echo view('vueModification');


	}

	public function modifValidate1($id,$uneetape,$unkm,$unenuit,$unrepas){
		$Modele = new \App\Models\Modele();
		$Modele->modifValidate2($id,$uneetape,$unkm,$unenuit,$unrepas);
		$this->accueil();

	}

	/* ----------------------- Verifie que les entrées sont remplis ou non et les transmet au modele ----------------------- */

	public function connect($log,$mdp) {
		$unamet = htmlspecialchars($log);
		$unamef = trim($unamet);

		$_SESSION['login'] = $unamef;

		$pswt = htmlspecialchars($mdp);
		$pswf = trim($pswt);

		$_SESSION['mdp'] = $pswf;

		$Modele = new \App\Models\Modele();

		if((!empty($_SESSION['login'])) AND (!empty($_SESSION['mdp']))) {

			$valide = $Modele->verifLogin($_SESSION['login'],$_SESSION['mdp']);

			if($valide == "true") {
				$this->accueil();
			}
			elseif ($valide == "false"){
				session_destroy();
				$this->connexion();
			}
		}
	}

	/* ----------------------- Renvoie le mois (en lettre) en fonction de la date données ----------------------- */

	public function returnMois($date) {

		list($j,$m,$a)=explode("/",$date);

		$mois=$m;

		switch($mois) {
			case(1) :
			$mois = "janvier";
			break;
			case(2) :
			$mois = "fevrier";
			break;
			case(3) :
			$mois = "mars";
			break;
			case(4) :
			$mois = "avril";
			break;
			case(5) :
			$mois = "mai";
			break;
			case(6) :
			$mois = "juin";
			break;
			case(7) :
			$mois = "juillet";
			break;
			case(8) :
			$mois = "aout";
			break;
			case(9) :
			$mois = "septembre";
			break;
			case(10) :
			$mois = "octobre";
			break;
			case(11) :
			$mois = "novembre";
			break;
			case(12) :
			$mois = "decembre";
			break;
		}

		return $mois;
	}

	/* -----------------------  ----------------------- */

	public function returnMoisWNum($num) {
		switch($num) {
			case(1) :
			$mois = "janvier";
			break;
			case(2) :
			$mois = "fevrier";
			break;
			case(3) :
			$mois = "mars";
			break;
			case(4) :
			$mois = "avril";
			break;
			case(5) :
			$mois = "mai";
			break;
			case(6) :
			$mois = "juin";
			break;
			case(7) :
			$mois = "juillet";
			break;
			case(8) :
			$mois = "aout";
			break;
			case(9) :
			$mois = "septembre";
			break;
			case(10) :
			$mois = "octobre";
			break;
			case(11) :
			$mois = "novembre";
			break;
			case(12) :
			$mois = "decembre";
			break;
		}

		return $mois;
	}
	public function returnNumMois($mois) {
		switch ($mois) {
			case('janvier'):
			$numM = "One";
			break;
			case('fevrier'):
			$numM = "Two";
			break;
			case('mars'):
			$numM = 'Three';
			break;
			case('avril'):
			$numM = 'Four';
			break;
			case('mai'):
			$numM = 'Five';
			break;
			case('juin'):
			$numM = 'Six';
			break;
			case('juillet'):
			$numM = 'Seven';
			break;
			case('aout'):
			$numM = 'Eight';
			break;
			case('septembre'):
			$numM = 'Nine';
			break;
			case('octobre'):
			$numM = 'Ten';
			break;
			case('novembre'):
			$numM = 'Eleven';
			break;
			case('decembre'):
			$numM = 'Twelve';
			break;
		}

		return $numM;
	}
	public function testID($id){
		if($id == null){
			$this->connexion();
		}
	}
	public function tabAnnee($id) {
		for($i = 1;$i <= 12;$i++){
			$this->tabMois($i,$id);
		}
	}
	public function tabMois($mois,$id) {
		$Modele = new \App\Models\Modele();

		$mois = $this->returnMoisWNum($mois);
		$numM = $this->returnNumMois($mois);
		$identite = $Modele->returnNomPre($id);
		$dateM = $Modele->returnDateMMois($id,$mois);

		if(!($dateM == null)){
			$montant = $Modele->returnMontant($id,$mois);
			$nbKm = $Modele->returnFrais($id,$mois,"KM");
			$nbNui = $Modele->returnFrais($id,$mois,"NUI");
			$nbRep = $Modele->returnFrais($id,$mois,"REP");
			echo '<article>
			<div id="accordion">
			<div class="card">
			<div class="card-header" id="heading'; echo $numM; echo'">
			<h3 class="mb-0">
			<button class="btn btn-light collapsed" data-toggle="collapse" data-target="#collapse';echo $numM; echo'" aria-expanded="false" aria-controls="collapse';echo $numM; echo'">
			'; echo ucwords($mois); echo '</button>
			</h3>
			</div>
			<div id="collapse';echo $numM; echo'" class="collapse collapsed" aria-labelledby=" heading';echo $numM; echo'" data-parent="#accordion">
			<div class="card-body">
			<div class="row">
			<figure class="col-lg-4 offset-lg-2 col-md-6 col-sm-6">
			<p>Nom : '; echo $identite; echo '<br>Date : '; echo $dateM; echo  '<br>Frais Total : '; echo $montant; echo  ' €</p>
			</figure>
			<figure class="col-lg-4 offset-lg-2 col-md-6 col-sm-6">
			<p>Frais Kilométriques : '; echo $nbKm; echo ' km <br>Frais Hotel : '; echo $nbNui; echo ' nuit(s) <br>Frais Repas : '; echo $nbRep; echo ' repas</p>
			</figure>
			<figure class="col-lg-10 offset-lg-1 card-div">

			<p>Autre(s) frais : </p>';
			$this->tabHfMois($id,$mois);
			echo '</figure>
			</div>';
			$this->boutonModif($mois);
			echo '</div>
			</div>
			</div>
			</div>
			</article>';
		}
		else{
			echo '<article>
			<div id="accordion">
			<div class="card">
			<div class="card-header" id="heading';echo $numM; echo'">
			<h3 class="mb-0">
			<button class="btn btn-light collapsed" data-toggle="collapse" data-target="#collapse';echo $numM; echo'" aria-expanded="false" aria-controls="collapse';echo $numM; echo'">
			'; echo ucwords($mois); echo '</button>
			</h3>
			</div>
			<div id="collapse';echo $numM; echo'" class="collapse collapsed" aria-labelledby=" heading';echo $numM; echo'" data-parent="#accordion">
			<div class="card-body">
			<div class="row">
			<h1 class="offset-lg-2" style="text-align:center"> La fiche n\'a pas été rempli !</h1>
			</div>

			</div>
			</div>
			</div>
			</div>
			</article>';
		}
	}
	public function tabHfMois($id,$mois) {
		$Modele = new \App\Models\Modele();
		$cpt = $Modele->returnTabHf($id,$mois);
		if(!($cpt == 0)) {
			for($i = 0;$i < $cpt;$i++) {
				echo '<div class="row info">
				<p>Date : '; echo $_SESSION['HorsForfait'][$i]->date; echo '</p>
				<p>Nom : '; echo $_SESSION['HorsForfait'][$i]->libelle; echo '</p>
				<p>Coûts : '; echo $_SESSION['HorsForfait'][$i]->montant; echo '€</p>
				</div>';
			}
		}
		else{
			echo '<div class="row info">
			<p>Aucun frais hors forfait enregistré !</p>
			</div>';
		}
	}
	public function boutonModif($mois) {
		$date = date('d/m/y');

		list($j,$m,$a)=explode("/",$date);

		$moisA = $this->returnMoisWNum($m);

		if($mois == $moisA) {
			echo '<div class="row">
			<a href="index.php?action=modification"><button class="btn btn-light collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">Modifier</button>;
	</a>
			</div>';
		}

	}
}
?>
