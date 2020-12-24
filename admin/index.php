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