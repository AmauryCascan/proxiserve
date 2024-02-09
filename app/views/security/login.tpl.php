<div class="container my-4 col-2 border border-4 rounded p-4 bg-light">
    <h2>Connexion</h2>

    <form action="" method="POST" class="mt-5">
        <?php include __DIR__ .'/../partials/form_errors.tpl.php'; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="toto@mail.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"  placeholder="mot de passe">   
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Se connecter</button>
        </div>
    </form>

</div>