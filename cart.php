<?php
include_once 'errorhandler.php';
session_start();

$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');

//	if(isset($_SESSION['cart'])){
//       // $_SESSION['cart'];
//        $sid = $_GET['id'];
//        if(isset($_SESSION['cart'][$sid])){
//            $_SESSION['cart'][$sid]++;
//        } else{
//            $_SESSION['cart'][$sid] = 1;
//
//        }
//		$cart=array();
//		foreach($_SESSION['cart'] as $sid=>$quty){
//			$sql_q = "SELECT shoename, price FROM shoes
//						WHERE shoeid= $sid";
//			$stmt2=mysqli_prepare($mysqli,$sql_q);
//
//			mysqli_stmt_execute($stmt2);
//			mysqli_stmt_bind_result($stmt2,$shoename, $price);
//
//			while(mysqli_stmt_fetch($stmt2)){
//				$quty=$_SESSION['cart'][$sid];
//				if($quty=="1"){
//					$subtotal = $price;
//				} else{
//						$subtotal = $price * (int)$quty;
//				}
//
//				if(!isset($totalprice)){
//					$totalprice=0;
//				}
//
//				$cart[]=array('id' => $sid,
//					'shoename'=>$shoename,
//					'price'=>$price,
//					'quantity'=>$quty,
//					'subtotal'=>$subtotal);
//				$totalprice+=$subtotal;
//			}
//		}
//
//	}

    //echo "on cart page";
	if(isset($_GET['id']) && $_GET['action']=="add"){ //check if shoe id is set, i.e is gotten from browser
		$sid = $_GET['id'];
        //print_r($sid);
        if(isset($_SESSION['cart'][$sid])){
			$_SESSION['cart'][$sid]++;
			header("location: cart.php");
		} else{
			$_SESSION['cart'][$sid] = 1;
			header("location: cart.php");
		}
        echo $_SERVER['PHP_SELF'];
        //header("location: cart.php");
	}

	if(isset($_GET['action']) && $_GET['action']=="empty"){
        unset($_SESSION['cart']);
        header("location: cart.php");
	}

	if(isset($_GET['id']) && $_GET['action']=="remove"){
		$sid = $_GET['id'];
		unset($_SESSION['cart'][$sid]);
        
		header("location: cart.php");
	}

	if(isset($_GET['id']) && $_GET['action']=="increase") {
        $sid = $_GET['id'];
        if (isset($_SESSION['cart'][$sid])) {
            $_SESSION['cart'][$sid]++;
        }
        //header("location: cart.php");

    }

	if(isset($_GET['id']) && $_GET['action']=="decrease"){
		$sid = $_GET['id'];
		if(isset($_SESSION['cart'][$sid])){
			$_SESSION['cart'][$sid]--;
//			$cart=array();
//			foreach($_SESSION['cart'] as $sid=>$qty){
//				$sql_q = "SELECT shoename, price FROM shoes
//				WHERE shoeid = $sid";
//				$stmt1=mysqli_prepare($mysqli,$sql_q);
//
//				mysqli_stmt_execute($stmt1);
//				mysqli_stmt_bind_result($stmt1,$shoename, $price);
//
//
//				while(mysqli_stmt_fetch($stmt1)){
//					$quty=$_SESSION['cart'][$sid];
//					if($quty=="1"){
//						$subtotal = $price;
//					} else {
//						$subtotal = $price * (int)$quty;
//					}
//
//					if(!isset($totalprice)){
//						$totalprice=0;
//					}
//
//					$cart[]=array('id' => $sid,
//						'shoename'=>$shoename,
//						'price'=>$price,
//						'quantity'=>$quty,
//						'subtotal'=>$subtotal);
//
//					$totalprice+=$subtotal;
//				}
//
//			}

		}
	}

$cart=array();
if(isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $sid => $quty) {

        $sql_q = "SELECT shoename, price FROM shoes 
				WHERE shoeid = $sid";
        $stmt1 = mysqli_prepare($mysqli, $sql_q);

        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1, $shoename, $price);

        while (mysqli_stmt_fetch($stmt1)) {

            $quty = $_SESSION['cart'][$sid];
            if ($quty == "1") {
                $subtotal = $price;
            } else {
                $subtotal = $price * (int)$quty;
            }

            if (!isset($totalprice)) {
                $totalprice = 0;
            }

            $cart[] = array('id' => $sid,
                'shoename' => $shoename,
                'price' => $price,
                'quantity' => (int)$quty,
                'subtotal' => $subtotal);

            $totalprice += $subtotal;
        }
    }
}

	mysqli_close($mysqli);

	require_once'./vendor/autoload.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('./template');
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate('cart.twig');
	if(!isset($cart)){
		$cart=array();
	}

	if(!isset($totalprice)){
		$totalprice=0;
	}
    $_SESSION['total']=$totalprice;
	$params = array(
		'theCaption'=>'Choc List',
		'cart'=>$cart,
		'total'=>$totalprice
	);

	$template->display($params);

	//session_destroy();