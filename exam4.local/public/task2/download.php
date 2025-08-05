<?php
//загрука xml
$url = 'https://www.w3schools.com/xml/plant_catalog.xml';
$savePath = 'products/plant_catalog.xml';

if (!file_exists('products'))
{
    mkdir('products', 0777, true);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$xmlContent = curl_exec($ch);

if (curl_errno($ch))
{
    die('Ошибка CURL: ' . curl_error($ch));
}

curl_close($ch);

if (file_put_contents($savePath, $xmlContent))
{
    echo "Файл сохранен d: " . $savePath;
}
else
{
    echo "Ошибка при сохранении файла";
}
