<?php
include_once '../errorhandler.php';
	session_start();
if(isset($_SESSION['total'])){
	$total = $_SESSION['total'];
}else {
	$total = 0;
}
	$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');

	if (isset($_GET['page'])) {
	   $page = $_GET['page'];
	} else {
	   $page = 1;

	}
	//$mysqli = mysqli_connect('localhost' , 'root', '','chocolateDatabase');
	$str_query= mysqli_query($mysqli, "SELECT * FROM shoes WHERE shoetype ='women'");
	$numrows= mysqli_num_rows($str_query);

	$rows_per_page = 12;
	$lastpage = ceil($numrows/$rows_per_page);
	$prevpage = $page-1;
	$nextpage= $page+1;
	//$lastbut1=$lastpage-1;
	//$adjacents=3;
	$pages = $lastpage;

	$page = (int)$page; //convert to int so that comparison is done for integers and not strings
	
	if ($page > $lastpage) {
	   $page = $lastpage;
	} 
	if ($page < 1) {
	   $page = 1;
	}
	$limit = 'LIMIT ' .($page - 1) * $rows_per_page .',' .$rows_per_page;

	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoetype ='women'
			ORDER BY shoes.shoeid $limit";

	$stmt=mysqli_prepare($mysqli, $str_query);
			
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);
	
	$myarray = array();
	while(mysqli_stmt_fetch($stmt)){
		$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
	}
       
	mysqli_close($mysqli);

require_once'./vendor/autoload.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('./template');
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate('women.twig');
		$params = array('total'=>$total,
		'values'=>$myarray,
		'page'=>$page,
		'lastpage'=>$lastpage,
		'prev'=>$prevpage,
		'next'=>$nextpage,
		'pages'=>$pages);

	$template->display($params);

	
?>