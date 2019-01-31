<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['client_name'];

    public static function getClientsName()
    {
        return Client::get(['client_name']);
    }

    public static function getClientId($clientName)
    {
         client::where('client_name', $clientName)->first();
    }

    public static function createClient($clientName)
    {
        $a = $clientName;
    }
}
