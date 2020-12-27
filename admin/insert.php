<?php
require 'db.php';
try {
    $product_title=$_POST['product_title'];
    $product_price=$_POST['product_price'];
    $product_img=$_POST['product_img'];
    $product_descr=$_POST['product_descr'];
    $product_code=$_POST['product_code'];
    $product_qty=$_POST['product_qty'];

    $data = array(
        'title' => "$product_title",
        'price' => "$product_price",
        'img' => "$product_img",
        'descr' => "$product_descr",
        'code' => "$product_code",
        'qty' => "$product_qty",
    );

    $sql = "INSERT INTO product(title, price, qty, img, descr, code)".
    " VALUES(:title, :price, :qty, :img, :descr, :code)";

    $statement = $pdo->prepare($sql);
    $statement->execute($data);

    echo "Запись успешно создана!";
}

catch(PDOException $e) {
    echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
}

$pdo = null;
?>