<?php
include_once '../errorhandler.php';
	session_start();
if(isset($_SESSION['total'])){
	$total = $_SESSION['total'];
}else {
	$total = 0;
}
	$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');

	$sid = $_REQUEST['id'];
	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoeid = $sid";

	$stmt=mysqli_prepare($mysqli, $str_query);
			
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);
	mysqli_stmt_fetch($stmt);

       
	mysqli_close($mysqli);

require_once'./vendor/autoload.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('./template');
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate('single.twig');
		$params = array(
		'shoeid'=>$shoeid,
		'shoename' =>$shoename , 
		'brand_name'=>$brandname, 
		'price'=>$price
		);

	$template->display($params);
