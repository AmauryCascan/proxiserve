<div class="container my-4 col-6">
        <a href="<?= $this->router->generate("user-add"); ?>" class="btn btn-success float-end">Ajouter</a>
        <h2>Liste des utilisateurs</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php $token = $this->generateCSRFToken(); ?>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->getEmail(); ?></td>
                    <td><?= $user->getFirstname(); ?></td>
                    <td><?= $user->getLastname(); ?></td>
                    <td><?= $user->getRole(); ?></td>
                    <td><?= $user->getStatus() == "1" ? "Actif ✅" : "désactivé/bloqué ❌"; ?></td>
                    <td class="text-end">
                        <a href="<?= $this->router->generate('user-update', ['id' => $user->getId()]);?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= $this->router->generate('user-delete', ['id' => $user->getId()]) . "?csrftoken=" . $token;?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

   