<?php
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
if (isset($_GET['ajax']) && $_GET['ajax'] == 'get_feedbacks') {
    header('Content-Type: application/json');
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $recordsOnPage = 3;
    $start = ($page > 1) ? ($page * $recordsOnPage) - $recordsOnPage : 0;
    
    $totalRecords = $dbh->query("SELECT COUNT(*) FROM feedback")->fetchColumn();
    $pages = ceil($totalRecords / $recordsOnPage);
    
    $stmt = $dbh->prepare("SELECT * FROM feedback ORDER BY name LIMIT $recordsOnPage OFFSET $start");
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'feedbacks' => $feedbacks,
        'pagination' => [
            'totalPages' => $pages,
            'currentPage' => $page
        ]
    ]);
    exit;
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    
    try {
        $name = $_POST['name'] ?? '';
        $position = $_POST['position'] ?? '';
        $email = $_POST['email'] ?? '';
        $text = $_POST['review_text'] ?? '';
        
        if (empty($name) || empty($position) || empty($email) || empty($text)) {
            throw new Exception('Все поля обязательны для заполнения');
        }
        
        $stmt = $dbh->prepare("INSERT INTO feedback (name, position, email, review_text) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $position, $email, $text]);
        
        echo json_encode(['success' => true, 'message' => 'Отзыв успешно добавлен']);
        exit;
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit;
    }
}
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
        <div id="feedbacksContainer">
            <!-- отзывы -->
        </div>
        <div id="paginationContainer" class="pagination">
            <!--пагинация -->
        </div>
    </div>
    
    <div class="container mt-3">
        <button id="toggleFormBtn" class="btn btn-secondary mb-3">Скрыть форму</button>
        <h2>Написать отзыв:</h2>
        <form action="#" method="post" id="feedbackForm">
            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" required>
                <div class="invalid-feedback">Пожалуйста, введите имя</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Должность</label>
                <input type="text" name="position" class="form-control" required>
                <div class="invalid-feedback">Пожалуйста, введите должность</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
                <div class="invalid-feedback">Пожалуйста, введите корректный email</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Текст</label>
                <input type="text" name="review_text" class="form-control" required>
                <div class="invalid-feedback">Пожалуйста, введите текст отзыва</div>
            </div>
            <div id="formMessage" class="alert d-none"></div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function() {
        function loadFeedbacks(page = 1) {
            $.ajax({
                url: '?ajax=get_feedbacks&page=' + page,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    renderFeedbacks(response.feedbacks);
                    renderPagination(response.pagination);
                },
                error: function(xhr) {
                    console.error('Ошибка при загрузке отзывов:', xhr.statusText);
                }
            });
        }
        
        function renderFeedbacks(feedbacks) {
            let html = '';
            feedbacks.forEach(function(feedback) {
                html += `
                    <div style="border: 2px solid black;" class="p-1 mb-2">
                        <p>Имя: ${feedback.name}</p>
                        <p>Должность: ${feedback.position}</p>
                        <p>Текст: ${feedback.review_text}</p>    
                        <p>Дата: ${feedback.review_date}</p>   
                    </div>
                `;
            });
            $('#feedbacksContainer').html(html);
        }
        
        function renderPagination(pagination) {
            let html = '';
            for (let i = 1; i <= pagination.totalPages; i++) {
                const activeClass = i === pagination.currentPage ? ' active' : '';
                html += `<a href="#" data-page="${i}" class="page-link${activeClass}">${i}</a>&nbsp;`;
            }
            $('#paginationContainer').html(html);
        }
        
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            loadFeedbacks(page);
        });
        
        loadFeedbacks();
        
        $('#toggleFormBtn').click(function() {
            $('#feedbackForm').toggle();
            $(this).text(function(i, text) {
                return text === "Скрыть форму" ? "Показать форму" : "Скрыть форму";
            });
        });

        $('#feedbackForm').on('submit', function(e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid');
            $('#formMessage').addClass('d-none').removeClass('alert-success alert-danger');
            let isValid = true;
            $(this).find('[required]').each(function() {
                if (!$(this).val().trim()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                }
            });
            
            if (!isValid) {
                $('#formMessage').text('Пожалуйста, заполните все обязательные поля').addClass('alert-danger').removeClass('d-none');
                return;
            }
            
            const formData = $(this).serialize();
    
            $.ajax({
                url: 'task9.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#formMessage').text('Отзыв успешно отправлен!').addClass('alert-success').removeClass('d-none');
                        $('#feedbackForm')[0].reset();
                        loadFeedbacks();
                    } else {
                        $('#formMessage').text(response.message || 'Ошибка при отправке отзыва').addClass('alert-danger').removeClass('d-none');
                    }
                },
                error: function(xhr) {
                    $('#formMessage').text('Произошла ошибка: ' + xhr.statusText).addClass('alert-danger').removeClass('d-none');
                }
            });
        });
    });
</script>
</body>
</html>