<?php
// ЗАДАНИЕ 1 //
$user = 'root';
$pass = '';
$dbh = new PDO('mysql:host=mysql-8.0;dbname=exam3', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();
$quests = [
    [
        "Пять плюс три" => "8"
    ],
    [
        "Двенадцать минус десять" => "2"
    ],
    [
        "Два умножить на три" => "6"
    ],
    [
        "Шестнадцать разделить на два" => "8"
    ]
];


if (empty($_SESSION['quest']))
{
    foreach ($quests[rand(0, 3)] as $key => $value)
    {
        $quest = $key;
        $correctAnswer = $value;
    }
    $_SESSION['correctAnswer'] = $correctAnswer;
    $_SESSION['quest'] = $quest;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Exam2</title>
</head>

<body>
    <div class="container mt-3">
        <h2>Регистрация</h2>
        <form action="task1.php" method="post">
            <label for="">Имя</label>
            <input type="text" class="form-control" name="name">
            <label for="">Пароль</label>
            <input type="text" class="form-control" name="password">
            <label><?= $_SESSION['quest'] ?></label>
            <input type="text" class="form-control" name="answer">
            <button type="submit" class="btn btn-primary mt-5">Зарегистрироваться</button>
        </form>
    </div>
</body>

</html>

<?php

// echo $_SESSION['quest'];
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'] ?? 0;
    $password = $_POST['password'] ?? 0;
    $answer = $_POST['answer'];
    if ($_POST['answer'] != $_SESSION['correctAnswer'])
    {
        echo 'Капча не пройдена';
        exit;
    }
    if (empty($_POST['name']) || empty($_POST['password']) || empty($_POST['answer']))
    {
        echo 'Заполните все поля';
        exit;
    }
    try
    {
        $sql = "INSERT INTO users (name, password) VALUES ('$name', '$password')";
        $dbh->query($sql);
        echo 'Вы успешно зарегистрировались.';
        session_destroy();
        header("refresh:2; url=task1.php");
    }
    catch (PDOException $e)
    {
        if (strpos($e->getMessage(), 'Duplicate entry') !== false)
        {
            echo 'Пользователь с таким именем уже существует.';
        }
    }
}
