<?php
include_once 'errorhandler.php';
/**
 * Created by PhpStorm.
 * User: rahilasule
 * Date: 4/20/16
 * Time: 2:00 AM
 */
session_start();
	include_once("./PHPMailer-master/PHPMailerAutoload.php");
	include_once("mail.php");
	if(isset($_SESSION['total'])){
		$total = $_SESSION['total'];
	}else {
		$total = 0;
	}
    
    $total = $_SESSION['total'];
    $email = $_SESSION['email'];
	$fname=$_SESSION['firstname'];
	$lname=$_SESSION['lastname'];
    $cid = $_SESSION['cid'];
//echo $email;
//echo $fname;
//echo $lname;
//echo $cid;
	$mail = new Mail();
	$mail->sendMail($fname,$lname,$email);

header("location: confirmpage.php");
