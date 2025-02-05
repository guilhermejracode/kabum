<?php
// Função para carregar classes automaticamente
spl_autoload_register(function ($className) {
    // Define os diretórios onde o autoloader deve procurar as classes
    $directories = [
        'app/controllers/',    // Controllers
        'app/models/',         // Models
        'app/config/',         // Configurações
        'app/tests/'           // Testes
    ];

    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

