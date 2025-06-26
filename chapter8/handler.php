<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $_GET['checkbox'] = isset($_GET['checkbox']) ? $_GET['checkbox'] : '111';
    echo "GET checkbox=".$_GET['checkbox']."<br>";
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST['checkbox'] = isset($_POST['checkbox']) ? $_POST['checkbox'] : '111';
    echo "POST checkbox=".$_POST['checkbox'] ."<br>";
}
echo '<br>';
echo 'GET массив: ';
echo "<pre>";
var_dump($_GET);
echo "</pre>";
echo '<br>';
echo 'POST массив: ';
echo "<pre>";
var_dump($_POST);
echo "</pre>";