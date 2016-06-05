<?php
class ProductsCategoryDefinition extends Definition
{
    public static function getDefinition()
    {
        $definition = array();
        $categories = Category::all();
        foreach ($categories as $category) {
            $definition[$category->id] = $category->nombre;
        }
        return $definition;
    }
}