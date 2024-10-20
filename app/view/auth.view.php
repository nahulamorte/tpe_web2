<?php

class authView {

    function ShowLocation($action){
        header("Location: ".BASE_URL.$action);
    }

    
    function showLogin(){
        require 'templates/form.phtml';
    }
}