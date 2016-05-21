<?php
class SellerDefinition extends Definition
{
    public static function getDefinition()
    {
        $definition = array();
        $users = User::where('rol',RolsDefinition::SELLER)->get();
        foreach ($users as $user) {
            $definition[$user->id] = $user->nombre_usuario;
        }
        return $definition;
    }
}