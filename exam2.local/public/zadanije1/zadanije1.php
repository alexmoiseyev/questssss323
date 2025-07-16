<?php
// ЗАДАНИЕ 1 //
class FormHandler
{
    private $filename = 'form.csv';

    public function __construct()
    {
        if (!file_exists($this->filename))
        {
            $header = "Имя,Телефон,Email,СНИЛС,Комментарий\n";
            file_put_contents($this->filename, $header);
        }
        if (!$this->isSnils($_POST['snils']))
        {
            echo "ошибка в снилс";
            exit;
        }
        if (!$this->hasEmail($_POST['email']))
        {
            echo "ошибка в email";
            exit;
        }
        if (!$this->isPhoneNumber($_POST['phone']))
        {
            echo "ошибка в номере телефона";
            exit;
        }
    }
    public function handleForm($data)
    {
        $name = $this->clearInput($data['name'] ?? '');
        $phone = $this->clearInput($data['phone'] ?? '');
        $email = $this->clearInput($data['email'] ?? '');
        $snils = $this->clearInput($data['snils'] ?? '');
        $comment = $this->clearInput($data['comment'] ?? '');

        $csv = sprintf(
            "%s,%s,%s,%s,%s\n",
            $name,
            $phone,
            $email,
            $snils,
            $comment
        );

        file_put_contents($this->filename, $csv, FILE_APPEND);

        return true;
    }
    public function isSnils($string): bool
    {
        $pattern = '/^\d{3}-\d{3}-\d{3} \d{2}$/';
        if (preg_match($pattern, $string) === 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function hasEmail($string): bool
    {
        $pattern = '/@.+\..+/';
        if (preg_match($pattern, $string) === 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function isPhoneNumber($string): bool
    {
        $pattern = '/^\s?(\+\s?7|8)([- ()]*\d){10}$/';
        if (preg_match($pattern, $string) === 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    private function clearInput($input)
    {
        return trim(htmlspecialchars($input));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $formHandler = new FormHandler();
    if (!$formHandler->isSnils($_POST['snils']))
    {
        echo "ошибка в снилс";
        exit;
    }
    if (!$formHandler->hasEmail($_POST['email']))
    {
        echo "ошибка в email";
        exit;
    }
    if (!$formHandler->isPhoneNumber($_POST['phone']))
    {
        echo "ошибка в номере телефона";
        exit;
    }
    $formHandler->handleForm($_POST);
    echo "форма отправлена";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Форма</title>
</head>

<body>
    <div class="container">
        <h1>Форма</h1>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Имя:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Телефон:</label>
                <input type="tel" class="form-control" name="phone" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Снилс:</label>
                <input type="text" class="form-control" name="snils" required>
            </div>
            <div class="mb-3">
                <label class="form-label">текстовое поле для ввода комментария:</label>
                <textarea type="text" class="form-control" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

</body>

</html>