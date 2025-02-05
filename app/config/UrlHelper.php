<?php

class UrlHelper {

    /**
     * Retorna a URL base do sistema.
     *
     * @return string URL base do projeto.
     */
    public static function baseURL() {
        // Verifica se estamos no protocolo HTTPS ou HTTP
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

        // Obtém o domínio ou localhost
        $host = $_SERVER['HTTP_HOST'];

        // Obtém o caminho do projeto (caso o sistema esteja em subdiretórios)
        $path = rtrim(dirname($_SERVER['PHP_SELF']), '/');

        // Retorna a URL completa
        return $protocol . '://' . $host . $path;
    }

    /**
     * Retorna a URL atual que está sendo acessada.
     *
     * @return string URL completa da página acessada.
     */
    public static function currentURL($removeParametros = false) {
        // Verifica se estamos no protocolo HTTPS ou HTTP
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

        // Obtém o domínio ou localhost
        $host = $_SERVER['HTTP_HOST'];

        // Obtém o caminho completo da requisição (URI)
        $uri = $_SERVER['REQUEST_URI'];

        if($removeParametros){
            // Remove IDs numéricos no final da URL (ex: "/clientes/editar/123" → "/clientes/editar")
            $uri = preg_replace('/\/\d+$/', '', $uri);
        }

        // Retorna a URL completa
        return $protocol . '://' . $host . $uri;
    }
}
