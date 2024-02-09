<div class="container my-4 col-2 border border-4 rounded p-4">
    <h2>Nouveau MDP</h2>

    <form action="" method="POST" class="mt-5">
        <?php include __DIR__ .'/../partials/form_errors.tpl.php'; ?>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"  placeholder="mot de passe">   
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Modifier</button>
        </div>
        <input type="hidden" name="csrftoken" value="<?= $this->generateCSRFToken(); ?>">
    </form>

</div>