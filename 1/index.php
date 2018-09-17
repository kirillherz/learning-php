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

class TwigTemplateView {

    private $twig;
    private $loader;
    private $cache;
    private $autoReload;
    protected $context;
    private $template;
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

    public function setContext(array $context) {
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

    public function getContext(): array {
        return $this->context;
    }

    public function get() {
        echo "get";
    }

    public function post() {
        echo "post";
    }

    public function run() {
        echo $this->twig->render($this->template, $this->getContext());
    }

}

class HelloView extends TwigTemplateView {

    function getContext(): array {
        $this->context["msg"] = $this->params["name"];
        return $this->context;
    }

}

$uri = $_SERVER['REQUEST_URI'];
$array = array();


array_push($array, array(
    'pattern' => "/^\/hello\/(\d+)$/",
    'func' => function($name) {
        $view = (new HelloView(ServiceTwig::getService(), TemplateName::getService(), "index.html"))
                ->setParams(array("name" => $name))
                ->build();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view->get();
        }
    }));

array_push($array, array(
    'pattern' => '/^\/test\/$/',
    'func' => function() {
        (new TwigTemplateView(ServiceTwig::getService(), TemplateName::getService(), "test.html"))
                ->build()
                ->run();
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
