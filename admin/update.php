<?php
require 'db.php';
try {
    // Переносим данные из полей формы в переменные.
    $product_id =       $_POST['product_id'];
    $product_title =    $_POST['product_title'];
    $product_price =   $_POST['product_price'];
    $product_img =    $_POST['product_img'];
    $product_descr = $_POST['product_descr'];
    $product_code =   $_POST['product_code'];

    // Если пользователь не указал (номер Id) какую запись будем редактировать,
    // то прерываем выполнение кода.
    if(empty($product_id)){
        echo "Вы не задали ID строки для обновления данных!";
        return;
    }

    // Составвлям массив колонок для запроса обновления.
    // Если поле формы не пустое, то его значение будет добавлено в запрос.
    $update_columns = array();
    if(trim($product_title) !== "")   { $update_columns[] = "title = :title"; }
    if(trim($product_price) !== "")  { $update_columns[] = "price = :price"; }
    if(trim($product_img) !== "")   { $update_columns[] = "img = :img"; }
    if(trim($product_descr) !== ""){ $update_columns[] = "descr = :descr"; }
    if(trim($product_code) !== "")  { $update_columns[] = "code = :code"; }

    // Если есть хоть одно заполненное поле формы,
    // то составляем запрос.
    if($update_columns > 0){
        // Запрос на создание записи в таблице
        $sql = "UPDATE product SET " . implode(", ", $update_columns) . " WHERE id=:id";
        // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
        // echo $sql;
        // Например, если в форме заполнены поля: название, автор книги и номер Id=1,
        // то запрос должен выглядеть следующим образом:
        // "UPDATE books SET title = :title, author = :author WHERE id=:id"

        // Подготовка запроса.
        $statement = $pdo->prepare($sql);

        // Привязываем к псевдо переменным реальные данные,
        // если они существуют (пользователь заполнил поле в форме).
        $statement->bindParam(":id", $product_id);
        if(trim($product_title) !== ""){
            $statement->bindParam(":title", $product_title);
        }
        if(trim($product_price) !== ""){
            $statement->bindParam(":price", $product_price);
        }
        if(trim($product_img) !== ""){
            $statement->bindParam(":img", $product_img);
        }
        if(trim($product_descr) !== ""){
            $statement->bindParam(":descr", $product_descr);
        }
        if(trim($product_code) !== ""){
            $statement->bindParam(":code", $product_code);
        }

        // Выполняем запрос.
        $statement->execute();

        echo "Запись c ID: " . $product_id . " успешно обновлена!";
    }
}

catch(PDOException $e) {
    echo "Ошибка при обновлении записи в базе данных: " . $e->getMessage();
}

// Закрываем соединение.
$pdo = null;
?>