<?php
/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe

 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsb_frais';
      	private static $user='Root' ;
      	private static $mdp='' ;
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
        PdoGsb::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe

 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();

 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;
	}
/**
 * Retourne les informations d'un Visiteur

 * @param $login
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select Visiteur.id as id, Visiteur.nom as nom, Visiteur.prenom as prenom, Visiteur.mdp as mdp from Visiteur
		where Visiteur.login='$login'";
		$rs = PdoGsb::$monPdo->query($req);
        
		$ligne = $rs->fetch(pdo::FETCH_ASSOC);
		return $ligne;
	}
	public function getInfosComptable($login, $mdp){
		$req = "select comptable.id as id, comptable.nom as nom, comptable.prenom as prenom, comptable.mdp as mdp from comptable
		where comptable.login='$login'";
		$rs = PdoGsb::$monPdo->query($req);
      
		$ligne = $rs->fetch(pdo::FETCH_ASSOC);
            
                
		return $ligne;
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments

 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from LigneFraisHorsForfait where LigneFraisHorsForfait.idVisiteur ='$idVisiteur'
		and LigneFraisHorsForfait.mois = '$mois' ";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes;
	}
       
/**
 * Retourne le nombre de justificatif d'un Visiteur pour un mois donné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs
*/
	public function getnbJustificatifs($idVisiteur, $mois){
		$req = "select FicheFrais.nbJustificatifs as nb from  FicheFrais where FicheFrais.idVisiteur ='$idVisiteur' and FicheFrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select FraisForfait.id as idfrais, FraisForfait.libelle as libelle, FraisForfait.montant as montant,
		LigneFraisForfait.quantite as quantite from LigneFraisForfait inner join FraisForfait
		on FraisForfait.id = LigneFraisForfait.idFraisForfait
		where LigneFraisForfait.idVisiteur ='$idVisiteur' and LigneFraisForfait.mois='$mois'
		order by LigneFraisForfait.idFraisForfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
       
/**
 * Retourne tous les id de la table FraisForfait

 * @return un tableau associatif
*/
	public function getLesIdFrais(){
		$req = "select FraisForfait.id as idfrais from FraisForfait order by FraisForfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table LigneFraisForfait

 * Met à jour la table LigneFraisForfait pour un Visiteur et
 * un mois donné en enregistrant les nouveaux montants

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update LigneFraisForfait set LigneFraisForfait.quantite = $qte
			where LigneFraisForfait.idVisiteur = '$idVisiteur' and LigneFraisForfait.mois = '$mois'
			and LigneFraisForfait.idFraisForfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}

	}
/**
 * met à jour le nombre de justificatifs de la table FicheFrais
 * pour le mois et le Visiteur concerné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
*/
	public function majnbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update FicheFrais set nbJustificatifs = $nbJustificatifs
		where FicheFrais.idVisiteur = '$idVisiteur' and FicheFrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Teste si un Visiteur possède une fiche de frais pour le mois passé en argument

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux
*/
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from FicheFrais
		where FicheFrais.mois = '$mois' and FicheFrais.idVisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un Visiteur

 * @param $idVisiteur
 * @return le mois sous la forme aaaamm
*/
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from FicheFrais where FicheFrais.idVisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}

/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un Visiteur et un mois donnés

 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL', 1);

		}
		$req = "insert into FicheFrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat)
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into LigneFraisForfait(idVisiteur,mois,idFraisForfait,quantite)
			values('$idVisiteur','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		 }
	}
/**
 * Crée un nouveau frais hors forfait pour un Visiteur un mois donné
 * à partir des informations fournies en paramètre

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
        var_dump($date);
        $dateFr = dateFrancaisVersAnglais($date);
        var_dump($dateFr);
		$req = "insert into LigneFraisHorsForfait (idVisiteur, mois, libelle, date, montant)
		values('$idVisiteur','$mois','$libelle','$dateFr','$montant')";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument

 * @param $idFrais
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from LigneFraisHorsForfait where LigneFraisHorsForfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument

 * @param $idFrais
*/
	public function deplacerFraisHorsForfait($idFrais, $moissuivant){
		$req = "UPDATE LigneFraisHorsForfait SET mois = '$moissuivant' where LigneFraisHorsForfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}  

/**
 * Retourne les mois pour lesquel un Visiteur a une fiche de frais

 * @param $idVisiteur
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select FicheFrais.mois as mois from  FicheFrais where FicheFrais.idVisiteur ='$idVisiteur'
		order by FicheFrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}
/**
 * Retourne les informations d'une fiche de frais d'un Visiteur pour un mois donné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
*/
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select FicheFrais.idEtat as idEtat, FicheFrais.dateModif as dateModif, FicheFrais.nbJustificatifs as nbJustificatifs,
			FicheFrais.montantValide as montantValide, Etat.libelle as libEtat from  FicheFrais inner join Etat on FicheFrais.idEtat = Etat.id
			where FicheFrais.idVisiteur ='$idVisiteur' and FicheFrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état et la date de modification d'une fiche de frais

 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 */

	public function majEtatFicheFrais($idVisiteur,$mois,$Etat, $Comptable){
		$req = "update FicheFrais set idEtat = '$Etat', dateModif = now(), idComptable = '$Comptable'
		where FicheFrais.idVisiteur ='$idVisiteur' and FicheFrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
        

/**
 * 
 * 
 * 
 * 
 *
*/
        public function getVisiteur(){
            $req = "select Visiteur.id as id,concat(Visiteur.nom,' ',Visiteur.prenom) as nomcomplet from Visiteur";
            $res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
		return $lesLignes;
        }
        
        public function getVisiteurCL(){
            $req = "select DISTINCT Visiteur.id as id,concat(Visiteur.nom,' ',Visiteur.prenom) as nomcomplet, FicheFrais.idEtat from Visiteur INNER JOIN FicheFrais ON idVisiteur = Visiteur.id where FicheFrais.idEtat='CL'";
            $res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
		return $lesLignes;
        }
        
        public function getVisiteurRB(){
            $req = "select DISTINCT Visiteur.id as id,concat(Visiteur.nom,' ',Visiteur.prenom) as nomcomplet, FicheFrais.idEtat from Visiteur INNER JOIN FicheFrais ON idVisiteur = Visiteur.id where FicheFrais.idEtat='RB'";
            $res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
		return $lesLignes;
        }
        
        public function getVisiteurVA(){
            $req = "select DISTINCT Visiteur.id as id,concat(Visiteur.nom,' ',Visiteur.prenom) as nomcomplet, FicheFrais.idEtat from Visiteur INNER JOIN FicheFrais ON idVisiteur = Visiteur.id where FicheFrais.idEtat='VA'";
            $res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
		return $lesLignes;
        }
        
        public function getFiche($idVisiteur, $mois){
            $req = "select idEtat from FicheFrais where idVisiteur = '$idVisiteur' and mois = '$mois'";
            $res = PdoGsb::$monPdo->query($req);
            $ligne = $res->fetch();
            return $ligne;
        }
        public function majMontant($somme, $idVisiteur, $mois){
            $req= "UPDATE FicheFrais set montantValide = '$somme' where idVisiteur = '$idVisiteur' and mois = '$mois'";
            $res = PdoGsb::$monPdo->query($req);
        }
        
        public function getInfoPaiement($idvisiteur){
            $req = "SELECT * from FicheFrais INNER JOIN Visiteur on FicheFrais.idVisiteur = Visiteur.id where FicheFrais.idEtat = 'VA' and FicheFrais.idVisiteur = '$idvisiteur'";
            $res = PdoGsb::$monPdo->query($req);
            $lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
            return $lesLignes;
           
        }
        public function getfichesremboursees($idvisiteur){
            $req = "SELECT * from FicheFrais INNER JOIN Visiteur on FicheFrais.idVisiteur = Visiteur.id where FicheFrais.idEtat = 'RB' and FicheFrais.idVisiteur = '$idvisiteur'";
            $res = PdoGsb::$monPdo->query($req);
            $lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
            return $lesLignes;
           
        }
        public function setCloture(){
            $dateday = new DateTime();
           
            $dateday->modify('- 1 month');
            $date = $dateday->format('Y-m');
            $numAnnee =substr( $date,0,4);
            $numMois =substr( $date,5,2);
            $mois = $numAnnee.$numMois;
            $mois = strval($mois);
            
           
            $req = "UPDATE FicheFrais set idEtat = 'CL' where mois = '$mois' and idEtat = 'CR'";
            $res = PdoGsb::$monPdo->query($req);
        }
        // chiffrage des mots de passe Visiteur
        public function setCrypt(){
            $req = "SELECT login, mdp FROM Visiteur";
            $res = PdoGsb::$monPdo->query($req);
            $lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
            foreach ($lesLignes as $ligne){
                $password_hash = password_hash($ligne['mdp'], PASSWORD_BCRYPT);
                $req2 = 'UPDATE Visiteur set mdp = "'.$password_hash.'" where login = "'.$ligne['login'].'"';
                $res2 = PdoGsb::$monPdo->query($req2);
            }
          
        }
        // chiffrage des mots de passe Comptable
        public function setCrypt2(){
            $req = "SELECT login, mdp FROM comptable";
            $res = PdoGsb::$monPdo->query($req);
            $lesLignes = $res->fetchAll(pdo::FETCH_ASSOC);
            foreach ($lesLignes as $ligne){
                $password_hash = password_hash($ligne['mdp'], PASSWORD_BCRYPT);
                $req2 = 'UPDATE comptable set mdp = "'.$password_hash.'" where login = "'.$ligne['login'].'"';
                $res2 = PdoGsb::$monPdo->query($req2);
            }
          
        }
}

