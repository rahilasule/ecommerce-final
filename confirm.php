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



	require_once'./vendor/autoload.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('./template');
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate('confirmation.twig');
	$params = array(
        'theCaption'=>'Shoe List',
        'fname'=>$fname,
        'lname'=>$lname,
        'email'=>$email);

	$template->display($params);