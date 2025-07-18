<?php
// ЗАДАНИЕ 1//
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');
error_reporting(E_ALL);
?>


<?php
abstract class MathElement {
    abstract public function add($x);
    abstract public function toString();
}

class Polynom extends MathElement {
    public $pows;
    public $coeffs;

    public function __construct($pows, $coeffs) {
        $this->pows = $pows;
        $this->coeffs = $coeffs;
    }

    public function add($x) {
        if (!($x instanceof MathElement)) {
            die("Невозможно выполнить сложение.");
        }

        if ($x instanceof Polynom) {
            $allPows = array_unique(array_merge($this->pows, $x->pows));
            rsort($allPows);

            $resultCoeffs = [];
            foreach ($allPows as $pow) {
                $coeff1 = $this->getCoeffForPow($pow);
                $coeff2 = $x->getCoeffForPow($pow);
                $resultCoeffs[] = $coeff1->add($coeff2);
            }

            return new Polynom($allPows, $resultCoeffs);
        } else {
            $newCoeffs = $this->coeffs;
            $lastIndex = count($newCoeffs) - 1;
            $newCoeffs[$lastIndex] = $newCoeffs[$lastIndex]->add($x);
            return new Polynom($this->pows, $newCoeffs);
        }
    }

    private function getCoeffForPow($pow) {
        $index = array_search($pow, $this->pows);
        if ($index !== false) {
            return $this->coeffs[$index];
        }
        return new RealNumber(0);
    }

    public function toString() {
        $terms = [];
        for ($i = 0; $i < count($this->pows); $i++) {
            $pow = $this->pows[$i];
            $coeff = $this->coeffs[$i]->toString();

            if ($pow == 0) {
                $terms[] = $coeff;
            } else {
                $terms[] = "(" . $coeff . ")" . ($pow > 1 ? "x^" . $pow : "x");
            }
        }
        return implode(" + ", $terms);
    }
}

class Complex extends MathElement {
    public $IM;
    public $RE;

    public function __construct($IM, $RE) {
        $this->IM = $IM;
        $this->RE = $RE;
    }

    public function add($x) {
        if (!($x instanceof MathElement)) {
            die("Невозможно выполнить сложение");
        }

        if ($x instanceof Complex) {
            return new Complex($this->IM + $x->IM, $this->RE + $x->RE);
        } elseif ($x instanceof RealNumber) {
            return new Complex($this->IM, $this->RE + $x->value);
        } else {
            $temp = new Complex($this->IM, $this->RE);
            return $temp->add($x);
        }
    }

    public function toString() {
        return $this->IM . "i + " . $this->RE;
    }
}

class RealNumber extends MathElement {
    public $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function add($x) {
        if (!($x instanceof MathElement)) {
            die("Невозможно выполнить сложение");
        }

        if ($x instanceof RealNumber) {
            return new RealNumber($this->value + $x->value);
        } else {
            return $x->add($this);
        }
    }

    public function toString() {
        return $this->value;
    }
}

// pol1 = 23x^2 + (9i - 1)x + 8
$pol1 = new Polynom(
    [2, 1, 0],
    [
        new RealNumber(23),
        new Complex(9, -1),
        new RealNumber(8)
    ]
);

// pol2 = (4i + 2)x^2 + 9x
$pol2 = new Polynom(
    [2, 1],
    [
        new Complex(4, 2),
        new RealNumber(9)
    ]
);

// complex = 13i + 98
$complex = new Complex(13, 98);

// pol1 + pol2 + complex
$result = $pol1->add($pol2)->add($complex);

echo $result->toString1(); // ошибка 
// echo $result->toString();
?>
