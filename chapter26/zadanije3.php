<?php
// ЗАДАНИЕ 3 //
function errorFunc1($err, $errstr) {
    echo "Обработчик errorFunc1: $errstr<br>";
}

function errorFunc2($err, $errstr) {
    echo "Обработчик errorFunc2: $errstr<br>";
}
set_error_handler("errorFunc2");
set_error_handler("errorFunc1");


trigger_error("первач ошибка");
restore_error_handler();


trigger_error("вторая ошибка");
restore_error_handler();


trigger_error("третья ошибка");

