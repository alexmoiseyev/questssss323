<?php
// ЗАДАНИЕ 1 //
function printNumber($iNumber) {
    echo $iNumber;
}
function printSpace() {
    echo " ";
}

function printThreeDigitNumber($a, $b, $c) {
    ob_start();
    printNumber($a); printNumber($b); printNumber($c);
    return ob_get_clean();
}

$num404 = printThreeDigitNumber(4, 0, 4);
$num131 = printThreeDigitNumber(1, 3, 1);
$num789 = printThreeDigitNumber(7, 8, 9);
$num061 = printThreeDigitNumber(0, 6, 1);

function printPattern($numA, $numB) {
    ob_start();
    echo $numA; printSpace();
    echo $numB; printSpace();
    echo $numB; printSpace();
    echo $numA; printSpace();
    return ob_get_clean();
}

$block404131 = printPattern($num404, $num131);
$block789061 = printPattern($num789, $num061);

ob_start();
echo $block404131;       
echo $block789061;       
echo $block789061;       
echo $block404131;      
echo $block404131;       
echo $block789061;       
echo $block789061;       
echo $block404131;       

$result = rtrim(ob_get_clean());
echo $result;
