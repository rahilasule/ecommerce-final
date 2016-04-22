<?php
include_once 'errorhandler.php';
/**
 * Created by PhpStorm.
 * User: rahilasule
 * Date: 4/20/16
 * Time: 12:19 AM
 */
	session_start();

	$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');
	$noerror="true";
	$firstname = "";
	$lastname = "";
	$add = "";
	$city = "";
	$state = "";
	$zcode = "";
	$cty = "";
	$phone = "";
	$email = "";
	$firstnameErr = $lastnameErr = $addErr = $emailErr = $cityErr = $stateErr = $zcodeErr = $ctyErr = $phoneErr = "";

	function test_input($data) {
		$mysqli = mysqli_connect('localhost' , 'root', '','shoedb');
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlentities($data);
		$data = strip_tags($data);
		$data = mysqli_real_escape_string($mysqli, $data);
		return $data;
	}

	
	if(isset($_SESSION['firstnameErr'])){
		unset($_SESSION['firstnameErr']);
	}
	
	if(isset($_SESSION['lastnameErr'])){
		unset($_SESSION['lastnameErr']);
	}
	
	if(isset($_SESSION['addErr'])){
		unset($_SESSION['addErr']);
	}

	if(isset($_SESSION['cityErr'])){
		unset($_SESSION['cityErr']);
	}

	if(isset($_SESSION['stateErr'])){
		unset($_SESSION['stateErr']);
	}

	if(isset($_SESSION['zcodeErr'])){
		unset($_SESSION['zcodeErr']);
	}

	if(isset($_SESSION['ctyErr'])){
		unset($_SESSION['ctyErr']);
	}

	if(isset($_SESSION['phoneErr'])){
		unset($_SESSION['phoneErr']);
	}

	if(isset($_SESSION['emailErr'])){
		unset($_SESSION['emailErr']);
	}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_REQUEST["firstname"])) {
		$_SESSION['firstnameErr'] = "Firstname is required";
	} else {
		$firstname = test_input($_REQUEST["firstname"]);
		$_SESSION['firstname'] = $firstname;
		if (!preg_match("/^([a-zA-Z]*)$/", $firstname)) {
			$_SESSION['firstnameErr'] = "Only letters allowed";
			$noerror = "false";
			header("location:form.php");
		}
	}

		if (empty($_REQUEST["lastname"])) {
			$_SESSION['lastnameErr'] = "Lastname is required";
		} else {
			$lastname = test_input($_REQUEST["lastname"]);
			$_SESSION['lastname'] = $lastname;
			if (!preg_match("/^([a-zA-Z]*)$/", $lastname)) {
				$_SESSION['lastnameErr'] = "Only letters allowed";
				$noerror = "false";
				header("location:form.php");
			}
		}

		if (empty($_REQUEST["address"])) {
			$_SESSION['addErr'] = "Address is required";
		} else {
			$address = test_input($_REQUEST["address"]);
			$_SESSION['address'] = $address;
			if (!preg_match("/^([0-9a-zA-Z\,\s]*)$/", $address)) {
				$_SESSION['addErr'] = "Only letters, space and comma allowed";
				$noerror = "false";
				header("location:form.php");
			}
		}


		if (empty($_REQUEST["city"])) {
			$_SESSION['cityErr'] = "City is required";
		} else {
			$city = test_input($_REQUEST["city"]);
			$_SESSION['city'] = $city;
			if (!preg_match("/^([a-zA-Z]*)$/", $city)) {
				$_SESSION['cityErr'] = "Only letters allowed";
				$noerror = "false";
				header("location:form.php");
			}
		}

		if (empty($_REQUEST["state"])) {
			$_SESSION['stateErr'] = "State is required";
		} else {
			$state = test_input($_REQUEST["state"]);
			$_SESSION['state'] = $state;
			if (!preg_match("/^([a-zA-Z]*)$/", $state)) {
				$_SESSION['stateErr'] = "Only letters allowed";
				$noerror = "false";
				header("location:form.php");
			}
		}



	if (empty($_REQUEST["country"])) {
		$_SESSION['ctyErr'] = "Country is required";
	} else {
		$cty = test_input($_REQUEST["country"]);
		$_SESSION['country'] = $cty;
		if (!preg_match("/^([a-zA-Z]*)$/", $cty)) {
			$_SESSION['ctyErr'] = "Only letters allowed";
			$noerror = "false";
			header("location:form.php");
		}
	}


	if (empty($_REQUEST["phone"])) {
		$_SESSION['phoneErr'] = "Phonenumber is required";
	} else {
		$phone = test_input($_REQUEST["phone"]);
		$_SESSION['phone'] = $phone;
		if (!preg_match("/^\d{3}[]*\d{3}[]*\d{4}$/", $phone)) {
			$_SESSION['phoneErr'] = "Invalid phone number";
			$noerror = "false";
			header("location:form.php");
		}
	}

	if (empty($_REQUEST["email"])) {
		$_SESSION['emailErr'] = "Email is required";
	} else {
		$email = test_input($_REQUEST["email"]);
		$_SESSION['email'] = $email;
		if (!preg_match("/^[^0-9_][a-z0-9]+([.][a-z0-9_]+)*[@][a-z0-9_]+([.][a-z0-9]+)*[.][a-z]{2,4}$/", $email)) {
			$_SESSION['emailErr'] = "Only numbers allowed";
			$noerror = "false";
			header("location:form.php");
		}
	}

	}

if($noerror=="true") {
	$email = $_REQUEST['email'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$add = $_REQUEST['address'];
	$city = $_REQUEST['city'];
	$state = $_REQUEST['state'];
	$zcode = $_REQUEST['zipcode'];
	$cty = $_REQUEST['country'];
	$phone = $_REQUEST['phone'];



	$str_query1 = "INSERT INTO customers SET lastname='$lastname', firstname='$firstname', address='$add', city='$city',
			state='$state', zipcode='$zcode', country='$cty', phone='$phone', email='$email'";

	$stmt1 = mysqli_prepare($mysqli, $str_query1);
	mysqli_stmt_execute($stmt1);

	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['email'] = $email;

	$str_query = "SELECT customerid FROM customers ORDER BY customerid DESC LIMIT 1";
	$st = mysqli_query($mysqli, $str_query);
	$row = mysqli_fetch_row($st);
	$cid = $row[0];
	$query = "INSERT INTO orders SET customerid=$cid, date = DATE(CURDATE())";
	$stmt2 = mysqli_prepare($mysqli, $query);
	mysqli_stmt_execute($stmt2);
	$_SESSION['cid'] = $cid;
	$st_query = "SELECT orderid FROM orders ORDER BY orderid DESC LIMIT 1";
	$str = mysqli_query($mysqli, $st_query);
	$row = mysqli_fetch_row($str);
	$oid = $row[0];

	$cart = array();
	if (isset($_SESSION['cart'])) {

		//print_r($_SESSION['cart']);

		foreach ($_SESSION['cart'] as $sid => $quty) {

			$sql_q_2 = "SELECT price FROM shoes 
				WHERE shoeid = $sid";

			$str_2 = mysqli_query($mysqli, $sql_q_2);
			$row = mysqli_fetch_row($str_2);
			//echo "sid: ".$sid." !";
			$price = $row[0];
			//echo " price: ".$price."";

			$cart[] = array('id' => $sid,
				'quantity' => (int)$quty);

			$sql_q = "INSERT INTO items(orderid, shoeid, qty, price) VALUES($oid, $sid, $quty, $price)";
			$stmt1 = mysqli_prepare($mysqli, $sql_q);

			mysqli_stmt_execute($stmt1);

		}
	}
	header("location:confirm.php");
}
//header("location:form.php");
