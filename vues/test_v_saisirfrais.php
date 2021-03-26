

<div name="droite" style="float:left;width:80%;">
	<div name="haut" style="margin: 2 2 2 2 ;height:10%;float:left;">
            <h1>Gestion des Frais</h1>
        </div>	
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
	<form name="formSaisieFrais" method="post" action="index.php?uc=validerFrais&action=">
		<h1> Saisie </h1>
		<label class="titre">PERIODE D'ENGAGEMENT :</label>
			<label style="float:left;">Mois (2 chiffres) : </label>
                        <input type="text" size="4" name="FRA_MOIS" class="zone" />
			<label style="float:left;">&nbsp;Année (4 chiffres) : </label>
                        <input type="text" size="4" name="FRA_AN" class="zone" />
		<p class="titre" />
                <div style="clear:left;">
                    <h2>Frais au forfait</h2>
                </div>
		<label class="titre">Repas midi :</label>
                <input type="text" size="2" name="FRA_REPAS" class="zone" />
		<label class="titre">Nuitées :</label>
                <input type="text" size="2" name="FRA_NUIT" class="zone" />
		<label class="titre">Etape :</label>
                <input type="text" size="5" name="FRA_ETAP" class="zone" />
		<label class="titre">Km :</label>
                <input type="text" size="5" name="FRA_KM" class="zone" />
		<p class="titre" />
                <div style="clear:left;">
                    <h2>Hors Forfait</h2>
                </div>
		<div style="clear:left;">			
			<div style="margin-left:180;float:left;width:90;text-align:center;">Date</div>
			<div style="float:left;width:220;text-align:center;">Libellé</div>
			<div style="float:left;width:30;text-align:center;">Montant</div>
		</div>
		<div style="clear:left;" id="lignes">
			<label class="titre" > 1 : </label>
			<input type="text" size="12" name="FRA_AUT_DAT1" class="zone"/>
			<input type="text" size="30" name="FRA_AUT_LIB1" class="zone"/>
			<input class="zone" size="3" name="FRA_AUT_MONT1" type="text" />				
			<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />			
		</div>	
		<p class="titre" />
                <label class="titre">&nbsp;</label>
                <input class="zone"type="reset" />
                <input class="zone"type="submit" />
	</form>
	</div>
</div>
