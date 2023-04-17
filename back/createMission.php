<?php
/*Fichier appelé lors de la création d'une mission via la page interface */

require_once 'Modeles/Agents.php';
require_once 'Modeles/Targets.php';
require_once 'Modeles/Contacts.php';
require_once 'Modeles/Hideouts.php';
require_once 'mission-rules.php';
require_once 'Modeles/Database.php';

/*Variables correspondant aux données envoyées par le formulaire */
$codeMission = trim(htmlspecialchars($_POST['code_mission']));
$titleMission = trim(htmlspecialchars($_POST['title_mission']));
$description = trim(htmlspecialchars($_POST['description_mission']));
$country = trim(htmlspecialchars($_POST['country_mission']));
$agents = trim(htmlspecialchars($_POST['agents_mission']));
$contacts = trim(htmlspecialchars($_POST['contacts_mission']));
$targets = trim(htmlspecialchars($_POST['targets_mission']));
$type = trim(htmlspecialchars($_POST['type_mission']));
$status = trim(htmlspecialchars($_POST['status_mission']));
$hideouts = trim(htmlspecialchars($_POST['hideouts_mission']));
$speciality = trim(htmlspecialchars($_POST['speciality_mission']));
$dateStart = trim(htmlspecialchars($_POST['datestart_mission']));
$dateEnd = trim(htmlspecialchars($_POST['dateend_mission']));


$databaseInteract = new Database();

$databaseInteract->createMission($codeMission, $titleMission, $description, $country, $agents, $contacts, $targets, $type, $status, $hideouts, $speciality, $dateStart, $dateEnd);