<div class="mb-5"></div>
<div class="row justify-content-center w-100">
    <div class="p-3 mb-2 bg-light text-dark w-100">
        <h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : </h3>

        <p>
            Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
        </p>
        <caption>Eléments forfaitisés </caption>
            <table class="table table-dark">  	   
                    <tr>
                        <?php
                            foreach ( $lesFraisForfait as $unFraisForfait ) 
                            {
                                $libelle = $unFraisForfait['libelle'];
                                ?>	
                                <th> <?php echo $libelle?></th>
                                <?php
                            }
                                ?>
                    </tr>
                    <tr>
                        <?php
                            foreach (  $lesFraisForfait as $unFraisForfait  ) 
                            {
                                $quantite = $unFraisForfait['quantite'];
                        ?>
                        <td class="qteForfait"><?php echo $quantite?> </td>
                        <?php
                            }         
                        ?>
                    </tr>
        </table>

        <table class="table table-dark">
            <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
            </caption>

            <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>                
            </tr>

            <?php      
              foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
                      {
                            $date = $unFraisHorsForfait['date'];
                            $libelle = $unFraisHorsForfait['libelle'];
                            $montant = $unFraisHorsForfait['montant'];
            ?>

            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
            </tr>

            <?php 
              }
            ?>
        </table>
    
    </div>
</div>
 













