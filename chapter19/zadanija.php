<?php

// ЗАДАНИЕ 1 //

$timestamp = mktime(21, 56, 2, 5, 28, 2021);
echo $timestamp; 
echo "<br>";
$timestamp = strtotime('28.05.2021 21:56:02');
echo $timestamp; 
echo "<br>";

// ЗАДАНИЕ 2 // 

    //1)
    $timestamp = 1578652367;
    $dateStr = date('d F l Y H:i:s', $timestamp); //strftime устарела php 8.1
    echo $dateStr;
    echo "<br>";
    //2)
    $timestamp = 1611337801;
    $dateStr = date('d F l Y H:i:s', $timestamp);  //strftime устарела php 8.1
    echo $dateStr;
    echo "<br>";

// ЗАДАНИЕ 3 //

$startDate = new DateTime('-1000-01-01'); 
$endDate = new DateTime('9000-01-01');
$interval = $startDate->diff($endDate);
echo "<pre>";
var_dump($interval);
echo "</pre><br>";
$totalDays = $interval->days;
echo $totalDays; 