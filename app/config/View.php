<?php

class View {
    /**
     * Renderiza uma view dentro de um layout padrão.
     *
     * @param string $view Nome da view (sem extensão .php)
     * @param array $data Dados a serem passados para a view
     * @param string $layout Layout a ser usado (padrão: 'template')
     */
    public static function render($view, $data = [], $layout = 'layouts/template') {
        $viewPath = __DIR__ . "/../views/{$view}.php";
        $layoutPath = __DIR__ . "/../views/{$layout}.php";

        if (!file_exists($viewPath)) {
            die("Erro: A view '{$view}' não foi encontrada.");
        }

        // Extrai variáveis para uso na view
        extract($data);

        // Inicia o buffer de saída para capturar o conteúdo da view
        ob_start();
        require $viewPath;
        $content = ob_get_clean(); // Salva o conteúdo da view

        // Carrega o layout e insere a view no local correto
        require $layoutPath;
    }
}
