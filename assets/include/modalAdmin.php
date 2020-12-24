<?php

$data = $_POST;

if ( isset($data['do_login']) )
{
  $user = R::findOne('admin', 'login = ?', array($data['login']));
  if ( $user )
  {
    //логин существует
    if ( password_verify($data['password'], $user->password) )
    {
      //если пароль совпадает, то нужно авторизовать пользователя
      $_SESSION['logged_admin'] = $user;
    }
  }

}


if ( isset($data['do_logout']) ) {
  unset($_SESSION['logged_admin']);
}

$outModal = "";

if ( isset ($_SESSION['logged_admin']) ) {
  $outModal = "Добро пожаловать, " . $_SESSION['logged_admin']->login;
} else {
  $outModal = "Войдите";
}


?>

<!-- <?php if ( isset ($_SESSION['logged_admin']) ) : ?>
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
        <?php if ( isset ($_SESSION['logged_admin']) ) : ?>
        Авторизован! <br />
        Привет, <?php echo $_SESSION['logged_admin']->login; ?>!<br />

        <a href="/it-school/admin/logoutAdmin.php">Выйти</a>

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
