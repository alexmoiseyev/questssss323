<?php
// ЗАДАНИЕ 1 //
$csv_file = 'file.csv'; 


$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$date = date('Y-m-d H:i:s');               


$data = [];
if (file_exists($csv_file)) {
    $file = fopen($csv_file, 'r');
    while ($row = fgetcsv($file)) {
        $data[$row[0]] = $row; 
    }
    fclose($file);
}
echo "<pre>";
var_dump($data);
echo "</pre><br>";
if (isset($data[$ip])) {
    $data[$ip][1] = $date;     
    $data[$ip][2]++;          
} else {
    $data[$ip] = [$ip, $date, 1]; 
}

$file = fopen($csv_file, 'w');
foreach ($data as $row) {
    fputcsv($file, $row);
}
fclose($file);

echo pathinfo(__FILE__, PATHINFO_FILENAME) . "<br>";
if (file_exists($csv_file)) {
    $file = fopen($csv_file, 'r');
    while ($row = fgetcsv($file)) {
        echo "IP: {$row[0]}, Дата: {$row[1]}, Посещений: {$row[2]}<br>";
    }
    fclose($file);
} else {
    echo "Пока никто не посещал.<br>";
}
?>