<div class="row justify-content-center w-100 p-3 mb-2 bg-light text-dark">
    <table class="listeLegere w-100">
  	   <caption>Les fiches de frais en attente de paiement
       </caption>
    <tr class="bg-light">
                <td> Nom </td>
                <td> Date </td>
                <td> Montant </td>  
             </tr>
          
    <?php    
	    foreach( $lesfichesfraispaiement as $r) 
		{
			$montant=$r['montantValide'];
			$id = $r['idVisiteur'];
                        $mois = $r['mois'];
                        $numAnnee = substr($mois, 0,4);
                        $numMois = substr($mois, 4,2);
                        $nom = $r['nom'];
                        $prenom = $r['prenom'];
	?>		
            <tr>
                <td> <?php echo $nom." ".$prenom?></td>
                <td><?php echo $numMois."-".$numAnnee ?></td>
                <td><?php echo $montant ?></td>
                <td><a href="index.php?uc=validerFrais&action=paiementfrais&id=<?php echo $id ?>&mois=<?php echo $mois ?>" 
				onclick="return confirm('Voulez-vous vraiment payer cette fiche?');">Payer</a></td>
                
             </tr>
	<?php		 
          
          }
	?>	  
                                          
    </table>
</div>