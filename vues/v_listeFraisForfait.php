<div class="row justify-content-center w-100">
    <div class="p-3 mb-2 bg-light text-dark w-100">
      <h2>Renseigner ma fiche de frais du mois <?php echo $_SESSION['mois']."-".$_SESSION['annee'] ?></h2>
         
      <form method="POST"  action="index.php?uc=gererFrais&action=validerMajFraisForfait">
      <div class="corpsForm">
          
          <fieldset>
            <legend>Eléments forfaitisés
            </legend>
			<?php
				foreach ($lesFraisForfait as $unFrais)
				{
					$idFrais = $unFrais['idfrais'];
					$libelle = $unFrais['libelle'];
					$quantite = $unFrais['quantite'];
			?>
					<p>
						<label for="idFrais"><?php echo $libelle ?></label>
						<input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" size="10" maxlength="5" value="<?php echo $quantite?>" >
					</p>
			
			<?php
				}
			?>
			
			
			
			
           
          </fieldset>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" type="button" class="btn btn-primary"/>
        <input id="annuler" type="reset" value="Effacer" size="20" type="button" class="btn btn-primary"/>
      </p> 
      </div>
     </form>

    </div>
</div>
  