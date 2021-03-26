<div class="row justify-content-center w-100 p-3 mb-2 bg-light text-dark">
    <table class="table table-bordered">
            <caption>Les fiches de frais remboursées
            </caption>
                <thead class="table-dark">
                    <th class="date">ID Visiteur</th>
                    <th class="libelle">Mois</th>  
                    <th class="montant">Montant</th>              
                </thead>
          
    <?php    
	    foreach( $lesfraispayes as $unFraisHorsForfait) 
		{
			$montant=$unFraisHorsForfait['montantValide'];
			$id = $unFraisHorsForfait['idVisiteur'];
                        $mois = $unFraisHorsForfait['mois'];
                        $numAnnee = substr($mois, 0,4);
                        $numMois = substr($mois, 4,2);
                        $nom = $unFraisHorsForfait['nom'];
                        $prenom = $unFraisHorsForfait['prenom'];
	?>		
            <tr>
                <td><?php echo $nom." ".$prenom?></td>
                <td><?php echo $numMois."-".$numAnnee ?></td>
                <td><?php echo $montant ?></td>
            </tr>
                
	<?php		 
          
          }
	?>	  
                                          
    </table>
</div>