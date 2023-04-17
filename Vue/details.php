<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Vue/index.css" type="text/css">
    <title>Liste des missions</title>
</head>
<body>
    <nav>
        <a href="index.php?page=1" class="accueil">Agence Mission Secrete </a>
        <!--Vérifie si l'utilisateur est un admin connecté -->
        <?php require_once '../back/controller-session.php'; 
            $session->checkSessionIndex();
        ?>
    </nav>
    <h1>Détails de la mission <?php  require_once '../back/controller-details.php'; echo $missionCode ?></h1>
    <main>
    <table>
        <thead>
            <tr>
                <th>Code de la mission</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Pays</th>
                <th>Agents</th>
                <th>Contacts</th>
                <th>Cible</th>
                <th>Type de mission</th>
                <th>Statut</th>
                <th>Planque</th>
                <th>Spécialité requise</th>
                <th>Date de début</th>
                <th>Date de fin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!--Affiche le détail de la mission sélectionnée -->
                <?php $databaseInteract->displayDetailedMissions(); ?>
            </tr>
        </tbody>
    </table>
    </main>
</body>
</html>