<?php
    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF'])==$pagename){
            echo " class='active' ";
        }
    }

    function isUserLoggedIn(){
        return !empty($_SESSION['email']);
    }

    function registerLoggedUser($user){
        $_SESSION["email"] = $user["email"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["tipopersona"] = $user["tipopersona"];
    }
    
?>