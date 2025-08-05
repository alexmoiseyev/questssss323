<?php
$xmlFile = 'products/plant_catalog.xml';

if (!file_exists($xmlFile))
{
    die("XML файл не найден.");
}

$xml = simplexml_load_file($xmlFile);
if ($xml === false)
{
    die("Ошибка загрузки XML файла");
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Каталог растений</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .plant {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            width: 300px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="black">Каталог растений</h1>
        <div class="d-flex flex-row flex-wrap justify-content-center m-3">
            <?php foreach ($xml->PLANT as $plant): ?>
                <div class="plant">
                    <h2><?= htmlspecialchars($plant->COMMON) ?></h2>
                    <p><strong>Латинское название растения:</strong> <?= htmlspecialchars($plant->BOTANICAL) ?></p>
                    <p><strong>Период цветения:</strong> <?= htmlspecialchars($plant->ZONE) ?></p>
                    <p><strong>Место размещения растения:</strong> <?= htmlspecialchars($plant->LIGHT) ?></p>
                    <p><strong>Стоимость:</strong> <?= htmlspecialchars($plant->PRICE) ?></p>
                    <p><strong>В наличии:</strong> <?= htmlspecialchars($plant->AVAILABILITY) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>