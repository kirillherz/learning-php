
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

array_push($array, array(
    'pattern' => '/^\/def\/save\/?$/',
    'func' => function() {
        $twig = ServiceTwig::getService();
        echo $twig->render('index.html', array('msg' => "hello"));
    }));
    
