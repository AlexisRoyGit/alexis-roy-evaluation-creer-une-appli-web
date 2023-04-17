<?php
/*Fichier appelé à la connexion de l'utilisateur via le formulaire de connexion */

require_once 'Modeles/Admins.php';
require_once 'Modeles/Database.php';

$login = trim(htmlspecialchars($_POST['login']));
$password = $_POST['mdp'];
$databaseInteract = new Database();

/*Verfifcation que les champs de connexion ne sont pas vides */
function emptyFields(string $log, string $pass) :bool 
{
    if(!isset($log) || !isset($pass)) {
        throw New Exception('Champs login/password nuls');
    } elseif ($log === '' || $pass === '') {
        throw New Exception('Vous devez remplir les 2 champs du formulaire');
    } else {
        return true;
    }
}

/*Verification de la validité de l'email utilisé en tant que login*/
function emailVerify(string $email) :bool 
{
    $pattern = '/^[A-z0-9_.+-]+@[A-z0-9-]+\.[A-z0-9-.]+$/';
    if(preg_match($pattern, $email)) {
        return true;
    } else {
        throw new Exception('Votre adresse mail est invalide');
    }
}


if(emptyFields($login, $password) && emailVerify($login)) {
    $databaseInteract->connectionInterface($login,$password);
} else {
    echo "Identifiants erronés";
}
