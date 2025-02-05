<?php

class Router {
    private $routes = [];
    private $baseUri;

    /**
     * Construtor para definir automaticamente a base URI e registrar rotas manuais.
     */
    public function __construct() {
        $this->setBaseUri();
        $this->defineRoutes();
    }

    /**
     * Define automaticamente a base URI do projeto.
     */
    private function setBaseUri() {
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $this->baseUri = trim($scriptDir, '/');
    }

    /**
     * Adiciona uma rota manual ao sistema.
     */
    public function addRoute($route, $controller, $action) {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * Define as rotas manuais do sistema.
     */
    private function defineRoutes() {
        $this->addRoute('login', 'AuthController', 'login');
        $this->addRoute('logout', 'AuthController', 'logout');
    }

    /**
     * Obtém a URL processada, removendo a base URI automaticamente.
     */
    public function getProcessedUri() {
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');

        if (!empty($this->baseUri) && strpos($requestUri, $this->baseUri) === 0) {
            $requestUri = substr($requestUri, strlen($this->baseUri));
        }

        return trim($requestUri, '/');
    }

    /**
     * Tenta encontrar a rota correspondente, considerando rotas manuais e automáticas.
     */
    public function matchRoute() {
        $requestUri = $this->getProcessedUri();

        // Se a URL corresponder a uma rota manual, retorna diretamente
        if (isset($this->routes[$requestUri])) {
            return $this->routes[$requestUri];
        }

        // Divide a URL em partes
        $segments = explode('/', $requestUri);

        // Se não houver controller, usa "HomeController" como padrão
        $controller = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $action = isset($segments[1]) ? $segments[1] : 'index';
        $params = array_slice($segments, 2);

        return [
            'controller' => $controller,
            'action' => $action,
            'params' => $params
        ];
    }
}
