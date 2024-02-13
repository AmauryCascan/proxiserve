<div class="container my-4 col-4">
    <a href="<?= $this->router->generate("user-list") ?>" class="btn btn-success float-end">Retour</a>
    <h2>AJouter un Utilisateur</h2>
    
    <form action="" method="POST" class="mt-5">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="toto@gmail.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-select" name="role" id="role">
                <option value="admin">admin</option>
                <option value="manager">manager</option>
                <option value="client">client</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-select" name="status" id="status">
                <option value="0">-</option>
                <option value="1">actif</option>
                <option value="2">désactivé</option>
            </select>
        </div>
        <input type="hidden" name="csrftoken" value="<?= $this->generateCSRFToken(); ?>">
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>