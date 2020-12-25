<?php
require 'db.php';
try {

    // Создаем массив, в котором будем хранить идентификаторы записей
    $ids_to_delete = array();
    // Переносим данные (отмеченные записи) из полей формы в массив
    foreach($_POST['delete_row'] as $selected){
        $ids_to_delete[] = $selected;
    }

    // Если пользователь не отметил ни одной записи для удаления,
    // то прерываем выполнение кода
    if(empty($ids_to_delete)){
        echo "Вы не выделили ни одной записи для удаления!";
        return;
    }


    // Если есть хоть одно заполненное поле формы (запись выделена для удаления),
    // то составляем запрос.
    if($ids_to_delete > 0){
        // Запрос на удаление выделенных записей в таблице
        $sql = "DELETE FROM product WHERE id IN (" . implode(',', array_map('intval', $ids_to_delete)) . ")";
        // Перед тем как выполнять запрос предлагаю убедится, что он составлен без ошибок.
        // echo $sql;

        // Подготовка запроса.
        $statement = $pdo->prepare($sql);

        // Выполняем запрос.
        $statement->execute();

        echo "Записи c id: " . implode(',', array_map('intval', $ids_to_delete)) .  " успешно удалены!";
    }
}

catch(PDOException $e) {
    echo "Ошибка при удалении записи в базе данных: " . $e->getMessage();
}

// Закрываем соединение.
$db = null;
?>