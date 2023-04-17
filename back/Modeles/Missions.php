<?php

class Missions 
{
    private string $code_mission;
    private string $title;
    private string $description;
    private string $country;
    private int $agents;
    private string $contacts;
    private string $targets;
    private string $missionType;
    private string $status;
    private ?string $hideouts;
    private string $specialityRequired;
    private string $dateStart;
    private string $dateEnd;

    public function getMissionCode() :string
    {
        return $this->code_mission;
    }

    public function getMissionTitle() :string 
    {
        return $this->title;
    }

    public function getMissionDescription() :string 
    {
        return $this->description;
    }

    public function getMissionCountry() :string 
    {
        return $this->country;
    }

    public function getMissionAgents() :int 
    {
        return $this->agents;
    }

    public function getMissionContacts() :string
    {
        return $this->contacts;
    }

    public function getMissionCibles() :string 
    {
        return $this->targets;
    }

    public function getMissionType() :string 
    {
        return $this->missionType;
    }

    public function getMissionStatus() :string 
    {
        return $this->status;
    }

    public function getMissionPlanques() :?string 
    {
        $hideout = $this->hideouts;
        if(is_null($hideout)) {
            return 'Aucune planque';
        } else {
            return $this->hideouts;
        } 
    }

    public function getMissionSpeciality() :string 
    {
        return $this->specialityRequired;
    }

    public function getMissionDateStart() :string 
    {
        return $this->dateStart;
    }

    public function getMissionDateEnd() :string 
    {
        return $this->dateEnd;
    }
}
