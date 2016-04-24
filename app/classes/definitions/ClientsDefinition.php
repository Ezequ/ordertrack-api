<?php
class ClientsDefinition extends Definition
{
    public static function getDefinition()
    {
        $clients = Client::all();
    }
}