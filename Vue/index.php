<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <title>Liste des missions</title>
</head>
<body>
    <nav>
        <a href="index.php" class="accueil">Agence Mission Secrete </a>
        <!--Vérifie si l'utilisateur est un admin connecté -->
        <?php require_once '../back/controller-session.php'; 
            $session->checkSessionIndex();
        ?>
    </nav>
    <h1>Liste des missions en cours . . .</h1>
    <main>
    <table>
        <thead>
            <tr>
                <th>Code de la mission</th>
                <th>Titre</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>En savoir plus . . .</th>
            </tr>
        </thead>
        <tbody>
            <!--Affiche les missions si on se trouver sur sur index.php ou index.php?page=1 -->
            <?php require_once '../back/controller-index.php'; 
                if(!isset($_GET['page'])) {
                    $databaseInteract->displayMissionsNoPage();
                } else {
                    $databaseInteract->displayMissions();
                }
                ;
            ?>
        </tbody>
    </table>
    </main>
    <div class="pagination">
    <!--Affiche la pagination-->
    <?php $databaseInteract->missionPagination() ?>
    </div>
</body>
</html>