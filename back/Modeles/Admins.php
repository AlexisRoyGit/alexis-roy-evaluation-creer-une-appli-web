<?php

class Admins
{
    private string $id_admin;
    private string $name;
    private string $firstname;
    private string $mail;
    private string $password;
    private string $dateCreation;

    public function getAdminId(): string 
    {
        return $this->id_admin;
    }

    public function getAdminName(): string 
    {
        return $this->name;
    }

    public function getAdminFirstName(): string 
    {
        return $this->firstname;
    }

    public function getAdminMail(): string 
    {
        return $this->mail;
    }

    public function getAdminPassword(): string 
    {
        return $this->password;
    }

    public function getAdminDateCreation(): string 
    {
        return $this->dateCreation;
    }
}