<?php


class Session 
{
    /*Lien vers l'interface et bouton de deconnexion*/
    public function sessionSetIndex() 
    {
        session_start();
        echo '<a href="../back/deconnexion.php" class="deconnexion">Déconnexion</a>';
        echo '<a href="../Vue/interface.php" class="interface">Interface</a>';
    }

    /*Lien vers la page de connexion de l'interface de modification des missions*/
    public function noSession() 
    {
        echo '<a href="connexion.html" class="connexion">Connexion</a>';
    }

    /*Accès à l'interface ou non selon la présence du cookie PHPSESSID*/
    public function checkSessionIndex() 
    {
        if(isset($_COOKIE['PHPSESSID'])) {
            $this->sessionSetIndex();
        } else {
            $this->noSession();
        }
    }

    /*Bouton de deconnexion présent sur la page interface*/
    public function sessionSetInterface() 
    {
        session_start();
        echo '<a href="../back/deconnexion.php" class="deconnexion">Déconnexion</a>';
    }

    /*Affichage de l'administrateur connecté*/
    public function displayAdminName() 
    {
        echo '<u>'.$_SESSION['admin'].'</u>';
    }

    /*Fin de la session via la suppression du cookie PHPSESSID et de la variable de SESSION admin */
    public function deleteCookie() {
        if(isset($_COOKIE['PHPSESSID'])) {
            unset($_COOKIE['PHPSESSID']);
            setcookie('PHPSESSID', '', time() - 3600, '/');
        }
    }

    public function unsetSession() {
        unset($_SESSION['admin']);
    }
}