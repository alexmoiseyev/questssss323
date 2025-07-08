<?php

//  ЗАДАНИЕ 1 // 
$number = mt_rand(0, mt_getrandmax()) / mt_getrandmax();

echo "Случайное число: " . $number . "<br>";
echo "Целая часть: " . (int)$number . "<br>";
echo "Округленное в большую сторону: " . ceil($number) . "<br>";

//  ЗАДАНИЕ 2 // 

    // 1)Конвертация 321 в двоичную и троичную системы
    $num = 321;
    echo "321 в двоичной: " . decbin($num) . "<br>";
    echo "321 в троичной: " . base_convert($num, 10, 3) . "<br>";

    // 2)Конвертация 987 из 16-ричной в десятичную
    $num = '987';
    echo "987 из 16-ричной в десятичную: " . hexdec($num) . "<br>";

// ЗАДАНИЕ 3 //

$numbers = [];
for ($i = 0; $i < 10; $i++) {
    $numbers[] = mt_rand(1, 1000);
}
$min = min($numbers);
$max = max($numbers);

echo "Массив: " . implode(', ', $numbers) . "<br>";
echo "Минимальное значение: $min<br>";
echo "Максимальное значение: $max<br>";


// ЗАДАНИЕ 4 //

    // 1) ln(0)
    $ln0 = log(0);
    echo "ln(0): " . $ln0 . "<br>";
    echo "-Infinity? " . (is_infinite($ln0) ? 'Да' : 'Нет') . "<br>";
    echo "NaN? " . (is_nan($ln0) ? 'Да' : 'Нет') . "<br>";

    // 2) log(0) + log(-1)
    $result = log(0) + log(-1);
    echo "log(0) + log(-1): " . $result . "<br>";
    echo "NaN? " . (is_nan($result) ? 'Да' : 'Нет') . "<br>";

// ЗАДАНИЕ 5 //
function calculate($x) {
    return pow(sin(M_PI * $x * exp(pow($x, 2))), 2) - (1/2) * sqrt($x);
}

$xArr = [0, 0.5, 0.7];
$sum = 0;

foreach ($xArr as $x) {
    $sum += calculate($x);
}

echo "Сумма значений функции: " . $sum . "<br>";