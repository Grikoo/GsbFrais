
    <!-- Division pour le sommaire -->
<div class="row justify-content-around">
    <nav class="navbar nav-fill navbar-light bg-light w-100 justify-content-around">
        <?php  if($_SESSION['role'] == 0){ ?>
        <ul class="nav">
            <li class="nav-item">
              <a href="index.php?uc=gererFrais&action=saisirFrais" class="nav-link active" title="Saisie fiche de frais ">Saisie fiche de frais</a>
            </li>
            <li class="nav-item">
               <a href="index.php?uc=etatFrais&action=selectionnerMois" class="nav-link active" title="Consultation de mes fiches de frais">Les fiches de frais</a>
            </li>
            <li class="nav-item mr-sm-2">
                <a class="nav-link disabled" tabindex="-1" >Visiteur : <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?></a>
            </li>
            <li class="nav-item my-2 my-sm-0">
               <a href="index.php?uc=connexion&action=deconnexion" class="nav-link active" title="Se déconnecter">Déconnexion</a>
            </li>
        </ul>
    </nav>
        <?php }else{ ?>
    <nav class="navbar nav-fill navbar-light bg-light w-100 justify-content-around">
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <a href="index.php?uc=validerFrais&action=RechercheVisiteurCL" title="Valider fiche de frais">Fiches à valider</a>
                </div>
                <div class="col">
                    <a href="index.php?uc=validerFrais&action=RechercheVisiteurVA" title="Consultation l'avancement du paiement des fiches frais">Fiches en attente de paiement</a>
                </div>
                <div class="col">
                    <a href="index.php?uc=validerFrais&action=RechercheVisiteurRB" title="Consultation l'avancement du paiement des fiches frais">Fiches de frais remboursés</a>
                </div>
                <div class="col">
                    <a class="nav-link disabled">Comptable : <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?></a>
                </div>
                <div class="col">
                    <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter"> Déconnexion</a>
                </div>
            </div>
        </div>
        
        
        
        
        
    </nav>
        <?php } ?>
           
        
</div>
<div class="mb-5 p-3 mb-2 bg-secondary text-white"></div>
<div class="row justify-content-center">﻿
    