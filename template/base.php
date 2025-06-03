<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?ts=<?=time()?>&quot"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>
    <header>
        <div class="col-12 text-center header-intro">
            <h2 class="display-4 mb-3">
                <a href="home.php" class="logo-link">TrainTrack</a>
            </h2>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="home.php"><img src="./img/home.png" alt=""><span>Home</span></a></li>
            
            <?php if (isUserLoggedIn()): ?>
                <li class="dropdown">
                    <a href="#" class="dropbtn"><img src="./img/user.png" alt=""><span>Utente ▾</span></a>
                    <div class="dropdown-content">
                        <a href="login.php">Profilo</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <li><a href="login.php"><img src="./img/user.png" alt=""><span>Utente</span></a></li>
            <?php endif; ?>
            
            <li><a href="cart.php"><img src="./img/cart.png" alt=""><span>Carrello</span></a></li>
        </ul>
    </nav>


    <main>
        <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }
        ?>
    </main>
    
    <footer class="footer-container">
        <div class="footer-links">
            <a href="chi-siamo.php" class="footer-link">Chi Siamo</a>
        </div>

        <div class="social-section">
            <p class="social-title">Seguici sui social</p>
            <div class="social-icons">
                <a href="https://facebook.com" class="social-icon">
                    <img src="./img/facebook.png" alt="Facebook" class="social-img">
                </a>
                <a href="https://instagram.com" class="social-icon">
                    <img src="./img/instagram.png" alt="Instagram" class="social-img">
                </a>
                <a href="https://x.com" class="social-icon">
                    <img src="./img/x.png" alt="X" class="social-img">
                </a>
                <a href="https://linkedin.com" class="social-icon">
                    <img src="./img/linkedin.png" alt="LinkedIn" class="social-img">
                </a>
            </div>
        </div>

        <div class="copyright">
            © 2024 TrainTrack - Tutti i diritti riservati
        </div>
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
