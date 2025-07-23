<?php
// ЗАДАНИЕ 1 //
if (!isset($_GET['MODE']) || !in_array($_GET['MODE'], ['1', '2'])) {
   echo "Передано некорректное значение GET параметра MODE";
}

$mode = $_GET['MODE']??0;

if ($mode == '1') {
    session_name('FIRST_COUNTER');
} elseif ($mode == '2') {
    session_name('SECOND_COUNTER');
}

session_start();

if (isset($_GET['DELETE_SESSION_DATA']) && $_GET['DELETE_SESSION_DATA'] == 'Y') {
    session_unset();
    session_destroy();
    echo "двнные сессии были удалены<br>";
} else {
    if (!isset($_SESSION['COUNTER'])) {
        $_SESSION['COUNTER'] = 0;
    }
    $_SESSION['COUNTER']++;
}

echo "ID сессии: " . session_id() . "<br>";
echo "Группа сессии: " . session_name() . "<br>";
echo "Путь к текущему хранилищу сессии: " . session_save_path() . "<br>";

if (!isset($_GET['DELETE_SESSION_DATA']) || $_GET['DELETE_SESSION_DATA'] != 'Y') {
    echo "Текущее значение COUNTER: " . $_SESSION['COUNTER'] . "<br>";
}
?>
<a href="?MODE=1">MODE=1</a>
<br>
<a href="?MODE=2">MODE=2</a>
<br>
<a href="?MODE=1&DELETE_SESSION_DATA=Y">delete1 (очистить MODE=1)</a>
<br>
<a href="?MODE=2&DELETE_SESSION_DATA=Y">delete2 (очистить MODE=2)</a>
<br>