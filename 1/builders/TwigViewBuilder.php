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

