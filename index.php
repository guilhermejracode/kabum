<?php
session_start();
require_once 'autoload.php';

$router = new Router();
$authService = new AuthService();

$route = $router->matchRoute();

if (!$route) {
    http_response_code(404);
    echo "Erro 404: Página não encontrada.";
    exit();
}

$controllerName = $route['controller'];
$actionName = $route['action'];
$params = $route['params'] ?? [];

// Verifica autenticação para páginas restritas
if (!$authService->isAuthenticated() && $controllerName !== 'AuthController') {
    header('Location: '.UrlHelper::baseURL().'/login');
    exit();
}

// Instancia o controller e executa o método
if (class_exists($controllerName)) {
    $controller = new $controllerName();

    if (method_exists($controller, $actionName)) {
        call_user_func_array([$controller, $actionName], $params);
    } else {
        echo "Erro: Método '$actionName' não encontrado no controller '$controllerName'.";
    }
} else {
    echo "Erro: Controller '$controllerName' não encontrado.";
}
