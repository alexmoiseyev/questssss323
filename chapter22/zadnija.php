<?php
// ЗАДАНИЕ //
class Rectangle {
    private $length;
    private $width;

    public function __construct($length = 2, $width = 1) {
        $this->length = $length;
        $this->width = $width;
    }

    public function getArea() {
        return $this->length * $this->width;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function __toString() {
        return "Прямоугольник с длиной ". " $this->length " . " и шириной " . " $this->width " ;
    }
}

$obFirstRectangleVariable = new Rectangle(5, 3);
$obSecondRectangleVariable = $obFirstRectangleVariable; 
$obThirdRectangleVariable = clone $obFirstRectangleVariable; 

$obFirstRectangleVariable->setLength(7);
$obThirdRectangleVariable->setLength(8);

echo $obFirstRectangleVariable . "<br>";
echo $obSecondRectangleVariable . "<br>";
echo $obThirdRectangleVariable . "<br>";

