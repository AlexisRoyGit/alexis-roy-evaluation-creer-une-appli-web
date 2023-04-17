<?php  
/*Fichier appelé au clic de l'utilisateur sur le bouton déconnexion */

require_once 'controller-session.php';

$session->deleteCookie();
$session->unsetSession();

header('location: ../Vue/index.php');