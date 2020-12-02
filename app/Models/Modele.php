<?php
namespace App\Models;
use CodeIgniter\Model;


class Modele extends Model{
	// verifie que l'ID de l'utilisateur existe
	// renvoie null si l'utilisateur ne s'est pas identifié
	public function trouveID($idv) {
		$bdd = db_connect();

		if(!($idv == null)) {
			$requser = "select id from visiteur where login = \"".$idv."\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			$id = $donnees[0]->id;
		}
		else{
			$id = null;
		}
		return $id;
	}
	// verifie les identifiants entrer
	// renvoie si les identifiants sont valides
	public function verifLogin($login,$mdp) {
		$bdd = db_connect();

		$requser1 = "select login from visiteur";
		$requser2 = "select mdp from visiteur";

		$reponse1 = $bdd->query($requser1);
		$reponse2 = $bdd->query($requser2);

		$trouver = "false";

		$donnees1 = $reponse1->getResult();

		$donnees2 = $reponse2->getResult();

		for($i = 0; $i < count($donnees1);$i++){
			if($donnees1[$i]->login == $login){
				for($j = 0; $j < count($donnees2);$j++){
					if($donnees2[$j]->mdp == $mdp){
						$trouver = "true";
					}
				}
			}
		}
		return $trouver;

	}
	public function insertff($id,$etape,$km,$nuit,$repas) {
		$bdd = db_connect();
		$Controllers = new \App\Controllers\Controleur();

		$date = date('d/m/y');

		$mois = $Controllers->returnMois($date);

		$requser = "select * from fichefrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

		$reponse = $bdd->query($requser);
		

			

		if(!($reponse->getResult() == null)){
			$message = "Fiche déjà faite !";
			$Controllers->erreur($message);
		}
		else{
			// --------------------- Fiche frais --------------------- //

			$idE = "CR";

			$nbJ = 4;

			// --------------------- Recherche des montants --------------------- //

			$requser = "select montant from fraisforfait where id = \"ETP\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$mE = $donnees[$i]->montant;
			}

			$requser = "select montant from fraisforfait where id = \"KM\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++) {
				$mK = $donnees[$i]->montant;
			}

			$requser = "select montant from fraisforfait where id = \"NUI\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$mN = $donnees[$i]->montant;
			}

			$requser = "select montant from fraisforfait where id = \"REP\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$mR = $donnees[$i]->montant;
			}

			$m = $etape * $mE + $km * $mK + $nuit * $mN + $repas * $mR;

			$requser = "insert into fichefrais (idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) values (\"".$id."\",\"".$mois."\",".$nbJ.",".$m.",\"".$date."\",\"".$idE."\")";

			$bdd->simpleQuery($requser);

			// --------------------- Forfait Etape --------------------- //

			$requser = "select id from fraisforfait where id = \"ETP\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$ide = $donnees[$i]->id;
			}

			$requser = "insert into lignefraisforfait (idVisiteur,mois,idFraisForfait,quantite) values (\"".$id."\",\"".$mois."\",\"".$ide."\",".$etape.")";

			$bdd->simpleQuery($requser);

			// --------------------- Frais kilométrique --------------------- //

			$requser = "select id from fraisforfait where id = \"KM\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$idk = $donnees[$i]->id;
			}

			$requser = "insert into lignefraisforfait (idVisiteur,mois,idFraisForfait,quantite) values (\"".$id."\",\"".$mois."\",\"".$idk."\",".$km.")";

			$bdd->simpleQuery($requser);

			// --------------------- Nuitée Hôtel --------------------- //

			$requser = "select id from fraisforfait where id = \"NUI\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$idn = $donnees[$i]->id;
			}

			$requser = "insert into lignefraisforfait (idVisiteur,mois,idFraisForfait,quantite) values (\"".$id."\",\"".$mois."\",\"".$idn."\",".$nuit.")";

			$bdd->simpleQuery($requser);

			// --------------------- Repas Restaurant --------------------- //

			$requser = "select id from fraisforfait where id = \"REP\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$idr = $donnees[$i]->id;
			}

			$requser = "insert into lignefraisforfait (idVisiteur,mois,idFraisForfait,quantite) values (\"".$id."\",\"".$mois."\",\"".$idr."\",".$repas.")";

			$bdd->simpleQuery($requser);

			// --------------------- Fin fiche frais --------------------- //

			$Controllers->accueil();
			}
		}
		public function inserthf($id,$date,$type,$couts) {
			$bdd = db_connect();

			$Controllers = new \App\Controllers\Controleur();

			$a = substr($date, 0,4);

			$m = substr($date,5,2);

			$j = substr($date,8,2);

			$date = $j."/".$m."/".$a;

			$moishf = $Controllers->returnMois($date);

			$dateA = date('d/m/Y');

			$moisA = $Controllers->returnMois($dateA);

			list($ja,$ma,$aa)=explode("/",$dateA);

			if(!($moishf == $moisA)){
				if(!($aa == $a)){
					$message = "Le mois et l'année ne correspondent pas !";
				} else {
					$message = "Le mois ne correspond pas !";
				}
				erreur($message);
			} elseif( !($aa == $a)){
				$message = "L'année ne correspond pas !";
				erreur($message);
			}
			else {
				$requser = "select nbJustificatifs from fichefrais where idVisiteur = \"".$id."\" and mois = \"".$moishf."\"";
				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				for($i = 0; $i < count($donnees); $i++){
					$nbJ = $donnees[$i]->nbJustificatifs;
				}

				$requser = "select montantValide from fichefrais where idVisiteur = \"".$id."\" and mois = \"".$moishf."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				for($i = 0; $i < count($donnees); $i++){
					$mV = $donnees[$i]->montantValide;
				}

				$requser = "select dateModif from fichefrais where idVisiteur = \"".$id."\" and mois = \"".$moishf."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				for($i = 0; $i < count($donnees); $i++){
					$dateT = $donnees[$i]->dateModif;
				}

				$nbJ = $nbJ + 1;

				$mV = $mV + $couts;

				$requser = "update fichefrais set montantValide = ".$mV." where idVisiteur = \"".$id."\" and mois = \"".$moishf."\"";

				$bdd->simpleQuery($requser);

				$requser = "update fichefrais set nbJustificatifs = ".$nbJ." where idVisiteur = \"".$id."\" and mois = \"".$moishf."\"";

				$bdd->simpleQuery($requser);

				if($dateA == $dateT){
					$requser = "insert into lignefraishorsforfait (idVisiteur,mois,libelle,date,montant) values (\"".$id."\",\"".$moishf."\",\"".$type."\",\"".$date."\",".$couts.")";

					$bdd->simpleQuery($requser);
				}
				else{
					$requser = "update fichefrais set dateModif = \"".$dateA."\" where idVisiteur = \"".$id."\" and mois = \"".$moishf."\"";

					$bdd->simpleQuery($requser);

						$requser = "insert into lignefraishorsforfait (idVisiteur,mois,libelle,date,montant) values (\"".$id."\",\"".$moishf."\",\"".$type."\",\"".$date."\",".$couts.")";
						$bdd->simpleQuery($requser);
				}

				$Controllers->accueil();
			}
		}
		public function returnNomPre($id) {
			$bdd = db_connect();

			$requser = "select nom from visiteur where id = \"".$id."\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$nom = $donnees[$i]->nom;
			}

			$requser = "select prenom from visiteur where id = \"".$id."\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$prenom = $donnees[$i]->prenom;
			}

			
			$nP = $nom." ".$prenom;
			return $nP;
		}
		public function returnDateMMois($id,$mois) {
			$bdd = db_connect();

			$requser = "select dateModif from fichefrais where idVisiteur = \"".$id."\" and mois = \"".$mois."\"";

			$reponse = $bdd->query($requser);

			$donnees =$reponse->getResult();

			$date = null;


			for($i = 0; $i < count($donnees); $i++){
				$date = $donnees[$i]->dateModif;
			}

			return $date;
		}
		public function returnMontant($id,$mois) {
			$bdd = db_connect();

			$requser = "select montantValide from fichefrais where idVisiteur = \"".$id."\" and mois = \"".$mois."\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			for($i = 0; $i < count($donnees); $i++){
				$mValide = $donnees[$i]->montantValide;
			}

			return $mValide;
		}
		public function returnFrais($id,$mois,$type) {
			$bdd = db_connect();

			$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" and mois = \"".$mois."\" and idFraisForfait = \"".$type."\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			$quantite = null;

			for($i = 0; $i < count($donnees); $i++){
				$quantite = $donnees[$i]->quantite;
			}

			return $quantite;
		}
		public function returnTabHf($id,$mois) {
			$bdd = db_connect();

			$requser = "select libelle,date,montant from lignefraishorsforfait where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

			$reponse = $bdd->query($requser);

			$donnees = $reponse->getResult();

			$cpt = 0;

			for($i = 0; $i < count($donnees); $i++){
				$_SESSION['HorsForfait'][$i] = $donnees[$i];

				$cpt = $i;
			}

			return $cpt;
		}

		public function modifffReturn($id,$mois){



		// --------------------- Création de variable pour les différents frais --------------------- //

		$etp = "ETP";

		$km = "KM";

		$nui = "NUI";

		$rep = "REP";
	//--------------------------------------------------------------------------------------------------//

		$bdd = db_connect();

		$requser = "select montantValide from ficheFrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";


		$reponse = $bdd->query($requser);

		$donnees = $reponse->getResult();

		for($i = 0; $i < count($donnees); $i++){
			$montant = $donnees[$i]->montantValide;
		}

		// --------------------- Recuperation du nombre d'étapes du mois de Janvier --------------------- //

		$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND idFraisForfait = \"".$etp."\" AND mois = \"".$mois."\"";


		$reponse = $bdd->query($requser);

		$donnees = $reponse->getResult();

		for($i = 0; $i < count($donnees); $i++){
			$quantiteEtp = $donnees[$i]->quantite;
		}

		// --------------------- Recuperation du nombre de kilometre du mois de Janvier --------------------- //

		$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND idFraisForfait = \"".$km."\" AND mois = \"".$mois."\"";

		$reponse = $bdd->query($requser);

		$donnees = $reponse->getResult();

		for($i = 0; $i < count($donnees); $i++){
			$quantiteKm = $donnees[$i]->quantite;
		}

		// --------------------- Recuperation du nombre de nuit d'hotel du mois de Janvier --------------------- //

		$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND idFraisForfait = \"".$nui."\" AND mois = \"".$mois."\"";

		$reponse = $bdd->query($requser);

		$donnees = $reponse->getResult();

		for($i = 0; $i < count($donnees); $i++){
			$quantiteNui = $donnees[$i]->quantite;
		}
		// --------------------- Recuperation du nombre de repas du mois de Janvier --------------------- //

		$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND idFraisForfait = \"".$rep."\" AND mois = \"".$mois."\"";

		$reponse = $bdd->query($requser);

		$donnees = $reponse->getResult();

		for($i = 0; $i < count($donnees); $i++){
			$quantiteRep = $donnees[$i]->quantite;
		}

		$InfoFraisForfait[0]=$montant;
		$InfoFraisForfait[1]=$quantiteEtp;
		$InfoFraisForfait[2]=$quantiteKm;
		$InfoFraisForfait[3]=$quantiteNui;
		$InfoFraisForfait[4]=$quantiteRep;

		return $InfoFraisForfait;

	}

	public function modifValidate2($id,$uneetape,$unkm,$unenuit,$unrepas){

		$bdd = db_connect();

		$Controllers = new \App\Controllers\Controleur();

		$date = date('d/m/Y');

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

		if(empty($uneetape) OR empty($unkm) OR empty($unenuit) OR empty($unrepas)) {
			$message = "une valeur est vide !";
			$Controllers->erreur($message);
		}
		else {

				$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"ETP\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$qteETP = 0;

				for($i = 0; $i < count($donnees); $i++){
					$qteETP = $donnees[$i]->quantite;
				}

				

				$requser = "select montant from fraisforfait where id = \"ETP\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montETP = 0;

				for($i = 0; $i < count($donnees); $i++){

					$montETP = $donnees[$i]->montant;
				}

				$totalAv = $qteETP * $montETP;

				$requser = "update lignefraisforfait set quantite = \"".$uneetape."\" where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"ETP\"";

				$bdd->simpleQuery($requser);

	//modif de la date

				$requser = "select dateModif from fichefrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$dateModif = 0;

				for($i = 0; $i < count($donnees); $i++){

					$dateModif = $donnees[$i]->dateModif;
				}

				if($dateModif != $date){

				$requser = "update fichefrais set dateModif = \"".$date."\" where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

					$bdd->simpleQuery($requser);
				}
	//fin modif date


				$totalAp = $uneetape * $montETP;

				$requser = "select montantValide from fichefrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montantT = 0;

				for($i = 0; $i < count($donnees); $i++){
                     
                      $montantT = $donnees[$i]->montantValide;

                    }

				$montantT = $montantT - $totalAv;

				$montantT = $montantT + $totalAp;

				$requser = "update fichefrais set montantValide = ".$montantT." where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$bdd->simpleQuery($requser);



				$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"KM\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$qteKM = 0;

				for($i = 0; $i < count($donnees); $i++){
					

                         $qteKM = $donnees[$i]->quantite;

					}

				$requser = "select montant from fraisforfait where id = \"KM\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montKM = 0;

				for($i = 0; $i < count($donnees); $i++){


					$montKM = $donnees[$i]->montant;

				}

				$totalAv = $qteKM * $montKM;

				$requser = "update lignefraisforfait set quantite = \"".$unkm."\" where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"KM\"";

				$bdd->simpleQuery($requser);


				$totalAp = $unkm * $montKM;

				$requser = "select montantValide from fichefrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montantT = 0;

				for($i = 0; $i < count($donnees); $i++){

					$montantT = $donnees[$i]->montantValide;
				}

				$montantT = $montantT - $totalAv;

				$montantT = $montantT + $totalAp;

				$requser = "update fichefrais set montantValide = ".$montantT." where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$bdd->simpleQuery($requser);


				$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"NUI\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$qteNUI = 0;

				for($i = 0; $i < count($donnees); $i++){


					$qteNUI = $donnees[$i]->quantite;
				}

				$requser = "select montant from fraisforfait where id = \"NUI\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montNUI = 0;

				for($i = 0; $i < count($donnees); $i++){


					$montNUI = $donnees[$i]->montant;
				}

				$totalAv = $qteNUI * $montNUI;

				$requser = "update lignefraisforfait set quantite = \"".$unenuit."\" where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"NUI\"";

				$bdd->simpleQuery($requser);


				$totalAp = $unenuit * $montNUI;

				$requser = "select montantValide from fichefrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montantT = 0;

				for($i = 0; $i < count($donnees); $i++){


					$montantT = $donnees[$i]->montantValide;
				}

				$montantT = $montantT - $totalAv;

				$montantT = $montantT + $totalAp;

				$requser = "update fichefrais set montantValide = ".$montantT." where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$bdd->simpleQuery($requser);



				$requser = "select quantite from lignefraisforfait where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"REP\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$qteREP = 0;

				for($i = 0; $i < count($donnees); $i++){

					$qteREP = $donnees[$i]->quantite;
				}

				$requser = "select montant from fraisforfait where id = \"NUI\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montREP = 0;

				for($i = 0; $i < count($donnees); $i++){

					$montREP = $donnees[$i]->montant;
				}

				

				$totalAv = $qteREP * $montREP;

				$requser = "update lignefraisforfait set quantite = \"".$unrepas."\" where idVisiteur = \"".$id."\" AND mois = \"".$mois."\" AND idFraisForfait = \"REP\"";

				$bdd->simpleQuery($requser);



				$totalAp = $unrepas * $montREP;

				$requser = "select montantValide from fichefrais where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$reponse = $bdd->query($requser);

				$donnees = $reponse->getResult();

				$montantT = 0;

				for($i = 0; $i < count($donnees); $i++){

					$montantT = $donnees[$i]->montantValide;
				}


				$montantT = $montantT - $totalAv;

				$montantT = $montantT + $totalAp;

				$requser = "update fichefrais set montantValide = ".$montantT." where idVisiteur = \"".$id."\" AND mois = \"".$mois."\"";

				$bdd->simpleQuery($requser);

				$Controllers->consultation();
	}
	}
}
