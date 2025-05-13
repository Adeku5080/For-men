<?php

if (! function_exists('generateSku')) {

    function generateSku($product_name, $color)
    {
        $nameArray = explode(' ', $product_name);

        $substrArray = [];

        foreach ($nameArray as $ele) {
            $substrArray[] = substr($ele, 0, 3);
        }

        $sku = implode('-', $substrArray);

        $color = strtoupper(trim($color));

        $finalSku = strtoupper($sku.'-'.$color);

        return $finalSku;
    }
}
