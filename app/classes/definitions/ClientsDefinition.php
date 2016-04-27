<?php
class ClientsDefinition extends Definition
{
    public static function getDefinition()
    {
        $definition = array();
        $clients = Client::all();
        foreach ($clients as $client) {
            $definition[$client->id] = $client->razon_social;
        }
        return $definition;
    }
}