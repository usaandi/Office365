<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['client_name'];

    public static function getClientsNames()
    {
        return Client::get(['client_name']);
    }

    public static function getClientObjectByName($clientName)
    {
        return $client = Client::where('client_name', $clientName)->first();

    }

    public static function createClient($clientName)
    {
       return $client = Client::create(['client_name' => $clientName]);
    }
}
