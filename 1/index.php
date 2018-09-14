<?php

class ServiceTwig {

    static function getService() {
        require_once './vendor/autoload.php';
        $loader = new Twig_Loader_Filesystem('templates');
        $twig = new Twig_Environment($loader, array(
            'cache' => 'compilation_cache',
            'auto_reload' => true
        ));
        return $twig;
    }

}

$uri = $_SERVER['REQUEST_URI'];
$array = array();
array_push($array, array(
    'pattern' => '/^\/def\/save\/?$/',
    'func' => function() {
        $twig = ServiceTwig::getService();
        echo $twig->render('index.html', array('msg' => "hello"));
    }));
    
array_push($array, array(
    'pattern' => '/^\/def\/del\/(\d+)\/(\d+)$/',
    'func' => function($number, $number2) {
        echo $number;
        echo '<br>';
        echo $number2;
    }));



$flag = true;
foreach ($array as $key => $value) {
    if (preg_match($value['pattern'], $uri, $matches)) {
        array_shift($matches);
        $value['func'](...$matches);
        $flag = false;
        break;
    }
}
if ($flag) {
    echo 'error';
}
