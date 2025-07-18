<?php
// ЗАДАНИЕ 2 //
function factorial($n) {
    if ($n === 1) {
        echo "Стек вызовов при n = 1:<br>";
        echo "<pre>";
        debug_print_backtrace();
        echo "</pre>";
        echo "<br>";
    }
    
    if ($n <= 1) {
        return 1;
    }
    
    return $n * factorial($n - 1);
}
$number = 5;
$result = factorial($number);
echo "Факториал числа $number равены $result<br>";
