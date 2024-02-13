<div class="container my-4 col-4">
    <a href="<?= $this->router->generate("user-list") ?>" class="btn btn-success float-end">Retour</a>
    <h2>Modifier un Utilisateur</h2>
    <button class="btn btn-primary mt-5"> <a href="<?= $this->router->generate('user-mdp', ['id' => $user->getId()]) ?>" class="link-light link-underline-opacity-0">Changer le mot de passe</a></button>
    <form action="" method="POST" class="mt-5">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user->getEmail(); ?>" placeholder="toto@gmail.com">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user->getFirstname(); ?>" placeholder="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user->getLastname(); ?>" placeholder="lastname">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-select" name="role" id="role">
                <option value="admin" <?= ($user->getRole() == "admin") ? 'selected' : '' ?>>admin</option>
                <option value="manager" <?= ($user->getRole() == "manager") ? 'selected' : '' ?>>manager</option>
                <option value="client" <?= ($user->getRole() == "client") ? 'selected' : '' ?>>client</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-select" name="status" id="status">
                <option value="0" <?= ($user->getStatus() == 0) ? 'selected' : '' ?>>-</option>
                <option value="1" <?= ($user->getStatus() == 1) ? 'selected' : '' ?>>actif</option>
                <option value="2" <?= ($user->getStatus() == 2) ? 'selected' : '' ?>>désactivé</option>
            </select>
        </div>
        <input type="hidden" name="csrftoken" value="<?= $this->generateCSRFToken(); ?>">
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>