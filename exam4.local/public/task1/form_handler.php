<?php
header('Content-Type: application/json');
$requiredFields = ['surname', 'name', 'email', 'company_client', 'problem_solved', 'quality_service'];
foreach ($requiredFields as $field)
{
    if (empty($_POST[$field]))
    {
        http_response_code(400);
        echo json_encode(['error' => 'Не все обязательные поля заполнены']);
        exit;
    }
}

$host = "mysql-8.0";
$user = "root";
$pass = '';
$dbname = "exam4";

$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'] ?? null;
$email = $_POST['email'];

$no_patronymic = isset($_POST['no_patronymic']) ? 1 : 0;

$company_client = $_POST['company_client'];
$problem_solved = $_POST['problem_solved'];
$quality_service = $_POST['quality_service'];
$grudge = $_POST['grudge'] ?? null;

try
{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO survey (name, surname, patronymic, email, no_patronymic, company_client, problem_solved, quality_service, grudge) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);


    if ($stmt->execute([$name, $surname, $patronymic, $email, $no_patronymic, $company_client, $problem_solved, $quality_service, $grudge]))
    {
        echo json_encode(['success' => true]);
    }
    else
    {
        throw new PDOException("Ошибка выполнения запроса");
    }
}
catch (PDOException $e)
{
    http_response_code(500);
    echo json_encode([
        'error' => 'Ошибка базы данныъ',
        'details' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
    error_log('Database error: ' . $e->getMessage());
    exit;
}
