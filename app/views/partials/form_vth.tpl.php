<div class="card">
                    <div class="card-header">Bon de travaux</div>
                    <div class="card-body ">
                    <form class="row" action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3 col-4">
                            <label for="years" class="form-label">Année</label>
                            <select name="years" class="form-select text-primary" id="years" value="<?= $bt->getYears(); ?>" >
                                <option value="2024" selected>2024</option>
                                <option value="2024">2025</option>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="bt" class="form-label">Numéro BT</label>
                            <input type="number" class="form-control text-primary" id="bt" name="bt" value="<?= $bt->getBt(); ?>">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="commande" class="form-label">N° de commande</label>
                            <input type="number" class="form-control text-primary" id="commande" name="commande" value="<?= $bt->getCommande(); ?>">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="etat" class="form-label">Etat</label>                          
                            <select class="form-select text-primary" aria-label="Default select example" id="etat" name="etat">
                                <?php if($_SERVER['REQUEST_URI'] === "/vth/add") { ?>
                                    <option value=""></option>
                                <?php foreach ($etats as $etat) : ?>
                                    <option value="<?= $etat->getName(); ?>"><?= $etat->getName(); ?></option>
                                    <?php endforeach; 
                                    } else { ?>
                                        <option value="<?= $bt->getEtat(); ?>"><?= $bt->getEtat(); ?></option>
                                        <?php foreach ($etats as $etat) : 
                                            if($bt->getEtat() !== $etat->getName()) :?>
                                                <option value="<?= $etat->getName(); ?>"><?= $etat->getName(); ?></option>
                                            <?php endif;
                                            endforeach;
                                    } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select text-primary" aria-label="Default select example" id="type" name="type">
                                <?php if($_SERVER['REQUEST_URI'] === "/vth/add") { ?>
                                    <option value=""></option>
                                <?php foreach ($types as $type) : ?>
                                    <option value="<?= $type->getName(); ?>"><?= $type->getName(); ?></option>
                                    <?php endforeach; 
                                    } else { ?>
                                        <option value="<?= $bt->getType(); ?>"><?= $bt->getType(); ?></option>
                                        <?php foreach ($types as $type) : 
                                            if($bt->getType() !== $type->getName()) :?>
                                                <option value="<?= $type->getName(); ?>"><?= $type->getName(); ?></option>
                                            <?php endif;
                                            endforeach;
                                    } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="secteur" class="form-label">Secteur</label>
                            <select class="form-select text-primary" aria-label="Default select example" id="secteur" name="secteur">
                                <?php if($_SERVER['REQUEST_URI'] === "/vth/add") { ?>
                                    <option value=""></option>
                                <?php foreach ($secteurs as $secteur) : ?>
                                    <option value="<?= $secteur->getName(); ?>"><?= $secteur->getName(); ?></option>
                                    <?php endforeach; 
                                    } else { ?>
                                        <option value="<?= $bt->getSecteur(); ?>"><?= $bt->getSecteur(); ?></option>
                                        <?php foreach ($secteurs as $secteur) : 
                                            if($bt->getSecteur() !== $secteur->getName()) :?>
                                                <option value="<?= $secteur->getName(); ?>"><?= $secteur->getName(); ?></option>
                                            <?php endif;
                                            endforeach;
                                    } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="start" class="form-label">Date de Début demandée</label>
                            <input type="date" class="form-control text-primary" id="start" name="start" value="<?= $bt->getStart(); ?>">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="end" class="form-label">Date de Fin demandée</label>
                            <input type="date" class="form-control text-primary" id="end" name="end" value="<?= $bt->getEnd(); ?>">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="rdv" class="form-label">Date du dernier RDV</label>
                            <input type="date" class="form-control text-primary" id="rdv" name="rdv" value="<?= $bt->getRdv(); ?>">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="price" class="form-label">Montant initial</label>
                            <input type="text" class="form-control text-primary" id="price" name="price" value="<?= $bt->getPrice(); ?>">
                        </div>
                        <div class="mb-3 ">
                            <label for="person" class="form-label">Mail du Chargé de secteur</label>
                            <select class="form-select text-primary" aria-label="Default select example" id="person" name="person">
                                <?php if($_SERVER['REQUEST_URI'] === "/vth/add") { ?>
                                    <option value=""></option>
                                <?php foreach ($appUsers as $appUser) : ?>
                                    <option value="<?= $appUser->getEmail(); ?>"><?= $appUser->getEmail(); ?></option>
                                    <?php endforeach; 
                                    } else { ?>
                                        <option value="<?= $bt->getPerson(); ?>"><?= $bt->getPerson(); ?></option>
                                        <?php foreach ($appUsers as $appUser) : 
                                            if($bt->getPerson() !== $appUser->getEmail()) :?>
                                                <option value="<?= $appUser->getEmail(); ?>"><?= $appUser->getEmail(); ?></option>
                                            <?php endif;
                                            endforeach;
                                    } ?>
                            </select>
                        </div>
                        <div class="mb-3 ">
                            <label for="document" class="form-label">document</label>
                            <input type="file" class="form-control text-primary" id="document" name="document" value="<?= $bt->getDocument(); ?>">
                        </div>
                        <input type="hidden" name="csrftoken" value="<?= $this->generateCSRFToken(); ?>">             
                       