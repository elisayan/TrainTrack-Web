<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?ts=<?=time()?>&quot"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <h1><a href="home.php">TrainTrack</a></h1>
    </header>

    <nav>
        <ul>
            <li><a href="home.php"><img src="./img/home.png" alt="Home"><span>Home</span></a></li>
            
            <?php if (isUserLoggedIn()): ?>
                <li class="dropdown">
                    <a href="#" class="dropbtn"><img src="./img/user.png" alt="utente"><span>Utente ▾</span></a>
                    <div class="dropdown-content">
                        <a href="profilo.php">Profilo</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li><a href="login.php"><img src="./img/user.png" alt="utente"><span>Utente</span></a></li>
            <?php endif; ?>
            
            <li><a href="carrello.php"><img src="./img/cart.png" alt="carrello"><span>Carrello</span></a></li>
        </ul>
    </nav>


    <main>
        <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }
        ?>
    </main>
    
    <footer>
        <a href="chi-siamo.php">Chi siamo</a>
        <p>Seguici su: </p>
        <a href="https://www.facebook.com/"><img src="./img/facebook.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/"><img src="./img/instagram.png" alt="Instagram"></a>
        <a href="https://x.com/"><img src="./img/x.png" alt="X"></a>
        <a href="https://www.linkedin.com/"><img src="./img/linkedin.png" alt="LinkedIn"></a>
        <a href="https://www.youtube.com/"><img src="./img/youtube.png" alt="Youtube"></a>
    </footer>

    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</body>
</html>
