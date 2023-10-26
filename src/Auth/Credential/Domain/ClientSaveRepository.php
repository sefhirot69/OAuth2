<?php

namespace App\Auth\Credential\Domain;

interface ClientSaveRepository
{
    public function save(Client $client): void;
}
