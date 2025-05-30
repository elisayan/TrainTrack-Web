<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "template/payment.php",
    "titolo" => "Pagamento",
    "user_logged_in" => isset($_SESSION['email']),
    "total_price" => 0,
];

$cartItems = $dbh->getCartItems(
    isset($_SESSION['email']) ? $_SESSION['email'] : null,
    session_id()
);

if (!empty($cartItems['tickets']) || !empty($cartItems['subscriptions'])) {
    $templateParams["cart_items"] = $cartItems;
    
    $totalPrice = 0;
    foreach ($cartItems['tickets'] as $ticket) {
        $totalPrice += $ticket['Prezzo'] * $ticket['Quantità'];
    }
    foreach ($cartItems['subscriptions'] as $subscription) {
        $totalPrice += $subscription['Prezzo'] * $subscription['Quantità'];
    }
    $templateParams["total_price"] = $totalPrice;

    if(isset($_POST['confirm_payment'])) {
        // Store purchased services in session
        $_SESSION['last_purchase'] = $cartItems;
        
        if(isset($_SESSION['email'])) {
            $email = $_SESSION["email"];
            $user = $dbh->getUserByEmail($email);
            $user = $user[0];
            
            foreach ($cartItems['tickets'] as $ticket) {
                $routeCodeResult = $dbh->getRouteCode($ticket['CodServizio']);
                $actualCodPercorso = !empty($routeCodeResult) ? $routeCodeResult[0]['CodPercorso'] : null;
                
                $dbh->insertTicket(
                    $email,
                    $user['nome'],
                    $user['cognome'],
                    $actualCodPercorso,
                    $ticket['NomePartenza'],
                    $ticket['NomeArrivo'],
                    $ticket['TipoTreno'],
                    $ticket['DataPartenza'],
                    $ticket['OrarioPartenza'],
                    $ticket['Prezzo']
                );
            }  
            
            foreach ($cartItems['subscriptions'] as $subscription) {
                $dbh->insertSubscription(
                    $email,
                    $user['nome'],
                    $user['cognome'],
                    $subscription['CodPercorso'],
                    $subscription['NomePartenza'],
                    $subscription['NomeArrivo'],
                    $subscription['TipoTreno'],
                    $subscription['DataPartenza'],
                    $subscription['Durata'],
                    $subscription['Chilometraggio'],
                    $subscription['Prezzo']
                );
            }
        } else {
            if (!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['email']) ||
                !isset($_POST['cf']) || !isset($_POST['address']) || !isset($_POST['phone'])) {
                die("Missing required guest information");
            }
            
            $existingGuest = $dbh->getGuestByEmail($_POST['email']);
            if (empty($existingGuest)) {
                $dbh->insertGuest(
                    $_POST['name'],
                    $_POST['surname'],
                    $_POST['cf'],
                    $_POST['address'],
                    $_POST['phone'],
                    $_POST['email']
                );
            }
            
            foreach ($cartItems['tickets'] as $ticket) {
                $routeCodeResult = $dbh->getRouteCode($ticket['CodServizio']);
                $actualCodPercorso = !empty($routeCodeResult) ? $routeCodeResult[0]['CodPercorso'] : null;

                $dbh->insertTicket(
                    $_POST['email'],
                    $_POST['name'],
                    $_POST['surname'],
                    $actualCodPercorso,
                    $ticket['NomePartenza'],
                    $ticket['NomeArrivo'],
                    $ticket['TipoTreno'],
                    $ticket['DataPartenza'],
                    $ticket['OrarioPartenza'],
                    $ticket['Prezzo']
                );
            }  
            
            foreach ($cartItems['subscriptions'] as $subscription) {
                $dbh->insertSubscription(
                    $_POST['email'],
                    $_POST['name'],
                    $_POST['surname'],
                    $subscription['CodPercorso'],
                    $subscription['NomePartenza'],
                    $subscription['NomeArrivo'],
                    $subscription['TipoTreno'],
                    $subscription['DataPartenza'],
                    $subscription['Durata'],
                    $subscription['Chilometraggio'],
                    $subscription['Prezzo']            
                );
            }
        }
        
        
        
        // Redirect to order page
        header("Location: order.php");
        exit;
    }
}

require 'template/base.php';
?>