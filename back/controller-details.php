<?php

require_once 'Modeles/Database.php';
require_once 'Modeles/Missions.php';

$missionCode = $_GET['mission'];
$databaseInteract = new Database();