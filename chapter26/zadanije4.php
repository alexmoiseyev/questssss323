<?php
// ЗАДАНИЕ 4 //
class RecursionException extends Exception {
    public function __construct() {
        parent::__construct("Рекурсия сломалась!");
    }
}

function factorial($n) {
    if ($n === 1) {
        throw new RecursionException();
    }
    
    if ($n <= 1) {
        return 1;
    }
    
    return $n * factorial($n - 1);
}

try {
    $result = factorial(5);
    echo "Факториал равен: " . $result . "<br>";
} catch (RecursionException $e) {
    echo "Объект исключении:<br>";
    var_dump($e);
    echo "<br>";
    echo "Стек вызовов:<br>";
    print_r($e->getTrace());
    echo "<br>";
    
    echo "Искючение выброшено в файле: " . $e->getFile() . "<br>";
    echo "На строке: " . $e->getLine() . "<br>";
}
?>