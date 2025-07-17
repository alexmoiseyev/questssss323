<?php
require_once 'vedita/printStr.php';
require_once 'vedita/functions/math/Arithmetic.php';

use function vedita\printStr;
use vedita\functions\math\Arithmetic;


printStr("метод из printStr использован<br>");

$x=25;$y=8;
$result = Arithmetic::add($x, $y);
echo "$x+$y=".$result . "<br>";