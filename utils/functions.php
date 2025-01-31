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
        $_SESSION["email"] = $user["Email"];
        $_SESSION["nome"] = $user["Nome"];
        $_SESSION["tipopersona"] = $user["TipoPersona"];
    }
?>