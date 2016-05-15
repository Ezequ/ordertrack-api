<?php
class ProductsPricesDefinition extends Definition
{
    public static function getDefinition()
    {
        $definition = array();
        $products = Product::all();
        foreach ($products as $product) {
            $definition[$product->precio] = "$" . PriceHelper::getPrice($product->precio);
        }
        return $definition;
    }
}