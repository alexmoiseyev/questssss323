<?php
// ЗАДАНИЕ 1 // 
    function calc(float $a, float $b, float &$c):float{
        $c = $a + $b;
        return $a * $b;
    }
    $num1 = 1.3;
    $num2 = 2.5;
    $sum = 0.0;
    $result = calc($num1,$num2,$sum);
    echo $result . "<br>";
    echo $sum . "<br>";

// ЗАДАНИЕ 2 // 

$iGlobalPositiveNumber = 4;
function sum(){
    global $iGlobalPositiveNumber;
    $sum = 0;
    for ($i = 1; $i <= $iGlobalPositiveNumber; $i++) {
        $sum += $i;
    }
    
    return $sum;
}
$resultSum = sum();
echo "Сумма чисел от 1 до $iGlobalPositiveNumber = $resultSum <br>";

// ЗАДАНИЕ 3 // 

function getNext(): string {
    static $index = 0;  
    $testArray = ["test1", "test2", "test3", "test4", "test5"];
    
    $currentItem = $testArray[$index];
    $index = ($index + 1) % count($testArray);  
    
    return $currentItem;
}
echo getNext() . "<br>";  
echo getNext() . "<br>";   
echo getNext() . "<br>";   
echo getNext() . "<br>";   
echo getNext() . "<br>";   
echo getNext() . "<br>";   
echo getNext() . "<br>"; 

// ЗАДАНИЕ 4 // 

function recursion(int $iNumber):int{
     if ($iNumber <= 0) {
        return 0;
    }
    return $iNumber + recursion($iNumber - 1);
}   
$result = recursion(4);
echo "Сумма чисел от 1 до 4 = $result\n"; 