<?php

class AuthService {

    /**
     * Verifica se o usuário está autenticado
     *
     * @return bool
     */
    public function isAuthenticated() {
        return isset($_SESSION['usuario_id']);
    }
}
