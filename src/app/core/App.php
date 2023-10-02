<?php
require_once __DIR__ . '/../controllers/NotFoundController.php';
class App
{

    protected $controller;
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        $this->controller = new NotFoundController();
        $url = $this->parseURL();
        // controller
        $controllerPart = $url[0] ?? null;
        if (isset($controllerPart) && file_exists(__DIR__ . '/../controllers/' . $controllerPart . 'Controller.php')) {
            require_once __DIR__ . '/../controllers/' . $controllerPart . 'Controller.php';
            $controllerClass = $controllerPart . 'Controller';
            $this->controller = new $controllerClass();
        }
        // method
        $methodPart = $url[1] ?? null;
        if (isset($methodPart) && method_exists($this->controller, $methodPart)) {
            $this->method = $methodPart;
        }
        unset($url[1]);
        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        } else {
            $this->params = [];
        }
        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $url = trim($_SERVER['PATH_INFO'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}