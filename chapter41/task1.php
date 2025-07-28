<?php 
// ЗАДАНИЕ 1 //
## Подключение автозагрузчика
 require_once('/vendor/autoload.php');
 # Теперь можно использовать компонент Monolog
 $log = new Monolog\Logger('name');
 $handler = new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING);
 $log->pushHandler($handler);
 $log->warning('Предупреждение');
