<?php
/*Fichier appelé lors de la modification d'une mission via la page interface */

require_once 'Modeles/Database.php';

/*Variables correspondant aux données envoyées par le formulaire */
$missionToModify = trim(htmlspecialchars($_POST['code_modify']));
$titleMission = trim(htmlspecialchars($_POST['title_modify']));
$description = trim(htmlspecialchars($_POST['description_modify']));
$country = trim(htmlspecialchars($_POST['country_modify']));
$agents = trim(htmlspecialchars($_POST['agents_modify']));
$contacts = trim(htmlspecialchars($_POST['contacts_modify']));
$targets = trim(htmlspecialchars($_POST['targets_modify']));
$type = trim(htmlspecialchars($_POST['type_modify']));
$status = trim(htmlspecialchars($_POST['status_modify']));
$hideouts = trim(htmlspecialchars($_POST['hideouts_modify']));
$speciality = trim(htmlspecialchars($_POST['speciality_modify']));
$dateStart = trim(htmlspecialchars($_POST['datestart_modify']));
$dateEnd = trim(htmlspecialchars($_POST['dateend_modify']));

/*Tableau associatif des différentes données associées à leur nom respectif dans la base de données */
$fieldsToModify = ['title' => $titleMission,'description' => $description,'country' => $country,'agents' => $agents,'contacts' => $contacts,'targets' => $targets,'missionType' => $type,'status' => $status,'hideouts' => $hideouts,'specialityRequired' => $speciality,'dateStart' => $dateStart,'dateEnd' => $dateEnd];

$databaseInteract = new Database();

$databaseInteract->modifyMission($fieldsToModify, $missionToModify);