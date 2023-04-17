<?php


class Database {

    private $pdo;

    /*PDO utilisé */
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=8889;dbname=mission_secrete', 'root', 'root');
    }

    /*Liens de pagination qui augmente toutes les 10 missions */
    public function missionPagination()
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT COUNT(*) AS TotalMissions FROM missions');
            if($pdoStatement->execute()) {
                while($totalMissions = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
                    for($i = 1; $i <= ceil($totalMissions['TotalMissions'] / 10); $i++) {
                        echo '<a href=?page='.$i.'>'.$i.'</a>';
                    }
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    /*Affichage des missions sur index.php et index.php?page=1 */
    public function displayMissions() 
    {
        try{
            $pdoStatement = $this->pdo->prepare('SELECT code_mission, title, dateStart, dateEnd FROM missions ORDER BY dateStart LIMIT :start, 10');
            $pdoStatement->bindValue(':start', 10 * ($_GET['page'] - 1), PDO::PARAM_INT);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Missions');
            if($pdoStatement->execute()) {
                while($missions = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$missions->getMissionCode().'</td>';
                    echo '<td>'.$missions->getMissionTitle().'</td>';
                    echo '<td>'.$missions->getMissionDateStart().'</td>';
                    echo '<td>'.$missions->getMissionDateEnd().'</td>';
                    echo '<td><a class="details" href="../Vue/details.php?mission='.$missions->getMissionCode().'" target="_blank">Détails +</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "erreur";
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function displayMissionsNoPage() 
    {
        try{
            $pdoStatement = $this->pdo->prepare('SELECT code_mission, title, dateStart, dateEnd FROM missions ORDER BY dateStart LIMIT 10');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Missions');
            if($pdoStatement->execute()) {
                while($missions = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$missions->getMissionCode().'</td>';
                    echo '<td>'.$missions->getMissionTitle().'</td>';
                    echo '<td>'.$missions->getMissionDateStart().'</td>';
                    echo '<td>'.$missions->getMissionDateEnd().'</td>';
                    echo '<td><a class="details" href="../Vue/details.php?mission='.$missions->getMissionCode().'" target="_blank">Détails +</a></td>';
                    echo '</tr>';
                }
            } else {
                echo "erreur";
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*Affichage détaillée des missions sur la page details.php */
    public function displayDetailedMissions() 
    {
        $mission = $_GET['mission'];
    
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM missions WHERE code_mission = :code');
            $pdoStatement->bindValue(':code', $mission, PDO::PARAM_STR);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Missions');
            if($pdoStatement->execute()) {
                $missionDetailed = $pdoStatement->fetch();
                echo '<td>'.$missionDetailed->getMissionCode().'</td>';
                echo '<td>'.$missionDetailed->getMissionTitle().'</td>';
                echo '<td>'.$missionDetailed->getMissionDescription().'</td>';
                echo '<td>'.$missionDetailed->getMissionCountry().'</td>';
                echo '<td>'.$missionDetailed->getMissionAgents().'</td>';
                echo '<td>'.$missionDetailed->getMissionContacts().'</td>';
                echo '<td>'.$missionDetailed->getMissionCibles().'</td>';
                echo '<td>'.$missionDetailed->getMissionType().'</td>';
                echo '<td>'.$missionDetailed->getMissionStatus().'</td>';
                echo '<td>'.$missionDetailed->getMissionPlanques().'</td>';
                echo '<td>'.$missionDetailed->getMissionSpeciality().'</td>';
                echo '<td>'.$missionDetailed->getMissionDateStart().'</td>';
                echo '<td>'.$missionDetailed->getMissionDateEnd().'</td>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    /*Verification du mot de passe et connexion accès à la page interface.php */
    public function connectionInterface(string $login, string $password) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM admins WHERE mail = :email');
            $pdoStatement->bindValue(':email', $login, PDO::PARAM_STR);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Admins');
            if($pdoStatement->execute()) {
                while($admin = $pdoStatement->fetch()) {
                    if(password_verify($password, $admin->getAdminPassword())){
                       session_start();
                       $_SESSION['admin'] = $admin->getAdminFirstName().' '.$admin->getAdminName();
                       header('Location: ../Vue/interface.php');
                    } else {
                        throw new Exception("Identifiants incorrects");
                    }
                }
    
            } else {
                echo "Identifiants incorrects";
            }
    
        } catch (PDOException $e) {
            echo 'Erreur SQL '.$e->getCode();
        }
    }

    /*Affichage des différentes tables à la page interface.php */
    public function displayAgents() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM agents');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Agents');
            if($pdoStatement->execute()) {
                while($agent = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$agent->getAgentCode().'</td>';
                    echo '<td>'.$agent->getAgentName().'</td>';
                    echo '<td>'.$agent->getAgentFirstName().'</td>';
                    echo '<td>'.$agent->getAgentDateBirth().'</td>';
                    echo '<td>'.$agent->getAgentNationality().'</td>';
                    echo '<td>'.$agent->getAgentSpecialities().'</td>';
                    echo '</tr>';
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function displayContacts() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM contacts');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Contacts');
            if($pdoStatement->execute()) {
                while( $contact = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$contact->getContactCodeName().'</td>';
                    echo '<td>'.$contact->getContactName().'</td>';
                    echo '<td>'.$contact->getContactFirstName().'</td>';
                    echo '<td>'.$contact->getContactDateBirth().'</td>';
                    echo '<td>'.$contact->getContactCodeNationality().'</td>';
                    echo '</tr>';
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function displayHideouts() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM hideouts');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Hideouts');
            if($pdoStatement->execute()) {
                while( $hideout = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$hideout->getHideoutCode().'</td>';
                    echo '<td>'.$hideout->getHideoutAddress().'</td>';
                    echo '<td>'.$hideout->getHideoutCountry().'</td>';
                    echo '<td>'.$hideout->getHideoutType().'</td>';
                    echo '</tr>';
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function displayTargets() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM targets');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Targets');
            if($pdoStatement->execute()) {
                while( $target = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$target->getTargetCode().'</td>';
                    echo '<td>'.$target->getTargetName().'</td>';
                    echo '<td>'.$target->getTargetFirstname().'</td>';
                    echo '<td>'.$target->getTargetDateBirth().'</td>';
                    echo '<td>'.$target->getTargetNationality().'</td>';
                    echo '</tr>';
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function displayMissionsInterface() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM missions ORDER BY dateStart');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Missions');
            if($pdoStatement->execute()) {
                while( $mission = $pdoStatement->fetch()) {
                    echo '<tr>';
                    echo '<td>'.$mission->getMissionCode().'</td>';
                    echo '<td>'.$mission->getMissionTitle().'</td>';
                    echo '<td>'.$mission->getMissionDescription().'</td>';
                    echo '<td>'.$mission->getMissionCountry().'</td>';
                    echo '<td>'.$mission->getMissionAgents().'</td>';
                    echo '<td>'.$mission->getMissionContacts().'</td>';
                    echo '<td>'.$mission->getMissionCibles().'</td>';
                    echo '<td>'.$mission->getMissionType().'</td>';
                    echo '<td>'.$mission->getMissionStatus().'</td>';
                    echo '<td>'.$mission->getMissionPlanques().'</td>';
                    echo '<td>'.$mission->getMissionSpeciality().'</td>';
                    echo '<td>'.$mission->getMissionDateStart().'</td>';
                    echo '<td>'.$mission->getMissionDateEnd().'</td>';
                    echo '</tr>';
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*Creation d'une mission via le formulaire de création à la page interface.php*/
    public function createMission(string $codeMission, string $titleMission, string $description, string $country, int $agents, string $contacts, string $targets, string $type, string $status, string $hideouts, string $speciality, string $dateStart, string $dateEnd) 
    {
        if( nonEmptyFields($codeMission, $titleMission, $description, $country, $agents, $contacts, $targets, $type, $status, $speciality, $dateStart, $dateEnd) ) {
            if(lengthFields($codeMission, $titleMission, $description, $country, $type, $status, $speciality)) {
                if (agentTargetNationalityComparison($agents, $targets)) {
                    if (verifyCountryMissionContactNationality($country, $contacts)) {
                        if (compareSpecialityRequiredAgent($agents, $speciality)) {
                            if (compareMissionCountryHideout($hideouts, $country)) {
                                try {
                                    $pdoStatement = $this->pdo->prepare('INSERT INTO missions VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        if(is_null($hideouts) || $hideouts === "") {
                                            $hideouts = null;
                                        }
                                    $pdoStatement->bindValue(1, noSpaces($codeMission), PDO::PARAM_STR);
                                    $pdoStatement->bindValue(2, $titleMission, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(3, $description, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(4, $country, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(5, $agents, PDO::PARAM_INT);
                                    $pdoStatement->bindValue(6, $contacts, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(7, $targets, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(8, $type, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(9, $status, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(10, $hideouts, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(11, $speciality, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(12, $dateStart, PDO::PARAM_STR);
                                    $pdoStatement->bindValue(13, $dateEnd, PDO::PARAM_STR);
                                    if($pdoStatement->execute()) {
                                        echo "Votre mission a bien été créée";
                                    } else {
                                        throw new Exception('Un erreur s\'est produite, veuillez réessayer');
                                    }
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }
                            } else {
                                throw new Exception('Le pays de la planque et le pays de la mission doivent être les mêmes');
                            }
                        } else {
                            throw new Exception('Un agent doit posseder la specialite requise pour la mission');
                        }
                    } else {
                        throw new Exception('La nationalité du contact et le pays de la mission doivent correspondre');
                    }
                } else {
                    throw new Exception('La nationalité de l\'agent et de la cible doivent être différents');
                }
            } else {
                throw new Exception('Un ou plusieurs champs depasse la limite de caractères autorisée');
            }
        } else {
            throw new Exception('Les champs obligatoires ne peuvent être vides');
        }
    }

    /*Modification d'une mission via le formulaire de modification à la page interface.php*/
    public function modifyMission(array $fields, string $code) {
        try{
            foreach($fields as $key => $value) {
                if(isset($value) && $value !== '') {
                    $pdoStatement = $this->pdo->prepare("UPDATE missions SET $key = :value WHERE code_mission = :code");
                    $pdoStatement->bindValue(':value', $value);
                    $pdoStatement->bindValue(':code', $code, PDO::PARAM_STR);
                    
                    if($pdoStatement->execute()) {
                        echo 'Les modifications ont bien étés envoyées<br>';
                    } else {
                        throw new Exception('Une erreur est survenue, veuillez réessayer');
                    }
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
    }

    /*Suppression d'une mission via le formulaire de modification à la page interface.php*/
    public function deleteMission(string $code) {
        try {
            $pdoStatement = $this->pdo->prepare('DELETE FROM missions WHERE code_mission = :code');
            $pdoStatement->bindValue(':code', $code, PDO::PARAM_STR);
            if($pdoStatement->execute()) {
                echo "Suppression réussie";
            } else {
                throw new Exception('Code de mission inexistant dans la base');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}