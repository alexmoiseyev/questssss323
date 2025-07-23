<?php
// ЗАДАНИЕ 2 //
if (!isset($_GET['MODE']) || !in_array($_GET['MODE'], ['1', '2'])) {
    echo("Ошибка! Передано некорректное значение GET параметра MODE");
}

$mode = $_GET['MODE']??0;

session_save_path(__DIR__ . '/34/' . ($mode == '1' ? 'FIRST_COUNTER' : 'SECOND_COUNTER'));

session_start();

if (isset($_GET['DELETE_SESSION_DATA']) && $_GET['DELETE_SESSION_DATA'] == 'Y') {
    session_unset();
    session_destroy();
    echo "Данные сессии были удалены.<br>";
} else {
    // Увеличиваем счетчик
    if (!isset($_SESSION['COUNTER'])) {
        $_SESSION['COUNTER'] = 0;
    }
    $_SESSION['COUNTER']++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CHAPTER34</title>
</head>
<body>
    <div>
        <a href="?MODE=1">MODE=1 (FIRST_COUNTER)</a> | 
        <a href="?MODE=2">MODE=2 (SECOND_COUNTER)</a>
    </div>
    
    <div>
        <a href="?MODE=1&DELETE_SESSION_DATA=Y">Удалить данные для MODE=1</a> | 
        <a href="?MODE=2&DELETE_SESSION_DATA=Y">Удалить данные для MODE=2</a>
    </div>
    
    <h2>Информация о сессии:</h2>
    <p>ID сессии: <?php echo session_id(); ?></p>
    <p>Текущий MODE=<?php echo $mode; ?></p>
    <p>Путь к текущему хранилищу сессии: <?php echo session_save_path(); ?></p>
    
    <?php if (!isset($_GET['DELETE_SESSION_DATA']) || $_GET['DELETE_SESSION_DATA'] != 'Y'): ?>
        <p>Текущее значение COUNTER: <?php echo $_SESSION['COUNTER']; ?></p>
    <?php endif; ?>
</body>
</html>