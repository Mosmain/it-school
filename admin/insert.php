<?php
require 'db.php';
try {
    // Переносим данные из полей формы в переменные.
    $product_title=$_POST['product_title'];
    $product_price=$_POST['product_price'];
    $product_img=$_POST['product_img'];
    $product_descr=$_POST['product_descr'];
    $product_code=$_POST['product_code'];
    $product_qty=$_POST['product_qty'];

    // Используем Prepared statements (заранее скомпилированное SQL-выражение) для защиты от SQL-инъекций.
    // Создаем ассоциативный массив для подстановки данных в запрос.
    $data = array(
        'title' => "$product_title",
        'price' => "$product_price",
        'img' => "$product_img",
        'descr' => "$product_descr",
        'code' => "$product_code",
        'qty' => "$product_qty",
    );

    // Запрос на создание записи в таблице
    // Если есть хоть один отмеченный жанр в форме, то составляем запрос, внося все отмеченные жанры,
    // иначе название жанра не вносим в таблицу.
    $sql = "INSERT INTO product(title, price, qty, img, descr, code)".
    " VALUES(:title, :price, :qty, :img, :descr, :code)";
    // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
    //echo $sql;

    // Подготовка запроса (замена псевдо переменных :title, :author и т.п. на реальные данные)
    $statement = $pdo->prepare($sql);
    // Выполняем запрос
    $statement->execute($data);

    echo "Запись успешно создана!";
}

catch(PDOException $e) {
    echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
}

// Закрываем соединение
$pdo = null;
?>