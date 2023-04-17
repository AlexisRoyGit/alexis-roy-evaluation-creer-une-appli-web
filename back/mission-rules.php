<?php

/*FONCTIONS SUR TOUS LES CHAMPS (pas espace indesirables ou champs vides)*/
function nonEmptyFields(string $code, string $title, string $description, string $country, int $agents, string $contacts, string $targets, 
 string $missionType,
 string $status,
 string $specialityRequired,
 string $dateStart,
 string $dateEnd) :bool 
{
    if(
        !isset($code) || 
        !isset($title) || 
        !isset($description) ||
        !isset($country) || 
        !isset($agents) || 
        !isset($contacts)|| 
        !isset($targets) || 
        !isset($missionType) || 
        !isset($status) || 
        !isset($specialityRequired) || 
        !isset($dateStart)|| 
        !isset($dateEnd) ) 
        {
           return false;
        } elseif (
            $code === '' || 
            $title === '' || 
            $description === '' || 
            $country === '' || 
            $agents === '' || 
            $contacts === '' || 
            $targets === '' || 
            $missionType === '' || 
            $status === '' || 
            $specialityRequired === '' || 
            $dateStart === '' || 
            $dateEnd === '' ) 
        {
            return false;
        } else {
            return true;
        }
}

function lengthFields(string $code, string $title, string $description, string $country, string $missionType,
string $status,
string $specialityRequired): bool
{
    if(strlen($code) > 20 || strlen($title) > 100 || strlen($description) > 200 || strlen($country) > 100  || strlen($missionType) > 150 
        || strlen($status) > 100 || strlen($specialityRequired) > 15) {
            return false;
        } else {
            return true;
        }
}

function noSpaces(string $code): string
{
    $newCode = str_replace(" ", "-", $code);
    return $newCode;
}

/*FONCTION COMPARAISON NATIONALITE DE L'AGENT ET DE LA CIBLE QUI DOIVENT ETRE DIFFERENTS */
function agentNationality(int $agent): string 
{
    try {
        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=mission_secrete', 'root', 'root');
        $pdoStatement = $pdo->prepare('SELECT nationality FROM agents WHERE code_agent = :code');
        $pdoStatement->bindValue(':code', $agent, PDO::PARAM_INT);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Agents');
        if($pdoStatement->execute()) {
            $agentNationality = $pdoStatement->fetch();
            return $agentNationality->getAgentNationality();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function targetNationality(string $target): string
{
    try {
        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=mission_secrete', 'root', 'root');
        $pdoStatement = $pdo->prepare('SELECT nationality FROM targets WHERE code_target = :code');
        $pdoStatement->bindValue(':code', $target, PDO::PARAM_STR);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Targets');
        if($pdoStatement->execute()) {
            $targetNationality = $pdoStatement->fetch();
            return $targetNationality->getTargetNationality();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function agentTargetNationalityComparison(int $agent, string $target): bool
{
    if(agentNationality($agent) !== targetNationality($target)) {
        return true;
    } else {
        return false;
    }
}

/*FONCTIONS COMPARAISON PAYS DE LA MISSION ET NATIONALITE DU CONTACT QUI DOIVENT ETRE LES MEMES */

function contactCountry(string $contact): string
{
    try {
        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=mission_secrete', 'root', 'root');
        $pdoStatement = $pdo->prepare('SELECT nationality FROM contacts WHERE codeName = :contact');
        $pdoStatement->bindValue(':contact', $contact, PDO::PARAM_STR);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Contacts');
        if($pdoStatement->execute()) {
            $contactNationality = $pdoStatement->fetch();
            return $contactNationality->getContactCodeNationality();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function verifyCountryMissionContactNationality(string $pays, string $contact): bool 
{
    $nationality = strtolower(contactCountry($contact));
    switch($pays) {
        case 'Espagne':
            if($nationality === 'espagnol' || $nationality === 'espagnol') {
                return true;
            } else {
                return false;
            }
            break;
        case 'Allemagne':
            if($nationality === 'allemand' || $nationality === 'allemande') {
                return true;
            } else {
                return false;
            }
            break;
        case 'Amerique':
            if($nationality === 'americain' || $nationality === 'americaine') {
                return true;
            } else {
                return false;
            }
            break;
        case 'France':
            if($nationality === 'francais' || $nationality === 'francaise') {
                return true;
            } else {
                return false;
            }
            break;
        case 'Angleterre':
            if($nationality === 'britannique') {
                return true;
            } else {
                return false;
            }
            break;
        default:
            return false;
    }
}


/*FONCTIONS COMPARAISON PAYS DE LA MISSION ET PAYS DE LA PLANQUE QUI DOIVENT ETRE LES MEMES */

function countryHideout(string $hideout): string
{
    try {
        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=mission_secrete', 'root', 'root');
        $pdoStatement = $pdo->prepare('SELECT country FROM hideouts WHERE code_hideout = :code');
        $pdoStatement->bindValue(':code', $hideout, PDO::PARAM_STR);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Hideouts');
        if($pdoStatement->execute()) {
            $hideoutCountry = $pdoStatement->fetch();
            return $hideoutCountry->getHideoutCountry();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function compareMissionCountryHideout(string $hideout, string $country): bool
{
    if(is_null($hideout) || $hideout === '') {
        return true;
    } elseif (countryHideout($hideout) === $country) {
        return true;
    } else {
        return false;
    }
}


/*FONCTIONS COMPARAISON SPECIALITE DE LA MISSION ET AGENT AYANT CETTE SPECIALITE (au moins 1)*/

function agentSpeciality(int $agent): string 
{
    try {
        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=mission_secrete', 'root', 'root');
        $pdoStatement = $pdo->prepare('SELECT specialities FROM agents WHERE code_agent = :code');
        $pdoStatement->bindValue(':code', $agent, PDO::PARAM_INT);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Agents');
        if($pdoStatement->execute()) {
            $agentSpeciality = $pdoStatement->fetch();
            return $agentSpeciality->getAgentSpecialities();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function compareSpecialityRequiredAgent(int $agent, string $speciality): bool
{
    $specialityAgent = agentSpeciality($agent);
    if(preg_match('/'.$speciality.'/i', $specialityAgent)) {
        return true;
    } else {
       return false;
    }
}