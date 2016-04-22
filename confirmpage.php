<?php
/**
 * Created by PhpStorm.
 * User: rahilasule
 * Date: 4/22/16
 * Time: 1:36 PM
 */
session_start();
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

require_once'./vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('confirmation.twig');
$params = array(
    'theCaption'=>'Shoe List',
    'fname'=>$fname,
    'lname'=>$lname,
    'email'=>$email,
    'total'=>$total);

$template->display($params);