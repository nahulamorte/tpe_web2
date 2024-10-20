<?php
require 'app/view/about.view.php';

class AboutController {
    private $view;

    public function __construct() {
        $this->view = new AboutView();
    }
    
    public function showAbout() {
        $this->view->showAbout();
    }
}