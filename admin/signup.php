<?php 
	require 'db.php';

	$data = $_POST;

	//если кликнули на button
	if ( isset($data['do_signup']) )
	{
    // проверка формы на пустоту полей
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Введите Email';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Повторный пароль введен не верно!';
		}

		//проверка на существование одинакового логина
		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
    
    //проверка на существование одинакового email
		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Пользователь с таким Email уже существует!';
		}

		if ( empty($errors) )
		{
			//ошибок нет, теперь регистрируем
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
			R::store($user);
			echo '<div style="color:dreen;">Вы успешно зарегистрированы!</div><hr>';
			header("Location: login.php");
		}else
		{
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>

<form action="signup.php" method="POST">
	<strong>Ваш логин</strong>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

	<strong>Ваш Email</strong>
	<input type="email" name="email" value="<?php echo @$data['email']; ?>"><br/>

	<strong>Ваш пароль</strong>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

	<strong>Повторите пароль</strong>
	<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>"><br/>

	<button type="submit" name="do_signup">Регистрация</button>
</form>