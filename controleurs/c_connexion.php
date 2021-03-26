<?php
if (!isset($_REQUEST['action']))
{
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action)
{
    case 'demandeConnexion':
        {

            include ("vues/v_connexion.php");
            break;
        }

    case 'valideConnexion':
        {
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $visiteur = $pdo->getInfosVisiteur($login, $mdp);
            if (!is_array($visiteur))
            {
                $comptable = $pdo->getInfosComptable($login, $mdp);
                if (password_verify($mdp, $comptable['mdp']))
                {
                    $id = $comptable['id'];
                    $nom = $comptable['nom'];
                    $prenom = $comptable['prenom'];
                    $role = 1;
                    $_SESSION['role'] = $role;
                    connecter($id, $nom, $prenom, $role);
                    include ("vues/v_sommaire.php");

                }
                else
                {
                    ajouterErreur("Login ou mot de passe incorrect");
                    include ("vues/v_erreurs.php");
                    include ("vues/v_connexion.php");
                }

            }
            else
            {
                if (password_verify($mdp, $visiteur['mdp']))
                {
                    $id = $visiteur['id'];
                    $nom = $visiteur['nom'];
                    $prenom = $visiteur['prenom'];
                    $role = 0;
                    $_SESSION['role'] = $role;
                    connecter($id, $nom, $prenom, $role);
                    include ("vues/v_sommaire.php");
                }
                else
                {
                    ajouterErreur("Login ou mot de passe incorrect");
                    include ("vues/v_erreurs.php");
                    include ("vues/v_connexion.php");
                }
            }
            $pdo->setCloture();
            break;
        }
    default:
        {
            include ("vues/v_connexion.php");
            break;
        }
    }
?>
