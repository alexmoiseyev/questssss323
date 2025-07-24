<?php
// ЗАДАНИЕ 1 //
$user = 'root';
$pass = ''; 
try {
    $dbh = new PDO('mysql:host=mysql-8.0;dbname=chapter37', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("
        CREATE TABLE IF NOT EXISTS `feedback` (
        `id` int NOT NULL AUTO_INCREMENT,
        `review_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `name` varchar(255) NOT NULL,
        `position` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `review_text` text NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
         
    $stmt = $dbh->query("SELECT COUNT(*) FROM feedback");
    if ($stmt->fetchColumn() == 0) {
        $fakeFeedbacks = [
            ['Алексей', 'CEO', 'alexey24@gmail.com','Hello World!!!'],
            ['Кирилл', 'CTO', 'kirill@mail.ru','Привет!'],
            ['Олег', 'Инструктор', 'oleglapkoff@mail.ru','Классно....'],
            ['Антон', 'HR', 'hr_anton@gmail.com','Ух ты!'],
            ['Василий332', 'Охранник', 'dembel2007@gmail.com','Зачетно!'],
        ];
        foreach ($fakeFeedbacks as $fakeFeedback) {
            $dbh->prepare("INSERT INTO feedback (name, position, email, review_text) VALUES (?,?,?,?)")
               ->execute([$fakeFeedback[0], $fakeFeedback[1],$fakeFeedback[2],$fakeFeedback[3]]);
        }
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsOnPage = 3;
if($page > 1){
    $start = ($page * $recordsOnPage) - $recordsOnPage;
}else{
    $start=0;
}

$totalRecords=$dbh->query("SELECT COUNT(*) FROM feedback")->fetchColumn();
$pages = ceil($totalRecords/$recordsOnPage);

$stmt = $dbh->prepare("SELECT * FROM feedback ORDER BY name LIMIT $recordsOnPage OFFSET $start");
$stmt->execute();
$feedbacks=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Chapter37</title>
</head>
<body>
    <div class="container">
        <h2>Отзывы:</h2>
        <?php foreach($feedbacks as $feedback):?>
            <div style="border: 2px solid black;" class="p-1">
                <p>Имя: <?=$feedback["name"]?></p>
                <p>Должность: <?=$feedback["position"]?></p>
                <p>Текст: <?=$feedback["review_text"]?></p>    
                <p>Дата: <?=$feedback["review_date"]?></p>   
            </div>
        <?php endforeach;?>
        <div class="pagination">
            <?php
                for($i=1;$i<=$pages;$i++){
                    echo "<a href=?page=$i>$i</a>&nbsp";
                }
            ?>
        </div>
    </div>
    <div class="container mt-3">
        <h2>Написать отзыв:</h2>
        <form action="#" method="post">
            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Должность</label>
                <input type="text" name="position" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Текст</label>
                <input type="text" name="review_text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
        
        $name=$_POST['name'];
        $position=$_POST['position'];
        $email=$_POST['email'];
        $text=$_POST['review_text'];
        
        $sql = "INSERT INTO feedback (name, position, email, review_text) VALUES (?, ?, ?, ?)";
        $stmt = $dbh->prepare("INSERT INTO feedback (name, position, email, review_text) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $position, $email, $text]);
        header('Location:feedback.php');
    }
?>