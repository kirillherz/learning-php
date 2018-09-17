<?php

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

class TwigViewAutoTemplateAndAutoLoadPath extends TwigViewBuilder {

    public function buildAutoReload() {
        $this->twigView->setAutoReload(true);
    }

    public function buildTemplatePath() {

        $this->twigView->setTemplatesPath('templates');
    }
    
    public function buildAutoloadPath() {

        $this->twigView->setAutoloadPath('./vendor/autoload.php');
    }

    public function buildCache() {
        $this->twigView->setCache('compilation_cache');
    }

    public function BuildTwigEnvironment() {
        $this->twigView->setTwigEnvironment();
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
