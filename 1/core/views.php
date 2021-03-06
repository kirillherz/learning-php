<?php

class View {

    function get() {
        
    }

    function post() {
        
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

}

trait ContextTrait {

    protected function getContext(): array {
        return $this->context;
    }

    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }

    public function post() {
        echo $this->twig->render($this->template, $this->getContext());
    }

}

class ContextView extends TwigView {

    use ContextTrait;
}

class Validator {

    private $value;
    private $isValid;
    private $errors;

    public function __construct($value) {
        $this->errors = array();
        $this->isValid = true;
        $this->value = $value;
    }

    public function isEmpty(string $ErrorMessage) {
        $this->isValid = $this->isValid & $this->value != "";
        if (!$this->isValid) {
            array_push($this->errors, $ErrorMessage);
        }
        return $this;
    }

    public function isNumeric(string $ErrorMessage) {
        $this->isValid = $this->isValid & is_numeric($this->value);
        if (!$this->isValid) {
            array_push($this->errors, $ErrorMessage);
        }
        return $this;
    }

    public function isValid() {
        return $this->isValid;
    }

    public function getErrorsMessages() {
        return $this->errors;
    }

}