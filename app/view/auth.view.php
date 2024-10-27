<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/formularios/formlogin.phtml';
    }

    // TODO: IMPLEMENTAR registro
    // public function showSignup($error = '') {
    //     require 'templates/formularios/formsignup.phtml';
    // }
}