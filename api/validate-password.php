<?php
header('Content-Type: application/json');

$response = [
    'messages' => [],
    'valid' => true,
    'checks' => [
        'length' => false,
        'number' => false,
        'special' => false
    ]
];

if (isset($_POST['password'])) {
    $password = $_POST['password'];

    if (strlen($password) < 8) {
        $response['messages'][] = "Mancano " . (8 - strlen($password)) . " caratteri.";
        $response['checks']['length'] = false;
    } else {
        $response['messages'][] = "Lunghezza minima di 8 caratteri raggiunta.";
        $response['checks']['length'] = true;
    }
   
    if (!preg_match('/\d/', $password)) {
        $response['messages'][] = "Manca un numero.";
        $response['checks']['number'] = false;
    } else {
        $response['messages'][] = "Contiene un numero.";
        $response['checks']['number'] = true;
    }

    if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]+/', $password)) {
        $response['messages'][] = "Manca un carattere speciale.";
        $response['checks']['special'] = false;
    } else {
        $response['messages'][] = "Contiene un carattere speciale.";
        $response['checks']['special'] = true;
    }

    $response['valid'] = $response['checks']['length'] && $response['checks']['number'] && $response['checks']['special'];

} else {
    $response['messages'][] = "Nessuna password fornita.";
    $response['valid'] = false;
}

echo json_encode($response);
?>