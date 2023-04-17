<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des missions</title>
    <link rel="stylesheet" href="interface.css">
</head>
<body>
    <nav>
        <a href="index.php" class="accueil">Agence Mission Secrete </a>
        <!--Si le client est un admin connecté le détail de la base de données et les différents formulaires s'affichent -->
        <?php require_once '../back/controller-session.php'; 
            if(isset($_COOKIE['PHPSESSID'])) {
                $session->sessionSetInterface();
        ?>
    </nav>
    <!--Affichage du nom de l'admin connecté -->
    <h1>Interface back-office: <?php $session->displayAdminName(); ?> connecté</h1>
    <!--Affichage des tables Agents,Contacts,Planques,Cibles, et Missions  -->
    <h2>Agents :</h2>
    <table>
        <thead>
            <tr>
                <th>Code de l'agent</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Nationalité</th>
                <th>Spécialité(s)</th>
            </tr>
        </thead>
        <tbody>
                <?php require_once '../back/controller-interface.php'; 
                    $databaseInteract->displayAgents();
                ?>
        </tbody>
    </table>
    <h2>Contacts :</h2>
    <table>
        <thead>
            <tr>
                <th>Nom de code</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Nationalité</th>
            </tr>
        </thead>
        <tbody>
            <?php $databaseInteract->displayContacts(); ?>
        </tbody>
    </table>
    <h2>Planques :</h2>
    <table>
        <thead>
            <tr>
                <th>Nom de code</th>
                <th>Adresse</th>
                <th>Pays</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php $databaseInteract->displayHideouts();  ?>
        </tbody>
    </table>
    <h2>Cibles :</h2>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Nationalité</th>
            </tr>
        </thead>
        <tbody>
            <?php $databaseInteract->displayTargets();  ?>
        </tbody>
    </table>
    <h2>Missions :</h2>
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
            <?php $databaseInteract->displayMissionsInterface(); ?> 
        </tbody>
    </table>
    <h3>Formulaires d'interaction avec la base de donnees</h3>
    <!--Formualire de création de mission -->
    <h4>Creer une mission :</h4>
        <form method="post" action="../back/createMission.php" class="formulaire">
            <fieldset>
                <legend>Création</legend>
                <label for="code_mission">Code de la mission (1758MJX par exemple, 20 caractères maximum)</label>
                <input type="text" name="code_mission" id="code_mission" required>
                <label for="title_mission">Titre de la mission (100 caractères maximum)</label>
                <input type="text" name="title_mission" id="title_mission" required>
                <label for="description_mission">Description de la mission (200 caractères maximum)</label>
                <textarea name="description_mission" id="description_mission" required></textarea>
                <label for="country_mission">Pays de la mission (Allemagne, France, Amerique, Espagne, Angleterre)</label>
                <input type="text" name="country_mission" id="country_mission" required>
                <label for="agents_mission">Agent(s) de la mission (Code)</label>
                <input type="number" name="agents_mission" id="agents_mission" required>
                <label for="contacts_mission">Contact(s) de la mission (Nom de code)</label>
                <input type="text" name="contacts_mission" id="contacts_mission" required>
                <label for="targets_mission">Cible(s) de la mission (Code)</label>
                <input type="text" name="targets_mission" id="targets_mission" required>
                <label for="type_mission">Type de la mission (Surveillance, Assassinat... 100 caractères maximum)</label>
                <input type="text" name="type_mission" id="type_mission" required>
                <label for="status_mission">Statut de la mission (En cours, Echec... 100 caractères maximum)</label>
                <input type="text" name="status_mission" id="status_mission" required>
                <label for="hideouts_mission">Planque(s) utilisées (Nom de code)</label>
                <input type="text" name="hideouts_mission" id="hideouts_mission">
                <label for="speciality_mission">Spécialité requise pour la mission(Infiltration/Reconnaissance/Assassinat/Combat)</label>
                <input type="text" name="speciality_mission" id="speciality_mission" required>
                <label for="datestart_mission">Date de début de la mission</label>
                <input type="date" name="datestart_mission" id="datestart_mission" required>
                <label for="dateend_mission">Date de fin de la mission</label>
                <input type="date" name="dateend_mission" id="dateend_mission" required>
                <button type="submit" id="button_creation">Créer la mission</button>
            </fieldset>
        </form>
    <!--Formualire de modification d'une mission -->
    <h4>Modifier une mission :</h4>
    <p>Entrer le code de la mission visée puis remplissez les champs que vous souhaitez modifier.</p>
    <form method="post" action="../back/modifyMission.php" class="formulaire">
        <fieldset>
            <legend>Modification</legend>
            <label for="code_modify">Code de la mission (1758MJX par exemple, 20 caractères maximum)</label>
            <input type="text" name="code_modify" id="code_modify" required>
            <label for="title_modify">Titre de la mission (100 caractères maximum)</label>
            <input type="text" name="title_modify" id="title_modify">
            <label for="description_mission">Description de la mission (200 caractères maximum)</label>
            <textarea name="description_modify" id="description_modify" rows="5" cols="15"></textarea>
            <label for="country_modify">Pays de la mission (Allemagne, France, Amerique, Espagne, Angleterre)</label>
            <input type="text" name="country_modify" id="country_modify">
            <label for="agents_modify">Agent(s) de la mission (Code)</label>
            <input type="number" name="agents_modify" id="agents_modify">
            <label for="contacts_mission">Contact(s) de la mission (Nom de code)</label>
            <input type="text" name="contacts_modify" id="contacts_modify">
            <label for="targets_modify">Cible(s) de la mission (Code)</label>
            <input type="text" name="targets_modify" id="targets_modify">
            <label for="type_modify">Type de la mission (Surveillance, Assassinat... 100 caractères maximum)</label>
            <input type="text" name="type_modify" id="type_modify">
            <label for="status_modify">Statut de la mission (En cours, Echec... 100 caractères maximum)</label>
            <input type="text" name="status_modify" id="status_modify">
            <label for="hideouts_modify">Planque(s) utilisées (Nom de code)</label>
            <input type="text" name="hideouts_modify" id="hideouts_modify">
            <label for="speciality_modify">Spécialité requise pour la mission(Infiltration/Reconnaissance/Assassinat/Combat)</label>
            <input type="text" name="speciality_modify" id="speciality_modify">
            <label for="datestart_modify">Date de début de la mission</label>
            <input type="date" name="datestart_modify" id="datestart_modify">
            <label for="dateend_modify">Date de fin de la mission</label>
            <input type="date" name="dateend_modify" id="dateend_modify">
            <button type="submit" id="button_modify">Envoi des modifications</button>
        </fieldset>
    </form>
    <!--Formualire de suppression d'une mission -->
    <h4>Supprimer une mission :</h4>
    <form method="post" action="../back/delete.php" class="suppression">
        <fieldset>
            <legend>Suppression</legend>
            <label for="delete_mission">Code de la mission à supprimer</label>
            <input type="text" name="delete_mission" id="delete_mission" required>
            <button type="submit" id="button_delete">Supprimer</button>
        </fieldset>
    </form>
    <!--Si le client n'est pas un admin connecté un message et le lien de connexion s'affichent-->
    <?php  
        } else {
            $session->noSession();
            echo "<p class='noaccess'>Vous n'avez pas accès à cette page veuillez vous connecter via vos identifiants administrateurs</p>";
        }
     ?>
</body>
</html>