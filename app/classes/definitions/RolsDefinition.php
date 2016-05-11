<?php
class RolsDefinition extends Definition
{


    const SELLER = '1';

    const ADMIN = '2';

    public static function getDefinition()
    {
        return array(
          self::SELLER => 'Vendedor',
          self::ADMIN => 'Administrador'
        );
    }

}