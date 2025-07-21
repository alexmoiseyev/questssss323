<?php
// ЗАДАНИЕ 1 //
    if (headers_sent($fname, $line)) {
        echo "заголовки отправлены в файле $fname на строке $line";
    } 
    else {
        header('Content-Type: application/json');
        echo 'заголовки не отправлены';
    }


