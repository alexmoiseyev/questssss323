<?php
// ЗАДАНИЕ 3 //

class Vector
{
    private $elements;
    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }
    public function add(Vector $vector): Vector
    {
        if (count($this->elements) !== count($vector->elements))
        {
            echo "Векторы должны быть одинаковой длинп";
            exit;
        }

        $result = [];
        foreach ($this->elements as $key => $value)
        {
            $result[] = $value + $vector->elements[$key];
        }

        return new Vector($result);
    }
    // скаляр
    public function scalarMultiply(Vector $vector): float
    {
        if (count($this->elements) !== count($vector->elements))
        {
            echo "Векторы должны быть одинаковой длинп";
            exit;
        }

        $result = 0;
        foreach ($this->elements as $key => $value)
        {
            $result += $value * $vector->elements[$key];
        }

        return $result;
    }

    public static function getOne(int $n): Vector
    {
        return new Vector(array_fill(0, $n, 1));
    }

    public static function getZero(int $n): Vector
    {
        return new Vector(array_fill(0, $n, 0));
    }

    public function __toString(): string
    {
        return '(' . implode(', ', $this->elements) . ')';
    }
}
//test 

// 1)
$test = new Vector([1, 3, 5]);
echo $test . "<br>";

// 2) (1, 3, -5) + (4, -2, -1)0
$v1 = new Vector([1, 3, -5]);
$v2 = new Vector([4, -2, -1]);
$resultAdd = $v1->add($v2);
echo "1) " . $v1 . " + " . $v2 . " = " . $resultAdd . "<br>";


// 3) (1, 3, -5) * (4, -2, -1)
$resultScalar = $v1->scalarMultiply($v2);
echo "2) " . $v1 . " * " . $v2 . " = " . $resultScalar . "<br>";

// 4) 

$oneVector = Vector::getOne(3);
echo "Единичныц вектор: " . $oneVector . "<br>";
$zeroVector = Vector::getZero(3);
echo "Нулевой вектор: " . $zeroVector . "<br>";
