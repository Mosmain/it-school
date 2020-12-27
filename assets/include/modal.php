<?php

$data = $_POST;

if ( isset($data['do_login']) )
{
  $user = R::findOne('users', 'login = ?', array($data['login']));
  if ( $user )
  {
    if ( password_verify($data['password'], $user->password) )
    {
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
      $errors[] = '
        <strong>Неверно введен пароль!</strong>
      ';
    }

  }else
  {
    $errors[] = '
      <strong>Пользователь с таким логином не найден!</strong>
  ';
  }

  if ( ! empty($errors) )
  {
    echo
    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
    .array_shift($errors).
    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  }
}

if ( isset($data['do_signup']) )
{
  $errors = array();

  if ( trim($data['login']) == '' )
  {
    $errors[] = '
      <strong>Введите логин</strong>
    ';
  }

  if ( trim($data['email']) == '' )
  {
    $errors[] = '
      <strong>Введите Email</strong>
    ';
  }

  if ( $data['password'] == '' )
  {
    $errors[] = '
      <strong>Введите пароль</strong>
    ';
  }

  if ( $data['password_2'] != $data['password'] )
  {
    $errors[] = '
      <strong>Повторный пароль введен не верно!</strong>
    ';
  }

  if ( R::count('users', "login = ?", array($data['login'])) > 0)
  {
    $errors[] = '
      <strong>Пользователь с таким логином уже существует!</strong>
    ';
  }

  if ( R::count('users', "email = ?", array($data['email'])) > 0)
  {
    $errors[] = '
      <strong>Пользователь с таким логином уже существует!</strong>
    ';
  }

  if ( empty($errors) )
  {
    $user = R::dispense('users');
    $user->login = $data['login'];
    $user->email = $data['email'];
    $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
    R::store($user);
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Вы успешно зарегистрированы!</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';
  }else
  {
    echo
    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
    .array_shift($errors).
    ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
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