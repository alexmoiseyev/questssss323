<?php
require_once 'services/CProducts.php';

header('Content-Type: application/json');

try
{
    $products = new CProducts('mysql-8.0', 'finalExam', 'root', '');

    if (isset($_POST['id']))
    {
        $id = (int)$_POST['id'];
        $success = $products->hideProduct($id);
        echo json_encode(['success' => $success]);
    }
    else
    {
        echo json_encode(['success' => false, 'error' => 'ошибка в ID']);
    }
}
catch (PDOException $e)
{
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
