<?php
class PriceHelper {
    public static function getPrice($price)
    {
       return number_format((float)$price, 2, ',', '.');
    }
}