<?php
// ЗАДАНИЕ 1: //
$sFirstString ='привет';
$sSecondString = 'мир';
$sConcatenatedString = $sFirstString . ' ' . $sSecondString;
echo $sConcatenatedString . '<br>';

// ЗАДАНИЕ 2: //
    //Вывести на экран фразу: на складе осталось 5 товаров:
    $iFive = 5;
    echo "на складе осталось $iFive товаров<br>";
    //Вывести на экран строку, в которой текст переносится на новую строку при помощи спецсимволов:
    echo "<pre>";
    echo "Перевод на \n новую строку";
    echo "</pre><br>";

// ЗАДАНИЕ 3: //
$iAnyIntegerNumber = 6;
echo $iAnyIntegerNumber === 0 ? "число равно нулю":"число не равно нулю";