<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?ts=<?=time()?>&quot" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <h1>TrainTrack</h1>
    </header>

    <div class="grid-container">
        <div class="row">
            <div class="col-auto me-auto">
                <div class="row">
                    <div class="col-auto me-auto nav">
                    <a href="index.php">
                        <img src="./img/home.png" alt="home">
                    </a>
                    </div>
                    <div class="col-auto me-auto nav">
                    <a href="login.php">
                        <img src="./img/user.png" alt="login">
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <a href="cart.php">
                    <img src="./img/cart.png" alt="carrello">
                </a>
            </div>
        </div>
    </div>

    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main>
    <footer>
        <a href="chi-siamo.php">Chi siamo</a>
        <a href="https://www.facebook.com/"><img src="./img/facebook.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/"><img src="./img/instagram.png" alt="Instagram"></a>
        <a href="https://x.com/"><img src="./img/x.png" alt="X"></a>
        <a href="https://www.linkedin.com/"><img src="./img/linkedin.png" alt="LinkedIn"></a>
        <a href="https://www.youtube.com/"><img src="./img/youtube.png" alt="Youtube"></a>
    </footer>
</body>
</html>
