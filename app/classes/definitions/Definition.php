<?php
class Definition
{

    public static function convertObjectFieldToDefinition($object, $field)
    {
        $called = get_called_class();
        $definition = $called::getDefinition();
        if (isset($definition[$object->$field])){
            $object->$field = $definition[$object->$field];
        } else {
            $object->$field = "";
        }
        return $object;
    }

    public static function convertObjectListFieldToDefinition($list, $field)
    {
        foreach ($list as $index => $item) {
            $item = self::convertObjectFieldToDefinition($item, $field);
            $list[$index] = $item;
        }
        return $list;
    }

    public static function getIdByName($name)
    {
        $called = get_called_class();
        $definition = $called::getDefinition();
        foreach ($definition as $index => $item) {
            if($item == $name)
                return $index;
        }
        return null;
    }

    public static function getNameById($id)
    {
        $called = get_called_class();
        $definition = $called::getDefinition();
        if (isset($definition[$id])){
            return $definition[$id];
        } else {
            return "";
        }
    }

}