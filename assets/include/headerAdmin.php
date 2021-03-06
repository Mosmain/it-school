<!doctype html>
<html lang="ru">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
		integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
		crossorigin="anonymous" />

	<!-- animate.css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<!-- Main CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Rubik:wght@300;500&display=swap"
		rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
		integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
		crossorigin="anonymous"></script>

	<title>It School</title>
</head>

<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand large-header" href="../#">
      <?php include_once("bigLogo.html"); ?>
    </a>
    <a class="navbar-brand small-header" href="../#">
      <?php include_once("miniLogo.html"); ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center header-link" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link header-link" href="../">
            <span data-content="Главная">Главная</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link header-link" href="../#course">
            <span data-content="Курсы">Курсы</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="collapse navbar-collapse justify-content-end shopping-icon" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item align-self-center"><?php echo $_SESSION['logged_admin']->login; ?></li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#auth">

          <?php if ( isset ($_SESSION['logged_admin']) ) : ?>
            <i class="fas fa-user"></i>
          <?php else : ?>
            <i class="fas fa-sign-in-alt"></i>
          <?php endif; ?>

          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<?php include('modalAdmin.php'); ?>