
<div class="row justify-content-center w-100 bg-light text-dark">
    
    <form name="formValidFrais" method="post" action="index.php?uc=validerFrais&action=Validerfrais">
        <div class="mb-5">
            </div>
        <h1> Frais à valider </h1>
        <h2> Frais au forfait </h2>
        
            <?php foreach($lesFraisForfait as $lesfrais){?>              
                <label for="idFrais"><?php echo $lesfrais['libelle'] ?>:</label>
                    <input type="text" id="idFrais" name="lesFrais[<?php echo $lesfrais['idfrais']?>]" size="10" maxlength="5" value="<?php echo $lesfrais['quantite']?>">
                    <br>
                
            <?php }
                        if($lesFraisHorsForfait){?> 
                <table>
                    <caption>Descriptif des éléments hors forfait
                    </caption>

                    <tr class="table table-bordered">
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
                            $mois = $unFraisHorsForfait['mois'];
            ?>		
                <tr>
                    <td> <?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=validerFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                     <td><a href="index.php?uc=validerFrais&action=deplacerFrais&idFrais=<?php echo $id ?>&iddate=<?php echo $mois ?>&montant=<?php echo $montant?>&libelle=<?php echo $libelle?>&date=<?php echo $date?>" 
                                    onclick="return confirm('Voulez-vous vraiment deplacer ce frais?');">Deplacer ce frais au mois suivant</a></td>
                 </tr>
            <?php		 

              }
            }
            ?>	  
                                          
                </table>
                    <td width="80"> 
                        <select size="3" name="Etat">
                                <option value="CL">Enregistré</option>
                                <option value="VA">Validé</option>
                        </select>
                    </td>
                        <br>
                        <input class="zone"type="reset" class="btn btn-primary"/>
                          <input class="zone"type="submit" class="btn btn-primary"/>
                          
            
                          
        </form>
 </div>
                                
                 
		