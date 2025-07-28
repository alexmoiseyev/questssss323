<?php
// ЗАДАНИЕ 2 //
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
        <h2>Авторизация</h2>
        <form action="task2.php" method="post">
            <label for="">Имя</label>
            <input type="text" class="form-control" name="name">
            <label for="">Пароль</label>
            <input type="text" class="form-control" name="password">
            <label><?= $_SESSION['quest'] ?></label>
            <input type="text" class="form-control" name="answer">
            <button type="submit" class="btn btn-primary mt-5">Авторизоваться</button>
        </form>
    </div>
</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    // echo $_POST['answer'];
    // echo $_SESSION['correctAnswer'];
    echo "<br>";
    $name = $_POST['name'] ?? 0;
    $password = $_POST['password'] ?? 0;
    $answer = $_POST['answer'];
    if (empty($_POST['name']) || empty($_POST['password']) || empty($_POST['answer']))
    {
        echo 'Заполните все поля';
        exit;
    }
    if ($_POST['answer'] != $_SESSION['correctAnswer'])
    {
        echo 'Капча не пройдена';
        exit;
    }
    $stmt = $dbh->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->execute([$name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($user))
    {
        echo 'Пользователь не найден';
        exit;
    }

    if ($user['password'] != $password)
    {
        echo 'Не верный пароль';
        exit;
    }
    header('Location: success.php');
    session_destroy();
}

?>