<?php

$data = $_POST;

// sign in

if ( isset($data['do_login']) )
{
  $user = R::findOne('users', 'login = ?', array($data['login']));
  if ( $user )
  {
    //логин существует
    if ( password_verify($data['password'], $user->password) )
    {
      //если пароль совпадает, то нужно авторизовать пользователя
      $_SESSION['logged_user'] = $user;
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Вы успешно вошли!</strong> Повторно нажмите на кнопку авторизации, чтобы войти в личный кабинет
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      ';
    }
    else {
      $errors[] = 'Неверно введен пароль!';
    }

  }else
  {
    $errors[] = 'Пользователь с таким логином не найден!';
  }

  if ( ! empty($errors) )
  {
    //выводим ошибки авторизации
    echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
  }
}



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
  }else
  {
    echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
  }
}

if ( isset($data['do_logout']) ) {
  unset($_SESSION['logged_user']);
}

$outModal = "";

if ( isset ($_SESSION['logged_user']) ) {
  $outModal = "Добро пожаловать, " . $_SESSION['logged_user']->login;
} else {
  $outModal = "Войдите";
}


?>

<!-- <?php if ( isset ($_SESSION['logged_user']) ) : ?>
TRUE
<?php else : ?>
FALSE
<?php endif; ?> -->

<div class="modal fade" id="auth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $outModal; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if ( isset ($_SESSION['logged_user']) ) : ?>
        Авторизован! <br />
        Привет, <?php echo $_SESSION['logged_user']->login; ?>!<br />

        <a href="/it-school/admin/logout.php">Выйти</a>

      </div>
      <div class="modal-footer">

        <?php else : ?>
        Вы не авторизованы<br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal"
          data-target="#sign-in">Авторизация</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
          data-target="#sign-up">Регистрация</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $outModal; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="./" method="POST">
        <div class="modal-body">
          <strong>Ваш логин</strong>
          <input type="text" name="login" value="<?php echo @$data['login']; ?>"><br />

          <strong>Ваш Email</strong>
          <input type="email" name="email" value="<?php echo @$data['email']; ?>"><br />

          <strong>Ваш пароль</strong>
          <input type="password" name="password" value="<?php echo @$data['password']; ?>"><br />

          <strong>Повторите пароль</strong>
          <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>"><br />

          <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-primary" name="do_signup">Создать аккаунт</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal"
            data-target="#sign-in">Авторизация</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="sign-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $outModal; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./" method="POST">
          <strong>Логин</strong>
          <input type="text" name="login" value="<?php echo @$data['login']; ?>"><br />

          <strong>Пароль</strong>
          <input type="password" name="password" value="<?php echo @$data['password']; ?>"><br />

          <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-primary" name="do_login">Войти</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal"
          data-target="#sign-up">Регистрация</button>
      </div>
    </div>
  </div>
</div>