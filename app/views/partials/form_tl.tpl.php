<div class="card">
                    <div class="card-header">Bon de commande</div>
                    <div class="card-body ">
                    <form class="row" action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3 col-4">
                            <label for="years" class="form-label">Année</label>
                            <select name="years" class="form-select" id="years" value="<?= $bc->getYears(); ?>" >
                                <option value="2024" selected>2024</option>
                                <option value="2024">2025</option>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="bc" class="form-label">Numéro BC</label>
                            <input type="number" class="form-control" id="bc" name="bc" value="<?= $bc->getBc(); ?>">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="commande" class="form-label">N° Commande</label>
                            <input type="number" class="form-control" id="commande" name="commande" value="<?= $bc->getCommande(); ?>">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="etat" class="form-label">Etat</label>                          
                            <select class="form-select" aria-label="Default select example" id="etat" name="etat">
                                <?php if($_SERVER['REQUEST_URI'] === "/tl/add") { ?>
                                    <option value=""></option>
                                <?php foreach ($etats as $etat) : ?>
                                    <option value="<?= $etat->getName(); ?>"><?= $etat->getName(); ?></option>
                                    <?php endforeach; 
                                    } else { ?>
                                        <option value="<?= $bc->getEtat(); ?>"><?= $bc->getEtat(); ?></option>
                                        <?php foreach ($etats as $etat) : 
                                            if($bc->getEtat() !== $etat->getName()) :?>
                                                <option value="<?= $etat->getName(); ?>"><?= $etat->getName(); ?></option>
                                            <?php endif;
                                            endforeach;
                                    } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select example" id="type" name="type">
                                <?php if($_SERVER['REQUEST_URI'] === "/tl/add") { ?>
                                    <option value=""></option>
                                <?php foreach ($types as $type) : ?>
                                    <option value="<?= $type->getName(); ?>"><?= $type->getName(); ?></option>
                                    <?php endforeach; 
                                    } else { ?>
                                        <option value="<?= $bc->getType(); ?>"><?= $bc->getType(); ?></option>
                                        <?php foreach ($types as $type) : 
                                            if($bc->getType() !== $type->getName()) :?>
                                                <option value="<?= $type->getName(); ?>"><?= $type->getName(); ?></option>
                                            <?php endif;
                                            endforeach;
                                    } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="price" class="form-label">Montant initial</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= $bc->getPrice(); ?>">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="date" class="form-label">Date </label>
                            <input type="date" class="form-control" id="date" name="date" value="<?= $bc->getDate(); ?>">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="rdv" class="form-label">Dernier RDV</label>
                            <input type="date" class="form-control" id="rdv" name="rdv" value="<?= $bc->getRdv(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="document" class="form-label">document</label>
                            <input type="file" class="form-control" id="document" name="document" value="<?= $bc->getDocument(); ?>">
                        </div>
                        <input type="hidden" name="csrftoken" value="<?= $this->generateCSRFToken(); ?>">             
                       