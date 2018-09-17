<?php

class AutoLoadPath {

    static function getService() {
        return "./vendor/autoload.php";
    }

}

class TemplatePath {

    static function getService() {
        return "templates";
    }

}

class TwigView extends View {

    protected $twig;
    protected $loader;
    protected $cache;
    protected $autoReload;
    protected $context;
    protected $template;
    protected $params;

    public function __construct() {
        $this->context = array();
        $this->cache = 'compilation_cache';
        $this->autoReload = true;
        return $this;
    }

    public function setAutoloadPath($autoloadPath) {
        require_once $autoloadPath;
        return $this;
    }

    public function setTemplatesPath($TemplatesPath) {
        $this->loader = new Twig_Loader_Filesystem($TemplatesPath);
        return $this;
    }

    public function setTemplate($tempalte) {
        $this->template = $tempalte;
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

    public function setContext($context) {
        $this->context = $context;
        return $this;
    }

    public function build() {
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => $this->cache,
            'auto_reload' => $this->autoReload
        ));
        return $this;
    }

    protected function getContext(): array {
        return $this->context;
    }

    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }

//
}

class View {

    function get() {
        
    }

    function post() {
        
    }

}

class HelloView extends TwigView {

    function __construct() {
        parent::__construct();
        $this->setTemplate("index.html");
    }

    function getContext(): array {
        $this->context["msg"] = "Hello world";
        return $this->context;
    }

}

$uri = $_SERVER['REQUEST_URI'];
$array = array();


array_push($array, array(
    'pattern' => "/^\/hello\/$/",
    'class' => 'HelloView',
    'func' => function(HelloView $view) {
        $view->setAutoloadPath(AutoLoadPath::getService());
        $view->setTemplatesPath(TemplatePath::getService());
        $view->build();
    }));

$flag = true;
foreach ($array as $key => $value) {
    if (preg_match($value['pattern'], $uri, $matches)) {
        array_shift($matches);
        $className = $value['class'];
        $view = new $className();
        $value['func']($view);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view->get();
        }

        $flag = false;
        break;
    }
}
if ($flag) {
    echo 'error';
}
