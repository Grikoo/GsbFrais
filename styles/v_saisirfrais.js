        function ajoutLigne( pNumero){//ajoute une ligne de produits/qté à la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incrémente le numéro de ligne
            var laDiv=document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
			var titre = document.createElement("label") ;	//crée un label
			laDiv.appendChild(titre) ;						//l'ajoute à la DIV
			titre.setAttribute("class","titre") ;			//définit les propriétés
			titre.innerHTML= "   "+ pNumero + " : ";
			//zone our la date du frais
			var ladate = document.createElement("input");
			laDiv.appendChild(ladate);
			ladate.setAttribute("name","FRA_AUT_DAT"+pNumero);
			ladate.setAttribute("size","12"); 
			ladate.setAttribute("class","zone");
			ladate.setAttribute("type","text");	
			//zone de saisie pour un nouveau libellé			
			var libelle = document.createElement("input");
			laDiv.appendChild(libelle);
			libelle.setAttribute("name","FRA_AUT_LIB"+pNumero);
			libelle.setAttribute("size","30"); 
			libelle.setAttribute("class","zone");
			libelle.setAttribute("type","text");
			//zone de saisie pour un nouveau montant		
			var mont = document.createElement("input");
			laDiv.appendChild(mont);
			mont.setAttribute("name","FRA_AUT_MONT"+pNumero);
			mont.setAttribute("size","3"); 
			mont.setAttribute("class","zone");
			mont.setAttribute("type","text");			
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }

