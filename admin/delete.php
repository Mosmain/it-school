<?php
require 'db.php';
try {

    $ids_to_delete = array();

    foreach($_POST['delete_row'] as $selected){
        $ids_to_delete[] = $selected;
    }

    if(empty($ids_to_delete)){
        echo "Вы не выделили ни одной записи для удаления!";
        return;
    }

    if($ids_to_delete > 0){

        $sql = "DELETE FROM product WHERE id IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        echo "Записи c id: " . implode(',', array_map('intval', $ids_to_delete)) .  " успешно удалены!";
    }
}

catch(PDOException $e) {
    echo "Ошибка при удалении записи в базе данных: " . $e->getMessage();
}

$pdo = null;
?>