<?php 
	require 'db.php';

	$check = [];

	$data = $_POST;
	if ( isset($data['do_logout']) ) {
		unset($_SESSION['logged_admin']);
		echo '<div style="color:red;">Вы не авторизованы!</div><hr>';
	}
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('admins', 'login = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_admin'] = $user;
				// echo '<div style="color:green;">Вы авторизованы!<br/> Можете перейти на <a href="./">главную</a> страницу.</div><hr>';
			} else {
				$errors[] = 'Неверно введен пароль!';
			}

		} else {
			$errors[] = 'Админ не найден!';
		}

		if ( ! empty($errors) )
		{
			//выводим ошибки авторизации
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}
	}

?>

<?php if ( isset ($_SESSION['logged_admin']) ) : ?>
<?php

	require '../assets/include/headerAdmin.php';

	?>
<style>
	input[type="number"] {

		-moz-appearance: textfield;

		-webkit-appearance: textfield;

		appearance: textfield;

	}



	input[type="number"]::-webkit-outer-spin-button,

	input[type="number"]::-webkit-inner-spin-button {

		display: none;

	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<th class="text-center">
							<label for="id">ID:</label>
						</th>
						<th class="text-center">
							<label for="title">Название:</label>
						</th>
						<th class="text-center">
							<label for="price">Цена:</label>
						</th>
						<th class="text-center">
							<label for="img">Изображение:</label>
						</th>
						<th class="text-center">
							<label for="descr">Описание:</label>
						</th>
						<th class="text-center">
							<label for="code">Код:</label>
						</th>
						<th class="text-center">
							<label for="nothing">Обновить:</label>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$stmt = $pdo->query('SELECT * FROM it_school.product;');
						while ($row = $stmt->fetch())
						{
							echo '
							<form action="update.php" method="POST">
							<tr>
								<td class="tg-0lax">
									<input class="form-control text-center" style="width: 50px;" type="number" id="id disabledTextInput" name="product_id" value="' . $row['id'] . '" disabled>
								</td>
								<td class="tg-0lax">
									<input class="form-control text-center" style="width: 150px;" type="text" id="title" name="product_title" value="' . $row['title'] . '">
								</td>
								<td class="tg-0lax">
									<input class="form-control text-center" style="width: 80px;" type="number" id="price" name="product_price" value="' . $row['price'] . '">
								</td>
								<td class="tg-0lax">
									<input class="form-control" type="text" id="img" name="product_img" value="' . $row['img'] . '">
								</td>
								<td class="tg-0lax">
									<textarea class="form-control text-center" style="min-width: 200px;" rows="5" cols="25" id="descr" name="product_descr" value="">' . $row['descr'] . '</textarea>
								</td>
								<td class="tg-0lax">
									<input class="form-control text-center" style="width: 60px;" type="number" id="code" name="product_code" value="' . $row['code'] . '">
								</td>
								<td>
									<input class="btn btn-primary float-right" type="submit" value="Обновить запись"></form>
								</td>
							<tr>
							';
						}
						?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h2>Добавление товаров</h2>
				<form action="insert.php" method="POST">
					<input type="hidden" type="text" id="qty" name="product_qty" value="1">
					<div>
						<label for="title">Название курса:</label>
						<input class="form-control" type="text" id="title" name="product_title" required>
					</div>
					<div>
						<label for="price">Цена:</label>
						<input class="form-control" type="number" id="price" name="product_price" required>
					</div>
					<div>
						<label for="img">Изображение:</label>
						<input class="form-control" type="text" id="img" name="product_img">
					</div>
					<div>
						<label for="descr">Описание:</label>
						<textarea name="product_descr" class="form-control" id="descr" cols="30" rows="10"></textarea>
					</div>
					<div>
						<label for="code">Код:</label>
						<input class="form-control" type="text" id="code" name="product_code">
					</div>
					<input class="btn btn-primary float-right mt-3" type="submit" value="Отправить в БД">
				</form>
			</div>
		</div>
	</div>
	<?php
	echo "<form action='delete.php' method='POST'><table class='table table-sm table-bordered mt-3'>";
    echo "<tr><th>id</th><th>Title</th><th>Author</th><th>Price</th><th>Discount</th><th>Удалить запись</th></tr>";
	$stmt = $pdo->query('SELECT * FROM it_school.product;');
	while ($row = $stmt->fetch())
	{
		echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>". $row['title'] ."</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['img'] . "</td>";
		echo "<td>" . $row['descr'] . "</td>";
        echo "<td>" . $row['code'] . "</td>";
        echo "<td><input type='checkbox' name='delete_row[]' value='" . $row["id"] . "'></td>";
        echo "</tr>";
	}
	echo "</table><br><input class='btn btn-primary float-right' type='submit' value='Удалить выделенные записи'></form>"; 
	?>
</div>
Авторизован! <br />
Привет, <?php echo $_SESSION['logged_admin']->login; ?>!<br />

<a href="logout.php">Выйти</a>

<?php else : ?>
<?php require_once 'login.php'; ?>
<!-- Вы не авторизованы<br />
<a href="login.php">Авторизация</a>
<a href="signup.php">Регистрация</a> -->
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
	integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
	integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>