<?php

class Hideouts 
{
    private string $code_hideout;
    private string $address;
    private string $country;
    private string $type;

    public function getHideoutCode(): string 
    {
        return $this->code_hideout;
    }

    public function getHideoutAddress(): string 
    {
        return $this->address;
    }

    public function getHideoutCountry(): string 
    {
        return $this->country;
    }

    public function getHideoutType(): string 
    {
        return $this->type;
    }
}