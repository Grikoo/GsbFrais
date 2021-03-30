<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];
$mois = filter_input(INPUT_POST,'dateValid',FILTER_SANITIZE_NUMBER_INT);
$Visiteur = filter_input(INPUT_POST,'lstVisiteur');
$lemois = "2020".$mois;

$lstVisiteur= explode('-',filter_input(INPUT_POST,'lstVisiteur'));


switch($action){
    case 'RechercheVisiteurCL':{
        $lesfichesfraispaiement =$pdo->getVisiteurCL();
       // $visiteur = array_key($tabvisiteur);
	//$visiteurSelectionne = $visiteur[0];  
        if($lesfichesfraispaiement){
            include("vues/v_rechercheVisiteurCL.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
        
        
        break;
        }
    case  'FicheCL':{
        //var_dump($lstVisiteur);

        $idvisiteur = $_REQUEST['lstVisiteur'];
        $mois = $_REQUEST['mois'];
        $annee = $_REQUEST['annee'];
        $date = $annee.$mois;
        $_SESSION['mois'] = $date;
        $_SESSION['nvisiteur'] = $idvisiteur;
        if($pdo->getFiche($idvisiteur,$date)['idEtat'] == "CL"){
            $lesfichesfraispaiement =$pdo->getVisiteurCL();
       // $visiteur = array_key($tabvisiteur);
	//$visiteurSelectionne = $visiteur[0];  
            if($lesfichesfraispaiement){
                include("vues/v_rechercheVisiteurCL.php");
            }else{
                include("vues/v_erreurFiche.php");
            }
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idvisiteur,$date);
            $lesFraisForfait= $pdo->getLesFraisForfait($idvisiteur,$date);
            $somme = 0;
            foreach ($lesFraisForfait as $lesfrais){
                $somme += $lesfrais['quantite'] * $lesfrais['montant'];
            }
            foreach ($lesFraisHorsForfait as $lesfraishors){
                $somme += $lesfraishors['montant'];
            }
            $pdo->majMontant($somme, $idVisiteur, $date);
            include("vues/v_FicheCL.php");
        }else{
            $lesfichesfraispaiement =$pdo->getVisiteurCL();
            include("vues/v_erreurmois.php");
            if($lesfichesfraispaiement){
            include("vues/v_rechercheVisiteurCL.php");
            }else{
                include("vues/v_erreurFiche.php");
            }
            
        }
        
        break;
    }
    case 'supprimerFrais':{
        $idFrais = $_REQUEST['idFrais'];
        $pdo->supprimerFraisHorsForfait($idFrais);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($_SESSION['nvisiteur'],$_SESSION['mois']);
        $lesFraisForfait= $pdo->getLesFraisForfait($_SESSION['nvisiteur'],$_SESSION['mois']);
        //var_dump($_SESSION);
        //var_dump($lesFraisHorsForfait);
        include("vues/v_FicheCL.php");
        break;
    }
    case 'deplacerFrais':{
                $idFrais = $_REQUEST['idFrais'];
                $ddate = $_REQUEST['iddate'];
                $numAnnee =substr( $ddate,0,4);
                $numMois =substr( $ddate,4,2);
                $numMois++;
                $numMois = strval($numMois);
                if($numMois > 12){
                    $numMois = 01;
                    $numAnnee ++;
                    $numAnnee = strval($numAnnee);
                }
                $ddate = strval($numAnnee).$numMois;
                $pdo->deplacerFraisHorsForfait($idFrais, $ddate);
		break;
        }
    case 'Validerfrais':{
        $etat = filter_input(INPUT_POST,'Etat');
        $lesfrais = $_REQUEST['lesFrais'];
        if(lesQteFraisValides($lesfrais)){
	  	 	$pdo->majFraisForfait($_SESSION['nvisiteur'],$_SESSION['mois'],$lesfrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
        //$idFrais= filter_input(INPUT_POST, );
        $pdo->majEtatFicheFrais($_SESSION['nvisiteur'],$_SESSION['mois'],$etat, $idVisiteur);
        $tabvisiteur =$pdo->getVisiteurVA();
        if($tabvisiteur){
            include("vues/v_rechercheVisiteurVA.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
        break;
    }
    case 'FicheVA':{
        $idvisiteur = $_REQUEST['lstVisiteur'];
        $lesfichesfraispaiement = $pdo->getInfoPaiement($idvisiteur);
        $tabvisiteur =$pdo->getVisiteurVA();
        if($tabvisiteur){
            include("vues/v_rechercheVisiteurVA.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
        include("vues/v_FicheVA.php");
        break;
    }
    case 'paiementfrais':{
        $etat = 'RB';
        $mois = $_REQUEST['mois'];
        $Visiteur = $_REQUEST['id'];
        $pdo->majEtatFicheFrais($Visiteur,$mois,$etat, $idVisiteur);
        $lesfraispayes = $pdo->getfichesremboursees($Visiteur);
        $tabvisiteur =$pdo->getVisiteurRB();
        if($tabvisiteur){
            include("vues/v_rechercheVisiteurRB.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
        break;
    }
    case 'FicheRB':{
        $idvisiteur = $_REQUEST['lstVisiteur'];
        $lesfraispayes = $pdo->getfichesremboursees($idvisiteur);
        $tabvisiteur =$pdo->getVisiteurRB();
        if($tabvisiteur){
            include("vues/v_rechercheVisiteurRB.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
        include("vues/v_FicheRB.php");
        break;
    }
    case'RechercheVisiteurVA':{
        $tabvisiteur =$pdo->getVisiteurVA();
        if($tabvisiteur){
            include("vues/v_rechercheVisiteurVA.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
     
        
        break;
    }
    case'RechercheVisiteurRB':{
        $tabvisiteur =$pdo->getVisiteurRB();
        if($tabvisiteur){
             include("vues/v_rechercheVisiteurRB.php");
        }else{
            include("vues/v_erreurFiche.php");
        }
       
        
        break;
    }
}
