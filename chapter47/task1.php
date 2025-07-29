<!-- ЗАДАНИЕ 1 -->
<!DOCTYPE html>
<html>
<head>
    <title>Загрузка файла</title>
    <meta charset="utf-8">
</head>
<body>
    <form action="handler.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileName" required>
        <br><br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>