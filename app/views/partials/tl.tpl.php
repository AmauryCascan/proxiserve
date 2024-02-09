<div class="row">
            <table class="table table-striped-columns table-secondary">
                <thead class="table-light">
                    <tr>    
                        <th scope="col">
                        <form class="tl filterForm form-inline flex-nowrap my-2" style="max-width: 100px;" method="post">  
                            <input class="form-control form-control-sm" type="text" id="Filtre" name="Filtre" placeholder="N ° BC">
                        </form>
                        </th>
                        <th scope="col">Dernier RDV</th>
                        <th scope="col">Etat
                            <button type="button" class="btn btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu">
                                <?php foreach($etats as $etat) : ?>
                                <a class="dropdown-item" href="<?= $this->router->generate('tl-filtreEtat', ['etat' =>urlencode($etat->getName())]) ?>"><?= $etat->getName() ?></a>
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
                                <a class="dropdown-item" href="<?= $this->router->generate('tl-filtreType', ['type' => urlencode($type->getName())]) ?>"><?= $type->getName() ?></a>
                                <?php endforeach ?>
                            </div>
                        </th>
                        <th scope="col">Date</th>
                        <th scope="col">Montant initial<br>
                        <?php if($_SESSION["userObject"]->getRole() === "manager" || $_SESSION["userObject"]->getRole() === "admin") :  
                             $totalPrice = 0; foreach ($bcs as $bc) : $totalPrice += $bc->getPrice(); endforeach;?> 
                                     <?='Total : ' . $totalPrice . '&#x20AC' ?></th>
                            <?php endif; ?>
                        </th>
                        <th scope="col">N° Commande</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Afficher</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bcs as $bc) : ?> 
                        <tr <?php if ($bc->getEtat() === "Facturé") { ?> 
                                        class="bg-success" 
                                    <?php }elseif($bc->getEtat() === "Annulé"){ ?>
                                        class="bg-warning"
                                    <?php } else { ?>
                                        class="" 
                                    <?php } ?>>
                            <td><?php if($bc->getdocument() === "http://localhost/Marie%20Pereira/public/doc/bon_travaux/"){?>
                                    <p class=<?= ($bc->getEtat() === "Facturé") ? "text-light" : "" ?>>BC N°: <?= $bc->getBc()?></p>
                                <?php }else{ ?>
                                    <a class =<?= ($bc->getEtat() === "Facturé") ? "text-light" : "text-dark" ?> href="<?= $bc->getDocument(); ?>" download>BC N°: <?= $bc->getBc(); ?> </a>
                                <?php } ?>
                            </td>
                            <td><?= (!empty($bc->getRdv())) ? (new DateTime($bc->getRdv()))->format('d/m/y') : "" ?></td>
                            <td><?= $bc->getEtat(); ?></td>
                            <td><?= $bc->getType(); ?></td>
                            <td><?= (!empty($bc->getDate())) ? (new DateTime($bc->getDate()))->format('d/m/y') : "" ?></td>
                            <td><?= (!empty($bc->getPrice())) ? number_format($bc->getPrice(), 2) : "0.00" ?>&#x20AC</td>
                            <td><?= $bc->getCommande(); ?></td>
                            <td><?= $bc->getCommentaire(); ?></td>
                            <td class="text-end">
                                <a href="<?= $this->router->generate('tl-see', ['id' => $bc->getId()]);?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                endforeach ?>
                </tbody>
            </table> 
        </div>
    </main>
 