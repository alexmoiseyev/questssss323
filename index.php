<?php
// ЗАДАНИЕ 1: //
    $arr = [27,12.5,"Строка",[3,2,4,2],true];
        //откладка print_r
        echo "<pre>";
        print_r($arr);
        echo "</pre>";

        echo "<br>";

        //откладка var_dump
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";

        //откладка var_export
        echo "<pre>";
        var_export($arr);
        echo "</pre>";
// ЗАДАНИЕ 2: //
    // Присвоить переменной $variable любое значение. Проверить существует ли она. Уничтожить ее и снова проверить существует ли она.
    $variable=20;
    echo isset($variable) ? '$variable существует<br>' : '$variable не существует<br>';
    unset($variable);
    echo isset($variable) ? '$variable существует<br>' : '$variable не существует<br>';
    // Присвоить константе CONSTANT любое значение и вывести ее содержимое на экран.
    define('CONSTANT', 20);
    echo CONSTANT . "<br>";
    echo defined('CONSTANT') ? 'константа CONSTANT определена<br>' : 'константа CONSTANT не определена<br>';
    echo defined('NOT_DEFINED_CONSTANT') ? 'константа NOT_DEFINED_CONSTANT определена<br>' : 'константа NOT_DEFINED_CONSTANT не определена<br>';
// ЗАДАНИЕ 3: //
    $sTwentyFiveWithSpace = "25 ";
    $dEightPointTwentyFiveHundredths = 8.25;
    $sEmptyString = "";
    $bFalse = false;
    $iZero = 0;
    //1:
    var_dump((bool)$sTwentyFiveWithSpace);    
    var_dump((bool)$dEightPointTwentyFiveHundredths); 
    var_dump((bool)$sEmptyString);           
    var_dump((bool)$bFalse);                 
    var_dump((bool)$iZero);       
    //2:   
    echo '<br>';       
    var_dump((int)$dEightPointTwentyFiveHundredths);  
    echo '<br>';  
// ЗАДАНИЕ 4: //
    $iTwentyFive = 25;
    $iHardLinkToAnotherVariable = &$iTwentyFive;
    $iHardLinkToAnotherVariable = 100;
    echo $iTwentyFive . "<br>";
    echo $iHardLinkToAnotherVariable . "<br>";