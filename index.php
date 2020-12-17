	<!-- include header -->
	<?php

	require_once('./admin/db.php');

	include_once("assets/include/header.php");

	?>

	<section class="main-section">

		<svg class="animate__animated animate__fadeInDown animate__slow" width="100vw" height="745" viewBox="0 0 100 709"
			fill="none" xmlns="http://www.w3.org/2000/svg">
			<path
				d="M55.6009 327.192L488.557 17.326C523.735 -7.84009 582.408 8.46156 587.152 62.6793L634.37 602.393C638.626 651.033 588.4 684.966 545.149 664.178L64.9743 434.331C22.1468 413.898 16.8425 354.763 55.6009 327.192Z"
				fill="#F4F4F4" />
		</svg>

		<div class="container">
			<div class="row">

				<div class="col-md-12 col-lg-4 write-code">
					<div class="under">
						<div class="code-block">
							<span id="typed" style="white-space:pre;"></span>
						</div>
					</div>
					<div class="modal-btn">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
							КАК МЫ РАБОТАЕМ
						</button>
					</div>
				</div>

				<div class="col-md-12 col-lg-8 desc-block">
					<h1 class="desc-main">
						Одна из крупнейших IT школ России<br>
						Лучшие специалисты<br>
						Приятные цены
					</h1>
				</div>
			</div>
		</div>

		<!-- <div class="container-fluid mArrow">
			<div class="row">
				<div class="col-12 arrow-block">
					<div class="arrow">
						<a href="#">
							<svg class="onArrowBox" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path class="onArrow"
									d="M18.7046 29.5779L3.86991 14.7432C3.15445 14.0277 3.15445 12.8678 3.86991 12.1524L5.60014 10.4221C6.31438 9.7079 7.47196 9.70652 8.18788 10.4191L20 22.1759L31.8121 10.4191C32.528 9.70652 33.6856 9.7079 34.3998 10.4221L36.1301 12.1524C36.8455 12.8678 36.8455 14.0278 36.1301 14.7432L21.2955 29.5779C20.58 30.2933 19.42 30.2933 18.7046 29.5779Z"
									fill="#3A3A3A" fill-opacity="0.5" />
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div> -->

	</section>

	<section class="buy-section">
		<h1>ВЫБЕРИ СВОЙ КУРС</h1>
		<div class="container">

			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

				<?php
				$stmt = $pdo->query('SELECT * FROM it_school.cards;');
				while ($row = $stmt->fetch())
				{
					echo '<div class="col mb-4">
					<div class="card">
						<img src="' . $row['img'] . '" class="card-img-top" alt="...">
						<div class="title">
							<h5 class="card-title">' . $row['title'] . '</h5>
						</div>
						<div class="price">
							<h6>от <big>' . $row['price'] . '₽</big> /мес</h6>
						</div>
						<div class="card-body">
							<p class="card-text">' . $row['descr'] . '</p>
						</div>
						<div class="button-card">
							<button type="button" class="btn btn-light">Купить</button>
						</div>
					</div>
				</div>';
				}
				?>
			</div>
		</div>

	</section>

	<section class="slider-pro">

	</section>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-12 location">
					<div class="phone">
						<i class="fas fa-phone"></i>
						<span>+7 999 888 7765</span>
					</div>

					<div class="map">
						<i class="fas fa-map-marked-alt"></i>
						<span>г. Ульяновск, бульвар Новосондецкий, д. 20</span>
					</div>
				</div>
				<div class="col-md-4 col-12 social-link">
					<a href="#"><i class="fab fa-telegram"></i></a>
					<a href="#"><i class="fab fa-whatsapp-square"></i></a>
					<a href="#"><i class="fab fa-twitter-square"></i></a>
				</div>
			</div>
		</div>
		<div class="copyright w-100 text-center">
			<span>© 2020, Mosmain inc.</span>
		</div>
	</footer>



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
		integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.1/typed.min.js"></script>
	<script src="assets/js/console.js"></script>
</body>

</html>