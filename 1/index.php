<?php

class ServiceTwig {

    static function getService() {
        return "./vendor/autoload.php";
    }

}

class TemplateName {

    static function getService() {
        return "templates";
    }

}

class TwigView {

    protected $twig;
    protected $loader;
    protected $cache;
    protected $autoReload;
    protected $context;
    protected $template;
    protected $params;

    public function __construct($autoloadPath, $TemplatesPath, $template) {
        require_once $autoloadPath;
        $this->context = array();
        $this->template = $template;
        $this->loader = new Twig_Loader_Filesystem($TemplatesPath);
        $this->cache = 'compilation_cache';
        $this->autoReload = true;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function setCache(string $value) {
        $this->cache = $value;
        return $this;
    }

    public function setAutoReload(bool $value) {
        $this->autoReload = $value;
        return $this;
    }

    public function build() {
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => $this->cache,
            'auto_reload' => $this->autoReload
        ));
        return $this;
    }

    public function get() {
        
    }

    public function post() {
        
    }

//echo $this->twig->render($this->template, $this->getContext());
}
class View{
    function get(){
        
    }
    function post(){
        
    }
}
class HelloView extends View {
    
    function get() {
        echo "hello";
    }

}

$uri = $_SERVER['REQUEST_URI'];
$array = array();


array_push($array, array(
    'pattern' => "/^\/hello\/$/",
    'func' => function() {
        $view = new HelloView();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view->get();
        }
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
