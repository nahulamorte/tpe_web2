<?php 
require_once 'app/view/about.view.php';

class AboutController {
    private $view;

    public function __construct($res) {
        $this->view = new AboutView($res->user);
    }

    public function mostrarAbout() {
        $this->view->mostrarAbout();
    }
}