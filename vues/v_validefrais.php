
<div class="row justify-content-center">
    ﻿<div class="p-5 mb-5 bg-light text-dark">

    <!--<div name="haut" style="margin: 2 2 2 2 ;height:10%;float:left;"><h1>Validation des Frais</h1></div>!-->	
            <form name="formValidFrais" method="post" action="index.php?uc=validerFrais&action=affichefrais">
                <fieldset>
                    <h1> Frais à valider </h1>
                    <label class="titre">Choisir la note de frais de :</label>

                            <select name="lstVisiteur" class="zone">
                                <?php foreach($tabvisiteur as $visiteur){?>
                                <option value="<?php echo $visiteur['id']?>"><?php echo $visiteur['nomcomplet']?></option>

                                <?php } ?>
                            </select>
                    <label class="titre">Mois :</label>
                            <input type="text" id="idFrais" name="mois" size="10" maxlength="5" palceholder="Mois">
                            <label class="titre">Année :</label>
                            <input type="text" id="idFrais" name="annee" size="10" maxlength="5" palceholder="Année">
                            <input class="btn btn-primary" type="submit" />
                </fieldset>
            </form>
    </div>
</div>