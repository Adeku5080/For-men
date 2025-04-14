<?php

if (!function_exists('generateSku')) {

    function generateSku($product_name, $color, $size)
    {
        $nameArray = explode(" ", $product_name);

        $nameArray = ['el1','ele2', 'ele3' ];

       $substrArray = [];

        foreach($nameArray as $ele) 
        {
         $substrArray[] = substr($ele, 0 ,3);
        }
        
        $sku = implode("-" ,$substrArray);

        $color = strtoupper(trim($color));
        $size = strtoupper(trim($size));

        $finalSku = strtoupper($sku . "-" . $color . "-" . $size);

        return $finalSku;
    }
}
