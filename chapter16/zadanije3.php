<?php
$scriptName = pathinfo(__FILE__, PATHINFO_FILENAME);
echo "Имя скрипта: $scriptName<br>";

$dir = dirname(__FILE__);
echo "Директория: $dir<br>";
