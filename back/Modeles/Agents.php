<?php

class Agents 
{
    private int $code_agent;
    private string $name;
    private string $firstname;
    private string $dateBirth;
    private string $nationality;
    private string $specialities;

    public function getAgentCode(): int
    {
        return $this->code_agent;
    }

    public function getAgentName(): string 
    {
        return $this->name;
    }

    public function getAgentFirstName(): string 
    {
        return $this->firstname;
    }

    public function getAgentDateBirth(): string 
    {
        return $this->dateBirth;
    }

    public function getAgentNationality(): string 
    {
        return $this->nationality;
    }

    public function getAgentSpecialities(): string 
    {
        return $this->specialities;
    }
}