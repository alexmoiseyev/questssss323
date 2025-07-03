<?php 
// ЗАДАНИЕ 1 // 
    //1)
    $arr = $_SERVER;
    foreach($arr as $key => $value){
        echo $key . "<br>";
    }
    //2)
    foreach($arr as $value){
        echo $value . "<br>";
    }
// ЗАДАНИЕ 2 //
    //1)
    $arr1 = array();
    $arr2 = array();
    for ($i = 0; $i < 10; $i++) {
        $arr1[] = rand(5, 15);
        $arr2[] = rand(5, 15);
    }
    var_dump($arr1);
    echo "<br>";
    var_dump($arr2);
    echo "<br>";
    
    //2)
    $arr3= array_merge($arr1, $arr2);
    var_dump($arr3);
    echo "<br>";
    if(in_array(7, $arr3)){
        echo "в массиве содержится число 7";
    }else{
        echo "не найдено число 7";
    }
    echo "<br>";

    array_splice($arr3, 4, 11);

    var_dump($arr3);