<div class="row mt-5">
            <div class="col-12 col-md-4">
                <div class="card text-danger mb-3">
                    <div class="card-header bg-light">Liste des Types</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th class="text-end" scope="col">Supprimer</th>
                                </tr>
                            </thead>
                            <?php $token = $this->generateCSRFToken(); ?>
                                <?php foreach($types as $type) : ?>
                                <tr>
                                    <td><?= $type->getName()?></td>
                                    <td class="text-end">
                                    <a href="<?= $this->router->generate('type-update', ['id' => $type->getId()]);?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="<?= $this->router->generate('type-delete', ['id' => $type->getId()]) . "?csrftoken=" . $token;?>" 
                                        class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="<?= $this->router->generate('type-add');?>" class="btn btn-success">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card text-danger mb-3">
                    <div class="card-header bg-light">Liste des Secteurs</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th class="text-end" scope="col">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($secteurs as $secteur) : ?>
                                <tr>
                                    <td><?= $secteur->getName()?></td>
                                    <td class="text-end">
                                        <a href="<?= $this->router->generate('secteur-update', ['id' => $secteur->getId()]);?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a href="<?= $this->router->generate('secteur-delete', ['id' => $secteur->getId()]) . "?csrftoken=" . $token;?>" 
                                            class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="<?= $this->router->generate('secteur-add');?>" class="btn btn-success">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card text-danger mb-3">
                    <div class="card-header bg-light">Liste des Etats</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th class="text-end" scope="col">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($etats as $etat) : ?>
                                <tr>
                                    <td><?= $etat->getName()?></td>
                                    <td class="text-end">
                                        <a href="<?= $this->router->generate('etat-update', ['id' => $etat->getId()]);?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a href="<?= $this->router->generate('etat-delete', ['id' => $etat->getId()]) . "?csrftoken=" . $token;?>" 
                                            class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="<?= $this->router->generate('etat-add');?>" class="btn btn-success">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
