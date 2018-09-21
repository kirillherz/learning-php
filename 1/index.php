<?php

$uri = $_SERVER['REQUEST_URI'];
$array = array();

spl_autoload_register(function ($class_name) {
    include "./views/" . $class_name . '.php';
});

include_once "./builders/TwigViewBuilder.php";

array_push($array, array(
    'pattern' => "/^\/hello\/(\d+)$/",
    'class' => 'HelloView',
    'func' => function(string $className) {
        $director = new Director();
        $director->setTwigBuilder(new TwigViewAutoTemplateAndAutoLoadPath($className));
        $director->constructTwigView();
        return $director->getTwigView();
    }));

array_push($array, array(
    'pattern' => "/^\/summa\/?$/",
    'class' => 'SummaView',
    'func' => function(string $className) {
        $director = new Director();
        $director->setTwigBuilder(new TwigViewAutoTemplateAndAutoLoadPath($className));
        $director->constructTwigView();
        return $director->getTwigView();
    }));

array_push($array, array(
    'pattern' => "/^\/result\/?$/",
    'class' => 'ResultView',
    'func' => function(string $className) {
        $director = new Director();
        $director->setTwigBuilder(new TwigViewAutoTemplateAndAutoLoadPath($className));
        $director->constructTwigView();
        return $director->getTwigView();
    }));
array_push($array, array(
    'pattern' => "/^\/test\/?$/",
    'class' => 'TestDbView',
    'func' => function(string $className) {
        $director = new Director();
        $director->setTwigBuilder(new TwigViewAutoTemplateAndAutoLoadPath($className));
        $director->constructTwigView();
        return $director->getTwigView();
    }));

$flag = true;
foreach ($array as $key => $value) {
    if (preg_match($value['pattern'], $uri, $matches)) {
        array_shift($matches);
        $className = $value['class'];
        $view = $value['func']($className);
        $view->setParams($matches);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view->get();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $view->post();
        }

        $flag = false;
        break;
    }
}
if ($flag) {
    echo 'error';
}
