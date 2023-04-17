<?php
/*Fichier appelé lors de la soumission d'une mission à supprimer depuis la page interface */

require_once 'Modeles/Database.php';

$code = trim(htmlspecialchars($_POST['delete_mission']));
$databaseInteract = new Database();

/*Verification que le code donné n'est pas une chaîne vide */
function emptyCode(string $code) :bool 
{
    if(!isset($code)) {
        throw New Exception('Champ du code vide');
    } elseif ($code === '') {
        throw New Exception('Champ du code vide');
    } else {
        return true;
    }
}


if(emptyCode($code)) {
    $databaseInteract->deleteMission($code);
} else {
    throw new Exception('Votre code de mission n\'existe pas');
}
