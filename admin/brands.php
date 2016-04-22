<?php
include_once '../errorhandler.php';
	session_start();
    $total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
	$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');

	if (isset($_GET['page'])) {
	   $page = $_GET['page'];
	} else {
	   $page = 1;

	}
    $brand = $_GET['action'];
	$str_query= mysqli_query($mysqli, "SELECT * FROM shoes INNER JOIN brand ON shoes.brandid=brand.brandid 
                                          WHERE brand.brandname LIKE '$brand%'");
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
	$myarray = array();


	if(isset($_GET['action']) && $_GET['action']=="all"){
		$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
				INNER JOIN brand ON shoes.brandid=brand.brandid
				ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}

	}

if(isset($_GET['action']) && $_GET['action']=="nike"){
    $str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
				INNER JOIN brand ON shoes.brandid=brand.brandid
				WHERE shoes.brandid = 1
				ORDER BY shoes.shoeid $limit";
    $stmt = mysqli_prepare($mysqli, $str_query);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

    $myarray = array();
    while(mysqli_stmt_fetch($stmt)){
        $myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
    }

}
	if(isset($_GET['action']) && $_GET['action']=="puma"){
		$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
				INNER JOIN brand ON shoes.brandid=brand.brandid
				WHERE shoes.brandid = 2
				ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}

	}

	if(isset($_GET['action']) && $_GET['action']=="zara"){
		$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
				INNER JOIN brand ON shoes.brandid=brand.brandid
				WHERE shoes.brandid = 3
				ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}
	}

	if(isset($_GET['action']) && $_GET['action']=="hm"){
		$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
				INNER JOIN brand ON shoes.brandid=brand.brandid
				WHERE shoes.brandid = 4
				ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}

	}

	if(isset($_GET['action']) && $_GET['action']=="converse"){
		$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
				INNER JOIN brand ON shoes.brandid=brand.brandid
				WHERE shoes.brandid = 5
				ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}

	}


	if(isset($_GET['action']) && $_GET['action']=="new"){
	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			INNER JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoes.brandid = 6
			ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}

	}

	if(isset($_GET['action']) && $_GET['action']=="adidas"){
	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			INNER JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoes.brandid = 7
			ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}
	}

	if(isset($_GET['action']) && $_GET['action']=="saucony"){
	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			INNER JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoes.brandid = 8
			ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}
	}

	if(isset($_GET['action']) && $_GET['action']=="asics"){
	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			INNER JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoes.brandid = 9
			ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}
	}

	if(isset($_GET['action']) && $_GET['action']=="brooks"){
	$str_query="SELECT shoeid, shoename, brand.brandname, price FROM shoes 
			INNER JOIN brand ON shoes.brandid=brand.brandid
			WHERE shoes.brandid = 10
			ORDER BY shoes.shoeid $limit";
		$stmt = mysqli_prepare($mysqli, $str_query);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $shoeid, $shoename, $brandname, $price);

		$myarray = array();
		while(mysqli_stmt_fetch($stmt)){
			$myarray[]=array('shoeid'=>$shoeid,'shoename' =>$shoename , 'brand_name'=>$brandname, 'price'=>$price);
		}
	}



	require_once'./vendor/autoload.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('./template');
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate('brands.twig');
		$params = array('brandname'=>$brand,
		'values'=>$myarray,
		'page'=>$page,
		'lastpage'=>$lastpage,
		'prev'=>$prevpage,
		'next'=>$nextpage,
		'pages'=>$pages);

	$template->display($params);

	