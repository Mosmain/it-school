<?php
require 'config.php';
require 'assets/include/headerCart.php';
$grand_total = 0;
$allItems = '';
$items = [];
$sql = "SELECT CONCAT(product_name,'(',qty,')') AS ItemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
	$grand_total += $row['total_price'];
	$items[] = $row['ItemQty'];
}
$allItems = implode("<br>", $items);
?>


		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 px-4 pb-4" id="order">
					<h4 class="text-center text-info p-2">Завершите ваш заказ!</h4>
					<div class="jumbotron p-3 mb-2 text-center">
						<h6 class="lead"><b>Продукт(ы):</b><?=$allItems;?></h6>
						<h5><b>Общая сумма к оплате: </b><?=number_format($grand_total,2)?>/-</h5>
					</div>
					<form action="" method="post" id="placeOrder">
						<input type="hidden" name="product" value="<?=$allItems?>">
						<input type="hidden" name="grand_total" value="<?=$grand_total?>">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Введите Имя" required>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Введите E-mail" required>
						</div>
						<div class="form-group">
							<input type="tel" name="phone" class="form-control" placeholder="Введите Телефон" required>
						</div>
						<div class="form-group">
							<textarea name="address" class="form-control" rows="3" cols="10" placeholder="Введите Адрес доставки"></textarea>
						</div>
						<h6 class="text-center lead">Выберите способ оплаты</h6>
						<div class="form-group">
							<select name="pmode" class="form-control">
								<option value="" selected disabled>-Выберите способ оплаты-</option>
								<option value="netbanking">Интернет кошелек</option>
								<option value="cards">Дебетовая/кредитная карта</option>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Оформить заказ" class="btn btn-danger btn-block" placeholder="Введите Телефон" required>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  		<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  		<script type="text/javascript">
  			$(document).ready(function() {
  				$("#placeOrder").submit(function(e){
  					e.preventDefault();

  					var findOption = $('select[name=pmode] option:selected').val();
  					console.log(findOption)
  					if (findOption == '')
  						return alert('Выберите способ оплаты');
  					$.ajax({
  						url: 'action.php',
  						method: 'post',
  						data: $('form').serialize()+ "&action=order",
  						success: function(response){
  							$("#order").html(response);
  						}
  					});
  				});
  				load_cart_item_number();

				function load_cart_item_number(){
					$.ajax({
						url: 'action.php',
						method: 'get',
						data: {
							cartItem: "cart_item"
						},
						success: function(response){
							$('#cart-item').html(response);
						}
					});
				}
  			})
  		</script>
	</body>
</html>