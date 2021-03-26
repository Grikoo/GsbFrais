<div class="mb-5"></div>
<div class="row justify-content-center w-100 p-3 mb-2 bg-light text-dark">
    

            <!--<div name="haut" style="margin: 2 2 2 2 ;height:10%;float:left;"><h1>Validation des Frais</h1></div>!-->	

            <form name="formValidFrais" method="post" action="index.php?uc=validerFrais&action=FicheVA">
                <fieldset>
                    <h1> Frais à valider </h1>
                    <label>Choisir la note de frais de : </label>

                            <select name="lstVisiteur" >
                                <?php foreach($tabvisiteur as $visiteur){?>
                                <option value="<?php echo $visiteur['id']?>"><?php echo $visiteur['nomcomplet']?></option>

                                <?php } ?>
                            </select>
                    <input class="btn btn-primary" type="submit" />
                </fieldset>
            </form>
</div>
<div class="mb-5"></div>