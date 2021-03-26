<div class="p-3 mb-2 bg-light text-dark"> <!--couleur grise du site-->
    ﻿<div class="col justify-content-center" >
        <div class="row justify-content-center">
            <h2>Identification utilisateur</h2>
        </div>
        
        <div class="row justify-content-center">
            <form method="POST" action="index.php?uc=connexion&action=valideConnexion">
                <p>
                    <label for="login">Nom d'utilisateur :</label>
                    <input id="exampleFormControlInput1" type="text" name="login" class="form-control">
                    <label for="mdp">Mot de passe :</label>
                    <input id="exampleFormControlInput1"  type="password"  name="mdp" class="form-control">
                </p>
                <p>
                 <input type="submit" value="Valider" name="valider" class="btn btn-primary">
                 <input type="reset" value="Annuler" name="annuler" class="btn btn-primary"> 
                </p>
            </form>
        </div>
</div>
</div>