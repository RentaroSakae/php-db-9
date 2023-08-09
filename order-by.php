<?php
    $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
    $user = 'root';
    $password = 'root';

        try {
            $pdo = new PDO($dsn, $user, $password);
            
            if(isset($_GET['order'])) {
                $order = $_GET['order'];
            } else {
                $order = NULL;
            }

            if(isset($_GET['key'])) {
                $key = $_GET['key'];
            } else {
                $key = NULL;
            }

            if($order === 'asc' && $key === "age") {
                $sql = 'SELECT id, name, furigana, age FROM users ORDER BY age ASC';
            } elseif($order === 'asc' && $key === "furigana") {
                $sql = 'SELECT id, name, furigana, age FROM users ORDER BY furigana ASC';
            } elseif ($order === 'desc' && $key === "age") {
                $sql = 'SELECT id, name, furigana, age FROM users ORDER BY age DESC';
            } elseif($order === 'desc' && $key === "furigana") {
                $sql = 'SELECT id, name, furigana, age FROM users ORDER BY furigana DESC';
            } else {
                $sql = 'SELECT id, name, furigana, age FROM users ORDER BY id';
            }

            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,0">
        <title>PHP+DB</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="sort">
            <a href="order-by.php?key=age&order=asc" class="sort-btn">年齢順(昇順)</a>
            <a href="order-by.php?key=age&order=desc" class="sort-btn">年齢順(降順)</a>
            <a href="order-by.php?key=furigana&order=asc" class="sort-btn">ふりがな（五十音順）</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>ふりがな</th>
                <th>年齢</th>
            </tr>
            <?php
            foreach($results as $result) {
                $table_row = "
                <tr>
                <td>{$result['id']}</td>
                <td>{$result['name']}</td>
                <td>{$result['furigana']}</td>
                <td>{$result['age']}</td>
                </tr>
                ";
                echo $table_row;
            }
            ?>
        </table>
    </body>
</html>