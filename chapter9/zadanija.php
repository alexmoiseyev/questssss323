
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>zad1</title>
</head>
<body>
    <div class="container mt-5">
        <form action="#">
            <div class="mb3">
                <label for="text">test</label>
                <input class="form-control" type="text" name="string">
            </div>
            <input class="form-submit btn btn-primary mt-4" type="submit">
        </form>
    </div>
</body>
</html>
<?php
// ЗАДАНИЕ 1 //
if (isset($_GET['string'])) {
    $input = $_GET['string'];
    
    switch ($input) {
        case 'test1':
            echo 1;
            break;
        case 'test2':
            echo 2;
            break;
        case 'test5':
            echo 3;
            break;
        default:
            echo 4;
    }
} else {
    echo 4;
}
echo '<br><br><br>';


?>
<?php
// ЗАДАНИЕ 2 //
echo "подключаем файл при помощи require: <br><br><br>";
for($i=0;$i<10;$i++){
    require 'include.php';
}

echo "подключаем файл при помощи require_once: <br><br><br>";
for($i=0;$i<10;$i++){
    require_once 'include.php';// ничего не выведет, так как скрипт уже подключен выше require
}
?>
<?php
$arr = array();
for ($i = 0; $i < 5; $i++) {
    $arr[] = rand(5, 15);
}
$iSumOfNumbers = 0;
foreach($arr as $index=>$value){
    if($value == 15){
        echo "В массиве найдено число 15<br>";
        break;
    }
    elseif($value < 8){
        echo "Найдено число меньше 8<br>";
        break;
    }
    else{
        $iSumOfNumbers += $value;
    }
}
echo "<br><pre>";
print_r($arr);
echo "</pre><br>";
echo $iSumOfNumbers ;
?>