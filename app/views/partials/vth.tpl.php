<div class="row ">
            <table class="table table-striped-columns table-light">
                <thead class="table-secondary" >
                    <tr>    
                        <th scope="col">
                        <form class="valt filterForm form-inline flex-nowrap my-2" style="max-width: 150px;" method="post">  
                            <input class="form-control form-control-sm" type="text" id="Filtre" name="Filtre" placeholder="N ° BT">
                        </form>
                        </th>
                        <th scope="col">Dernier RDV</th>
                        <th scope="col">Etat
                            <button type="button" class="btn btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu">
                                <?php foreach($etats as $etat) : ?>
                                <a class="dropdown-item" href="<?= $this->router->generate('vth-filtreEtat', ['etat' =>urlencode($etat->getName())]) ?>"><?= $etat->getName() ?></a>
                                <?php endforeach ?>
                            </div>
                        </th> 
                        <th scope="col">Type
                            <div  class="btn-group">
                            <button type="button" class="btn btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu">
                                <?php foreach($types as $type) : ?>
                                <a class="dropdown-item" href="<?= $this->router->generate('vth-filtreType', ['type' => urlencode($type->getName())]) ?>"><?= $type->getName() ?></a>
                                <?php endforeach ?>
                            </div>
                        </th>
                        <th scope="col">Secteur
                        <div  class="btn-group">
                            <button type="button" class="btn btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu">
                                <?php foreach($secteurs as $secteur) : ?>
                                <a class="dropdown-item" href="<?= $this->router->generate('vth-filtreSecteur', ['secteur' =>urlencode($secteur->getName())]) ?>"><?= $secteur->getName() ?></a>
                                <?php endforeach ?>
                            </div>
                        </th>
                        <th scope="col">Date Début</th>
                        <th scope="col">Date Fin</th>
                        <th scope="col">Chargé de Secteur</th>
                        <th scope="col">Montant initial
                            <?php if($_SESSION["userObject"]->getRole() === "manager" || $_SESSION["userObject"]->getRole() === "admin") :  
                             $totalPrice = 0; foreach ($bts as $bt) : $totalPrice += $bt->getPrice(); endforeach;?> 
                                     <?='Total:' . $totalPrice . '&#x20AC' ?></th>
                            <?php endif; ?>
                        <th scope="col">N° Commande</th>
                        <th scope="col">Commentaire Proxiserve</th>
                        <th scope="col">Commentaire VTH</th>
                        <th scope="col">Afficher</th>
                    </tr>
                </thead>
                    <?php if($_SESSION["userObject"]->getRole() === "manager" || $_SESSION["userObject"]->getRole() === "admin") : ?>
                <tbody class="table-group-divider">
                    <?php foreach ($bts as $bt) : ?> 
                        <tr <?php if ($bt->getEtat() === "Facturé") { ?> 
                                        class="table-success" 
                                    <?php }elseif($bt->getEtat() === "Annulé"){ ?>
                                        class="table-danger"
                                    <?php } else { ?>
                                        class="" 
                                    <?php } ?>>
                            <td><?php if($bt->getdocument() === "http://localhost/Marie%20Pereira/public/doc/bon_travaux/"){?>
                                    <p> BT N°: <?= $bt->getbt()?></p>
                                <?php }else{ ?>
                                    <a class =<?= ($bt->getEtat() === "Facturé") ? "text-light" : "text-dark" ?> href="<?= $bt->getDocument(); ?>" download>BT N°: <?= $bt->getBt(); ?> </a>
                                <?php } ?>
                            </td>
                            <td><?= (!empty($bt->getRdv())) ? (new DateTime($bt->getRdv()))->format('d/m/y') : "" ?></td>
                            <td><?= $bt->getEtat(); ?></td>
                            <td><?= $bt->getType(); ?></td>
                            <td><?= $bt->getSecteur(); ?></td>
                            <td><?= (!empty($bt->getStart())) ? (new DateTime($bt->getStart()))->format('d/m/y') : "" ?></td>
                            <td><?= (!empty($bt->getEnd())) ? (new DateTime($bt->getEnd()))->format('d/m/y') : "" ?></td>
                            <td><?= $bt->getPerson(); ?></td>
                            <td><?= (!empty($bt->getPrice())) ? number_format($bt->getPrice(), 2) : "0.00" ?>&#x20AC</td>
                            <td><?= $bt->getCommande(); ?></td>
                            <td><?= $bt->getCommentaire(); ?></td>
                            <td><?= $bt->getCommentaireVth(); ?></td>
                            <td class="text-end">
                                <a href="<?= $this->router->generate('vth-see', ['id' => $bt->getId()]);?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                endforeach ?>
                </tbody>
                <?php endif; ?>
                    <tbody class="table-group-divider">
                    <?php foreach ($bts as $bt) : 
                        foreach($users as $user) :
                            if($bt->getPerson() === $user->getEmail() && $_SESSION["userObject"]->getRole() !== "manager" && $_SESSION["userObject"]->getRole() !== "admin") :?> 
                                <tr <?php if ($bt->getEtat() === "Facturé") { ?> 
                                        class="bg-success" 
                                    <?php }elseif($bt->getEtat() === "Annulé"){ ?>
                                        class="bg-warning"
                                    <?php } else { ?>
                                        class="" 
                                    <?php } ?>>
                                    <td><?php if($bt->getdocument() === "http://localhost/Marie%20Pereira/public/doc/bon_travaux/"){?>
                                        <p class =<?= ($bt->getEtat() === "Facturé") ? "text-light" : "text-dark" ?>>BT N°: <?= $bt->getbt()?></p>
                                        <?php }else{ ?>
                                        <a class =<?= ($bt->getEtat() === "Facturé") ? "text-light" : "text-dark" ?> href="<?= $bt->getDocument(); ?>" download>BT N°: <?= $bt->getBt(); ?> </a>
                                        <?php } ?>
                                    </td>
                                    <td><?= (!empty($bt->getRdv())) ? (new DateTime($bt->getRdv()))->format('d/m/y') : "" ?></td>
                                    <td><?= $bt->getEtat(); ?></td>
                                    <td><?= $bt->getType(); ?></td>
                                    <td><?= $bt->getSecteur(); ?></td>
                                    <td><?= (!empty($bt->getStart())) ? (new DateTime($bt->getStart()))->format('d/m/y') : "" ?></td>
                                    <td><?= (!empty($bt->getEnd())) ? (new DateTime($bt->getEnd()))->format('d/m/y') : "" ?></td>
                                    <td><?= $bt->getPerson(); ?></td>
                                    <td><?= (!empty($bt->getPrice())) ? number_format($bt->getPrice(), 2) : "0.00" ?>&#x20AC</td>
                                    <td><?= $bt->getCommande(); ?></td>
                                    <td><?= $bt->getCommentaire(); ?></td>
                                    <td><?= $bt->getCommentaireVth(); ?></td>
                                    <td class="text-end">
                                        <a href="<?= $this->router->generate('vth-see', ['id' => $bt->getId()]);?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endif;
                        endforeach;
                    endforeach ?>
                </tbody>                    
            </table> 
        </div>
    </main>
 