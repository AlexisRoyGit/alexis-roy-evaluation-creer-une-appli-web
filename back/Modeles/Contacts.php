<?php

class Contacts 
{
    private string $codeName;
    private string $name;
    private string $firstname;
    private string $dateBirth;
    private string $nationality;

    
    public function getContactCodeName(): string 
    {
        return $this->codeName;
    }

    public function getContactName(): string 
    {
        return $this->name;
    }

    public function getContactFirstName(): string 
    {
        return $this->firstname;
    }

    public function getContactDateBirth(): string 
    {
        return $this->dateBirth;
    }

    public function getContactCodeNationality(): string 
    {
        return $this->nationality;
    }
}