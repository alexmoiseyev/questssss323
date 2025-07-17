<?php



define('DIR', __DIR__);

function loadLibrary1($className)
{
    if (strpos($className, 'library1\tools\LIB1') === 0) {
        $classFile = str_replace('library1\tools\\', '', $className);
        $path = DIR . "/library1/src/tools/{$classFile}.php";
        
        if (file_exists($path)) {
            require_once($path);
        }
    }
}


function loadLibrary2($className)
{
    if ($className === 'library2\LIB2Test3') {
        require_once(DIR . '/library2/LIB2Test3.php');
    }
}

function loadLibrary3($className)
{
    if ($className === 'library3\main\LIB3Test4') {
        require_once(DIR . '/additional_libraries/library3/classes/main/LIB3Test4.php');
    }
}

spl_autoload_register('loadLibrary1');
spl_autoload_register('loadLibrary2');
spl_autoload_register('loadLibrary3');


$lib1Test1 = new \library1\tools\LIB1Test1();
$lib1Test2 = new \library1\tools\LIB1Test2();
$lib2Test3 = new \library2\LIB2Test3();
$lib3Test4 = new \library3\main\LIB3Test4();

$lib1Test1->print();
$lib1Test2->print();
$lib2Test3->print();
$lib3Test4->print();