<div class="container mt-5 mb-4">
    <h1 class="mb-4">Le tue notifiche</h1>

    <?php if (empty($notifiche)): ?>
        <div class="alert alert-info">Nessuna notifica da visualizzare.</div>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($notifiche as $notifica): ?>
                <form method="POST" class="list-group-item d-flex justify-content-between align-items-center rounded-3 shadow-sm <?= $notifica['Letto'] ? 'letta' : '' ?>">

                    <input type="hidden" name="id_notifica" value="<?= $notifica['CodNotifica'] ?>">
                    
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               id="notifica-<?= $notifica['CodNotifica'] ?>" 
                               onchange="this.form.submit()" 
                               name="azione" 
                               value="segna_letta" 
                               <?= $notifica['Letto'] ? 'checked disabled' : '' ?>>
                        <label class="form-check-label" for="notifica-<?= $notifica['CodNotifica'] ?>">
                            <?= htmlspecialchars($notifica['Descrizione']) ?>
                        </label>
                    </div>

                    <button type="submit" 
                            name="azione" 
                            value="cancella" 
                            class="btn btn-link text-danger p-0">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="mt-4 mb-4 text-center">
    <a href="profilo-cliente.php" class="btn btn-primary">Torna al Profilo</a>
</div>