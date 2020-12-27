<?php
session_start();
require 'config.php';
if (isset($_POST['pid'])) {
	$pid = $_POST['pid'];
	$pname = $_POST['pname'];
	$pprice = $_POST['pprice'];
	$pimage = $_POST['pimage'];
	$pcode = $_POST['pcode'];
	$pqty = $_POST['pqty'];
	$total_price = $pprice * $pqty;

	$stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	$stmt->bind_param('s',$pcode);
	$stmt->execute();
	$res = $stmt->get_result();
	$r = $res->fetch_assoc();
	$code = $r['product_code'] && '';

	if (!$code) {
		$query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code) VALUES (?,?,?,?,?,?)');
		$query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode);
		$query->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Товар добавлен в Вашу корзину!</strong>
		</div>';
	}
	else{
		echo '<div class="alert alert-danger alert-dismissible mt-2">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Товар уже в вашей корзине!</strong>
		</div>';
	}
} else { echo '';}
if (isset($_GET['cartItem'])&&isset($_GET['cartItem']) == 'cart_item') {
	$stmt = $conn->prepare('SELECT * FROM cart');
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;
	echo $rows;
}
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];
	$stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	$stmt->bind_param('i',$id);
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Предмет удален из корзины!';
	header('location: cart.php');
}
if (isset($_GET['clear'])) {
	$stmt = $conn->prepare('DELETE FROM cart');
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Все предметы удалены из корзины!';
	header('location:cart.php');
}
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['pprice'];
	$tprice = $qty * $pprice;
	$stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	$stmt->bind_param('isi',$qty,$tprice,$pid);
	$stmt->execute();
}
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	$all_pmode = array(
		'netbanking' => 'Интернет кошелек',
		'cards' => 'Дебетовая/кредитная карта'
	);
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$product = $_POST['product'];
	$grand_total = $_POST['grand_total'];
	$addres = $_POST['address'];
	$pmode = $all_pmode[ $_POST['pmode'] ];

	$productSql = str_replace('<br>', ', ', $product);

	$data ='';
	$stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid) VALUES (?,?,?,?,?,?,?)');
	$stmt->bind_param('sssssss',$name,$email,$phone,$addres,$pmode,$productSql,$grand_total);
	$stmt->execute();


	$stmt2 = $conn->prepare('DELETE FROM cart');
	$stmt2->execute();
	$data.='<div class="text-center">
			<h1 class="display-4 mt-2 text-danger">Спасибо!</h1>
			<h2 class="text-success">Ваш заказ успешно размещен!</h2>
			<h4 class="bg-danger text-light rounded p-2">Приобретенные товары: ' . $product . '</h4>
			<h4>Ваше Имя: '. $name .'</h4>
			<h4>Ваш  E-mail: '. $email .'</h4>
			<h4>Ваш Телефон: '. $phone .'</h4>
			<h4>Общая сумма: '. number_format($grand_total,2) .'</h4>
			<h4>Способ оплаты: '. $pmode .'</h4>
		</div>';
	echo $data;
}
?>