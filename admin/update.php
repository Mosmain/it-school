<?php
require 'db.php';
try {

    $product_id =       $_POST['product_id'];
    $product_title =    $_POST['product_title'];
    $product_price =   $_POST['product_price'];
    $product_img =    $_POST['product_img'];
    $product_descr = $_POST['product_descr'];
    $product_code =   $_POST['product_code'];

    if(empty($product_id)){
        echo "Вы не задали ID строки для обновления данных!";
        return;
    }

    $update_columns = array();
    if(trim($product_title) !== "")   { $update_columns[] = "title = :title"; }
    if(trim($product_price) !== "")  { $update_columns[] = "price = :price"; }
    if(trim($product_img) !== "")   { $update_columns[] = "img = :img"; }
    if(trim($product_descr) !== ""){ $update_columns[] = "descr = :descr"; }
    if(trim($product_code) !== "")  { $update_columns[] = "code = :code"; }

    if($update_columns > 0){

        $sql = "UPDATE product SET " . implode(", ", $update_columns) . " WHERE id=:id";

        $statement = $pdo->prepare($sql);

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

        $statement->execute();

        echo "Запись c ID: " . $product_id . " успешно обновлена!";
    }
}

catch(PDOException $e) {
    echo "Ошибка при обновлении записи в базе данных: " . $e->getMessage();
}

$pdo = null;
?>