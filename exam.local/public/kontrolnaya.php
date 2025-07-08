<?php
// ЗАДАЧА 1 - Цезарь//
echo "ЗАДАЧА 1 - Цезарь<br>";
function ceasar_cipher($text, $shift)
{
    for ($i = 0; $i < strlen($text); $i++)
    {
        $char = iconv('CP1251', 'UTF-8', $text[$i]);
        $char = chr(ord($char) + $shift); // функции chr и ord можно использовать?
        echo $char;
    }
}
ceasar_cipher(("An algorithm is a finite sequence of well-defined instructions, typically used to solve a class of specific problems or to perform a computation."), 3); //шифруем английским алфавитом
echo '<br>';

// ЗАДАЧА 2 - Нормализация телефоного номера//
echo "<br>ЗАДАЧА 2 - Нормализация телефоного номера<br>";
function normalize_phones_number($phones_numbers)
{
    $numbers = explode(";", $phones_numbers);
    foreach ($numbers as $number)
    {
        $number = trim(preg_replace('/(.) /', '\\1', $number)) . "<br>";
        $number = str_replace('+7', '8', $number);
        $number = str_replace([' ', '(', ')', '-'], '', $number);
        if ($number[0] !== 8)
        {
            $number[0] = "8";
        }
        $number = substr($number, 0, 11);
        $phones[] =  $number;
    }
    array_pop($phones);
    return $phones;
}
$str = "8 ( 123) 456-5678;89123456789;+ 7 (495)-122-45-78;+79101234567;8 573 932 09 87; +7 495 123-45-67; 8(111) 222-33-44;";
echo "<pre>";
var_export(normalize_phones_number($str));
echo "</pre>";

// ЗАДАЧА 3 - Привести номер к виду 8 (123) 456-78-90//
echo "ЗАДАЧА 3 - Привести номер к виду 8 (123) 456-78-90<br>";
$str = "81234565678;
        89123456789;
        84951224578;
        79101234567;
        85739320987;
        74951234567;
        81112223344;";

function formatPhone($str)
{
    foreach (normalize_phones_number($str) as $number)
    {
        echo $number = sprintf(
            '%s (%s) %s-%s-%s',
            substr($number, 0, 1),
            substr($number, 1, 3),
            substr($number, 4, 3),
            substr($number, 7, 2),
            substr($number, 9, 2),
        );
        echo "<br>";
    }
    return $number;
}


echo "<pre>";
formatPhone($str);
echo "</pre>";


// ЗАДАЧА 4 - Дан текст//
echo "<br>ЗАДАЧА 4 - Дан текст: <br>";
$text = " Алгоритм — конечная совокупность точно заданных правил решения некоторого класса задач или набор инструкций, описывающих порядок действий исполнителя для решения определённой задачи. В старой трактовке вместо слова «порядок» использовалось слово «последовательность», но по мере развития параллельности в работе компьютеров слово «последовательность» стали заменять более общим словом «порядок». Независимые инструкции могут выполняться в произвольном порядке, параллельно, если это позволяют используемые исполнители.";
function sortText($text)
{
    $words = explode(" ", $text);

    for ($i = 0; $i < count($words); $i++)
    {
        $words[$i] = mb_strtolower($words[$i]);
    }
    sort($words, SORT_STRING);
    $words = array_unique($words);
    echo "<pre>";
    var_export($words);
    echo "</pre>";
    return $words;
}
function replacePunctuation($text)
{
    return trim(str_replace(['»', '«', ',', '.', '!', '?', ';', ':', '(', ')', '— ',], '', $text));
}

$newText = replacePunctuation($text);

sortText($newText);


// ЗАДАЧА 5 - Пусть дан массив, элементами которого являются массивы целых чисел//
echo "<br>ЗАДАЧА 5 - Пусть дан массив, элементами которого являются массивы целых чисел: <br>";
$arArrayOfArrays = [
    [1, -5, -128],
    [-8, 9],
    [0],
    [1, 0, -1]
];
foreach ($arArrayOfArrays as $array)
{
    echo "<pre>";
    var_export($array);
    echo "</pre>";
    echo " Максимальный элемент: " . max($array) . "<br>";
    $maxNumbers[] = max($array);
}
echo "<br>";
echo "Максимальные элементы:<pre>";
var_export($maxNumbers);
echo "</pre>";
echo "Сумма максимальных элементов: " . array_sum($maxNumbers);

// ЗАДАЧА 6 - Дан текст//
echo "<br>ЗАДАЧА 6 - Дан текст: <br>";
$text = "    TEST Алгоритм — конечная совокупность точно заданных правил решения некоторого класса задач или набор инструкций, описывающих порядок действий исполнителя для решения определённой задачи.  TEST В старой трактовке вместо слова «порядок» использовалось слово «последовательность», но по мере развития параллельности в работе компьютеров слово «последовательность» стали заменять более общим словом «порядок». TEST Независимые инструкции могут выполняться в произвольном порядке, параллельно, если это позволяют используемые исполнители.";
$count = 0;
$words = explode(" ", $text);
for ($i = 0; $i < count($words); $i++)
{

    if ($words[$i] == "TEST" && $count == 0)
    {
        unset($words[$i]);
        $words = array_values($words);
        $count++;
    }
    if ($words[$i] == "TEST" && $count == 1)
    {
        $words[$i] = "11111";
        $count++;
    }
    if ($words[$i] == "TEST" && $count == 2)
    {
        $words[$i] = "22222";
    }
}

echo "<pre>";
var_export($words);
echo "</pre>";
