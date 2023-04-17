<?php 

class Targets 
{
    private string $code_target;
    private string $name;
    private string $firstname;
    private string $dateBirth;
    private string $nationality;

    public function getTargetCode(): string 
    {
        return $this->code_target;
    }

    public function getTargetName(): string 
    {
        return $this->name;
    }

    public function getTargetFirstname(): string 
    {
        return $this->firstname;
    }

    public function getTargetDateBirth(): string 
    {
        return $this->dateBirth;
    }

    public function getTargetNationality(): string 
    {
        return $this->nationality;
    }
}