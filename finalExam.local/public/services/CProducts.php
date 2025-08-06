<?php
class CProducts
{
    private $pdo;

    public function __construct($host, $dbname, $user, $pass)
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try
        {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        }
        catch (PDOException $e)
        {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getProducts($limit = 10)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Products WHERE is_hidden = FALSE ORDER BY date_create DESC LIMIT $limit");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getCountProducts()
    {
        $countProducts = $this->pdo->query("SELECT COUNT(*) FROM Products WHERE is_hidden = FALSE");
        return $countProducts->fetchColumn();
    }
    public function hideProduct($id)
    {
        $stmt = $this->pdo->prepare("UPDATE Products SET is_hidden = TRUE WHERE id = $id");
        return $stmt->execute();
    }

    public function updateQuantity($id, $quantity)
    {
        $stmt = $this->pdo->prepare("UPDATE Products SET product_quantity = $quantity WHERE id = $id");
        return $stmt->execute();
    }
    public function createProducts()
    {
        $countProducts = $this->pdo->query("SELECT COUNT(*) FROM Products");
        if ($countProducts->fetchColumn() == 0)
        {
            $fakeProducts = [
                [rand(1, 10000), 'Подставка для телефона', 1500, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Баскетбольный мяч', 2000, rand(1, 10000), 982, 0],
                [rand(1, 10000), 'Бас гитара Ibanez GRG-200', 43500, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Офисное кресло', 18000, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Ковер массажный', 2820, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Наушники Sony', 8500, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Подушка ортопедическая', 1200, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Микрофон Marshall ZD-90', 9780, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Чехол для телефона Iphone-12 PRO', 940, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Клавиатура SVEN BNK-231', 2700, rand(1, 10000), rand(1, 1000), 0],
                [rand(1, 10000), 'Коврик для мыши DEXP', 530, rand(1, 10000), rand(1, 1000), 0],
            ];
            $stmt = $this->pdo->prepare("INSERT INTO Products (product_id, product_name, product_price, product_article, product_quantity, is_hidden) VALUES (?,?,?,?,?,?)");
            foreach ($fakeProducts as $product)
            {
                $stmt->execute([$product[0], $product[1], $product[2], $product[3], $product[4], $product[5]]);
            }
            return true;
        }
        return false;
    }
}
