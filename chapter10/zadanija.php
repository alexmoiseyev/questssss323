<?php
// ЗАДАНИЕ 1 // 
    foreach($_SERVER as $key => $value){
        echo $key. '<br>';
    }
    echo "<br><br>";
// ЗАДАНИЕ 2 //
    $arArrayOfArrays = [
        [1, -2, 0, 3],
        [-2, 5, -7],
        [3],
        [0, 0, -1]
    ];

    usort($arArrayOfArrays, function($a, $b) {
        $sumA = array_sum($a);
        $sumB = array_sum($b);
        return $sumA <=> $sumB;
    });
    echo "<pre>";
    print_r($arArrayOfArrays);
    echo "</pre><br><br>";

// ЗАДАНИЕ 3 //
    $string = "5;59;1;aa;3;ab;31;3;;;ccccc;0";

    $parts = explode(';', $string);

    $numbers = array_filter($parts, function($item) {
        return is_numeric($item) && $item !== '';
    });

    $resultString = implode(';', $numbers);

    echo $resultString;
    echo '<br><br>';

// ЗАДАНИЕ 4 //
    $stringServer = serialize($_SERVER);
    echo $stringServer;
    $arrayServer = unserialize($stringServer);
    echo "<pre>";
    print_r($arrayServer);
    echo "</pre><br><br>";