<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/formularios/formlogin.phtml';
    }
}