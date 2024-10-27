<?php

class AboutView {
    private $user = null;
    
    public function __construct($user) {
        $this->user = $user;
    }

    public function mostrarAbout() {
        require 'templates/about.phtml';
    }
}