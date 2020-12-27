<?php
session_start();
require 'assets/include/headerCart.php'
?>


<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div style="display: <?php
								if(isset($_SESSION['showAlert']))
									echo $_SESSION['showAlert'];
								else
									echo 'none';
								unset($_SESSION['showAlert']);?>" class="alert alert-success alert-dis,issible mt-3">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>
					<?php
						if (isset($_SESSION['message']))
							echo $_SESSION['message'];
						unset($_SESSION['showAlert'])
					?>
				</strong>
			</div>
			<div class="table-responsive mt-2">
				<table class="table table-bordered table-dark text-center">
					<thead>
						<tr>
							<td colspan="7">
								<h4 class="text-center text-info m-0">Товары в вашей корзине!</h4>
							</td>
						</tr>
						<tr>
							<th colspan="3">Фото</th>
							<th colspan="2">Продукт</th>
							<th>Стоимость</th>
							<th>
								<a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Вы уверены, что хотите очистить корзину?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Очистить корзину</a>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							require 'config.php';
							$stmt = $conn->prepare('SELECT * FROM cart');
							$stmt->execute();
							$result = $stmt->get_result();
							$grand_total = 0;
							while ($row = $result->fetch_assoc()):
						?>
						<tr>
							<input type="hidden" class="pid" value="<?=$row['id']?>">
							<td colspan="3"><img src="<?=$row['product_image']?>" width="100"></td>
							<td colspan="2"><?=$row['product_name']?></td>
							<input type="hidden" class="pprice" value="<?=$row['product_price']?>">
							<td><i class="fas fa-ruble-sign"></i>&nbsp;&nbsp;<?=number_format($row['total_price'],2);?></td>
							<td>
								<a href="action.php?remove=<?=$row['id']?>" class="text-danger lead" onclick="return confirm('Вы уверены, что хотите удалить данный товар из корзины?');"><i class="fas fa-trash-alt h1"></i></a>
							</td>
						</tr>
						<?php $grand_total+=$row['total_price']; ?>
						<?php endwhile;?>
						<tr>
							<td colspan="3">
								<a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Продолжить покупки</a>
							</td>
							<td colspan="2"><b>Общий итог</b></td>
							<td><b><i class="fas fa-ruble-sign"></i>&nbsp;&nbsp;<?=number_format($grand_total,2);?></b></td>
							<td>
								<a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled' ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Оплатить</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".itemQty").on('change',function(){
			var $el = $(this).closest("tr");

			var pid = $el.find(".pid").val();
			var pprice = $el.find(".pprice").val();
			var qty = $form.find(".itemQty").val();
			location.reload(true);

			$.ajax({
				url: 'action.php',
				method: 'post',
				cache: false,
				data: {
					qty: qty,
					pid: pid,
					pprice: pprice
				},
				success: function(response){
					console.log(response);
				}
			});
		});
		load_cart_item_number();
		function load_cart_item_number(){
			$.ajax({
				url: 'action.php',
				method: 'get',
				data:{
					cartIem: "cart_item"
				},
				succes: function(response){
					$('#cart-item').html(response);
			}
		});
		}
	});
</script>
</body>
</html>