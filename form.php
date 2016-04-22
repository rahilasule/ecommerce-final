<?php
    include_once 'errorhandler.php';
    session_start();
    if(isset($_SESSION['total'])){
        $total = $_SESSION['total'];
    }else {
        $total = 0;
    }
    $mysqli = mysqli_connect('localhost' , 'root', '','shoedb');

    require_once'./vendor/autoload.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('./template');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('checkout.twig');
    $params = array(
        'theCaption'=>'Shoes list',
        'total'=>$total);

    $template->display($params);
