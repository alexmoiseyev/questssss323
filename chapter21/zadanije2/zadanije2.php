<?php
// ЗАДАНИЕ 2 //
function logScriptShutdown() {
    $logFile = __DIR__ . '/visits_log.txt';
    
    $logData = date('Y-m-d H:i:s') . PHP_EOL;
    
    $result=file_put_contents($logFile, $logData, FILE_APPEND | LOCK_EX);
    if ($result === false) {
        echo 'не удлось записать в файл visits_log.txt';
    }
}

register_shutdown_function('logScriptShutdown');


$logFile = __DIR__ . '/visits_log.txt';

if (!file_exists($logFile)) {
    file_put_contents($logFile, '');
    chmod($logFile, 0666); 
}

echo "Скрипт начал выполнение...<br>";


die("Скрипт прерван");