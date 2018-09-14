<?php

/* test.html */
class __TwigTemplate_1493d2bd548da1a6fbf2d0ec59de62d1fcbab771c5da93c24cea8a33108d0fb7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
    <body>
        <div>test</div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "test.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "test.html", "C:\\Users\\Кирилл\\Documents\\NetBeansProjects\\learning-php\\1\\templates\\test.html");
    }
}
