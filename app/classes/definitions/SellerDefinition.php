<?php
class SellerDefinition extends Definition
{
    public static function getDefinition()
    {
        $definition = array();
        $users = User::all();
        foreach ($users as $user) {
            $definition[$user->id] = $user->nombre_usuario;
        }
        return $definition;
    }
}