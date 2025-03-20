<?php

    function addToCart($itemId, $quantity) {
        if (isset($_SESSION['cart'][$itemId])) {
            $_SESSION['cart'][$itemId] += $quantity;
        } else {
            $_SESSION['cart'][$itemId] = $quantity;
        }
    }
    
    function removeFromCart($itemId) {
        if (isset($_SESSION['cart'][$itemId])) {
            unset($_SESSION['cart'][$itemId]);
        }
    }

    function getCartItems() {
        return $_SESSION['cart'];
    }

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

    function getBorderColor($stato) {
        return match($stato) {
            'attivo' => 'success',
            'scaduto' => 'secondary',
            'in_attesa' => 'warning',
        };
    }
    
    function getHeaderColor($stato) {
        return match($stato) {
            'attivo' => 'success',
            'scaduto' => 'secondary',
            'in_attesa' => 'warning',
        };
    }
    
    function getBadgeColor($stato) {
        return match($stato) {
            'attivo' => 'success',
            'scaduto' => 'danger',
            'in_attesa' => 'warning',
        };
    }
    
    function getStatoText($stato) {
        return match($stato) {
            'attivo' => 'ATTIVO',
            'scaduto' => 'SCADUTO',
            'in_attesa' => 'IN ATTESA',
        };
    }
?>