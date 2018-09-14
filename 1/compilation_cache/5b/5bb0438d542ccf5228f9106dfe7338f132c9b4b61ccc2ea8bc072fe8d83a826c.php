<?php

/* index.html */
class __TwigTemplate_41c16d5685f531141340fea4174e570edf843f6eddf98b5b649aeb3dbde7ede0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"ru\">
    <head>
        <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\"/>
    </head>
    <body>
        <div id=\"content\">
            ";
        // line 9
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "        </div>
    </body>

</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "            ";
        echo twig_escape_filter($this->env, ($context["msg"] ?? null), "html", null, true);
        echo "
            ";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function getDebugInfo()
    {
        return array (  56 => 10,  53 => 9,  48 => 4,  40 => 12,  38 => 9,  30 => 4,  25 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.html", "C:\\Users\\Кирилл\\Documents\\NetBeansProjects\\1\\templates\\index.html");
    }
}
