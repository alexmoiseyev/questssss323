<?php
require_once 'services/CProducts.php';

header('Content-Type: application/json');

try
{
    $products = new CProducts('mysql-8.0', 'finalExam', 'root', '');

    if (isset($_POST['id']) && isset($_POST['quantity']))
    {
        $id = (int)$_POST['id'];
        $quantity = (int)$_POST['quantity'];
        $success = $products->updateQuantity($id, $quantity);
        echo json_encode(['success' => $success]);
    }
    else
    {
        echo json_encode(['success' => false, 'error' => 'ID или Quantity не указаны']);
    }
}
catch (PDOException $e)
{
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
