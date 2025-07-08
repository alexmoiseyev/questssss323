<?php
$filename = 'public_html/1.txt';


$file = fopen($filename, 'r+');
fseek($file, 64);
$threeChars = fread($file, 3);
echo "Три символа: $threeChars<br>";
echo file_get_contents('public_html/1.txt');
fseek($file, 8);
fwrite($file, '123 test string 321');

fclose($file);