<?php

require_once "../app/view/error.view.php";

class ErrorController {

    private $errorView;

    function __construct () {
        $this->errorView = new ErrorView();
    }

    function showError ($error) {
        $this->errorView->showError($error);
    }
}