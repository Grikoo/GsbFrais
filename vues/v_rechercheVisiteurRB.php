<div class="p-5 mb-5 bg-light text-dark">
	<!--<div name="haut" style="margin: 2 2 2 2 ;height:10%;float:left;"><h1>Validation des Frais</h1></div>!-->	

	<form name="formValidFrais" method="post" action="index.php?uc=validerFrais&action=FicheRB">
		<h1> Fiches de frais remboursés </h1>
		<label class="titre">Choisir la note de frais de :</label>
                
			<select name="lstVisiteur" class="zone">
                            <?php foreach($tabvisiteur as $visiteur){?>
                            <option value="<?php echo $visiteur['id']?>"><?php echo $visiteur['nomcomplet']?></option>
                            
                            <?php } ?>
                        </select>
                <input class="btn btn-primary" type="submit" />
         
        </form>
</div>