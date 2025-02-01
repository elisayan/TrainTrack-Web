<div class="container">
    <div class="sidebar">
        <h4>Azioni</h4>
        <a href="aggiungi-percorso.php">Aggiungi Percorso</a>
        <a href="cambia-orario.php">Cambia Orario</a>
        <a href="cancella-treno.php">Cancella Treno</a>
    </div>

    <div class="content">
        <?php 
            if(isset($templateParams["azione"])){
                require($templateParams["azione"]);
            }
        ?>
    </div>
</div>
