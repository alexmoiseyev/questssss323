<?php
require_once 'services/CProducts.php';

$products = new CProducts('mysql-8.0', 'finalExam', 'root', '');
$products->createProducts();
isset($_GET['get_products']) ?: $_GET['get_products'] = 0;
if ($_GET['get_products'] == 0)
{
    $_GET['get_products'] = 5;
}
$items = $products->getProducts($_GET['get_products']);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Список товаров</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            margin: 0 5px;
            cursor: pointer;
        }

        .records-btn {
            display: inline-block;
            text-transform: lowercase;
            text-decoration: none;
            font-size: 25px;
            transition: .3s;
        }

        .records-btn:hover {
            scale: 110%;
        }
    </style>
</head>

<body>
    <h1>Список товаров</h1>
    <table id="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Код товара</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Артикул</th>
                <th>Количество</th>
                <th>Дата создания</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr id="product-<?= $item['id'] ?>">
                    <td><?= $item['id'] ?></td>
                    <td><?= htmlspecialchars($item['product_id']) ?></td>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= number_format($item['product_price']) . '₽' ?></td>
                    <td><?= '#' . htmlspecialchars($item['product_article']) ?></td>
                    <td>
                        <div class="quantity-control">
                            <button class="quantity-btn minus" data-id="<?= $item['id'] ?>">-</button>
                            <span class="quantity-value"><?= $item['product_quantity'] ?></span>
                            <button class="quantity-btn plus" data-id="<?= $item['id'] ?>">+</button>
                        </div>
                    </td>
                    <td><?= $item['date_create'] ?></td>
                    <td><button class="hide-btn" data-id="<?= $item['id'] ?>">Скрыть</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($_GET['get_products'] < $products->getCountProducts()): ?>
        <a class="records-btn" href='?get_products=<?= ($_GET['get_products'] < $products->getCountProducts()) ? $_GET['get_products'] + 5 : $_GET['get_products'] ?>'>Еще</a>
    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.hide-btn', function() {
                const productId = $(this).data('id');
                const row = $('#product-' + productId);

                $.ajax({
                    url: 'hide_product.php',
                    method: 'POST',
                    data: {
                        id: productId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                        alert('Ошибка при скрытии товара');
                    }
                });
            });

            $(document).on('click', '.quantity-btn', function() {
                const productId = $(this).data('id');
                const isPlus = $(this).hasClass('plus');
                const quantityElement = $(this).siblings('.quantity-value');
                let quantity = parseInt(quantityElement.text());

                quantity = isPlus ? quantity + 1 : Math.max(0, quantity - 1);
                $.ajax({
                    url: 'update_quantity.php',
                    method: 'POST',
                    data: {
                        id: productId,
                        quantity: quantity
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            quantityElement.text(quantity);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", status, error);
                        alert('Ошибка при обновлении количества');
                    }
                });
            });
        });
    </script>
</body>

</html>