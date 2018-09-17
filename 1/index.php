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
    protected $autoloadPath;

    public function __construct() {
        $this->context = array();
        $this->cache = 'compilation_cache';
        $this->autoReload = true;
    }

    public function setAutoloadPath(string $autoloadPath) {

        $this->autoloadPath = $autoloadPath;
    }

    public function setTemplatesPath($TemplatesPath) {
        require_once $this->autoloadPath;
        $this->loader = new Twig_Loader_Filesystem($TemplatesPath);
    }

    public function setTemplate($tempalte) {
        $this->template = $tempalte;
    }

    public function setParams(array $params) {
        $this->params = $params;
    }

    public function setCache(string $value) {
        $this->cache = $value;
    }

    public function setAutoReload(bool $value) {
        $this->autoReload = $value;
    }

    public function setContext($context) {
        $this->context = $context;
    }

    public function setTwigEnvironment() {
        require_once $this->autoloadPath;
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => $this->cache,
            'auto_reload' => $this->autoReload
        ));
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

class TwigViewBuilder {

    protected $twigView;
    protected $className;

    public function __construct(string $className) {
        $this->className = $className;
    }

    public function getTwigView(): TwigView {
        return $this->twigView;
    }

    public function createTwigView() {
        $this->twigView = new $this->className;
    }

}

class TwigViewAutoReloadTrueBuilder extends TwigViewBuilder {

    public function buildAutoReload() {
        $this->twigView->setAutoReload(true);
    }

    public function buildTemplatePath() {

        $this->twigView->setTemplatesPath('templates');
    }

    public function buildAutoloadPath() {

        $this->twigView->setAutoloadPath("./vendor/autoload.php");
    }
    
    public function buildCache(){
        $this->twigView->setCache('compilation_cache');
    }

    public function BuildTwigEnvironment() {
        $this->twigView->setTwigEnvironment() ;
    }

}

class Director {

    private $twigBuilder;

    public function setTwigBuilder(TwigViewBuilder $twigBuilder) {
        $this->twigBuilder = $twigBuilder;
    }

    public function getTwigView(): TwigView {
        return $this->twigBuilder->getTwigView();
    }

    public function constructTwigView() {

        $this->twigBuilder->createTwigView();
        $this->twigBuilder->buildAutoLoadPath();
        $this->twigBuilder->buildTemplatePath();
        $this->twigBuilder->buildAutoReload();
        $this->twigBuilder->buildCache();
        $this->twigBuilder->buildTwigEnvironment();
    }

}

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
