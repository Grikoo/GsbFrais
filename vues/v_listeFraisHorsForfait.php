
<?php if($lesFraisHorsForfait){ ?>
﻿<div class="p-3 mb-2 bg-light text-dark w-100">
    
    <table>
            <caption>Descriptif des éléments hors forfait</caption>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th>              
                </tr>
          
    <?php    
	    foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
		{
			$libelle = $unFraisHorsForfait['libelle'];
			$date = $unFraisHorsForfait['date'];
			$montant=$unFraisHorsForfait['montant'];
			$id = $unFraisHorsForfait['id'];
	?>		
            <tr>
                <td> <?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
				onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
             </tr>
	<?php		 
          
          }
	?>
                                    
    </table>
    
    </div>
<?php } ?>
    ﻿<div class="p-3 mb-2 bg-light text-dark w-100 justify-content-center"> 
        <form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
            <div>
         
                <fieldset>
                    <h2>Nouvel élément hors forfait</h2>

                    <p>
                        <label for="txtDateHF">Date</label>
                        <input  placeholder="(jj/mm/aaaa):" type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value=""  />
                    </p>

                    <p>
                        <label for="txtLibelleHF">Libellé</label>
                        <input type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" />
                    </p>

                    <p>
                        <label for="txtMontantHF">Montant : </label>
                        <input type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
                    </p>
                </fieldset>
            </div>
        <div>
            <p>
                <input id="ajouter" type="submit" value="Ajouter" size="20" type="button" class="btn btn-primary"/>
                <input id="effacer" type="reset" value="Effacer" size="20" type="button" class="btn btn-primary"/>
            </p> 
        </div>
        
      </form>
  </div>

  

