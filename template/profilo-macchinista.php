<div class="container">
    <div class="sidebar">
        <h4>Azioni</h4>
        <a href="aggiungi-percorso.php">Aggiungi Percorso</a>
        <a href="cambia_orario.php">Cambia Orario</a>
        <a href="cancella_treno.php">Cancella Treno</a>
    </div>

    <div class="content" id="content">
        <?php 
            if(isset($templateParams["azione"])){
                require($templateParams["azione"]);
            }
        ?>
    </div>
</div>
