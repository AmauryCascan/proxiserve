
<div class="col-12 col-md-12 m-auto ">
<?php $token = $this->generateCSRFToken(); ?>
    <div class="row m-auto">
        <!-- Partie gauche -->
        <div class="card col-6 m-4" style="max-height: 550px;">
        <div class="row align-self-center">
            <div class=" col-12 m-2 ">
                <?php if($bc->getEtat() === "Terminé" || $bc->getEtat() === "Facturé") { ?>
                    <a href="<?= $this->router->generate('facturetl-list')?>" class="btn btn-outline-primary">Retour</a>
                <?php } elseif($bc->getEtat() === "Annulé") { ?>
                    <a href="<?= $this->router->generate('annuletl-list')?>" class="btn btn-outline-primary">Retour</a> 
                 <?php }else { ?>   
                    <a href="<?= $this->router->generate('tl-list')?>" class="btn btn-outline-primary">Retour</a> 
                <?php } ?>
                <img class="vth d-inline" src="<?= $viewData['imagesBaseUri']?>touraine-logement.png" alt=""> 
            </div>
            <div class="p-2 border rounded col-1 m-2">
                <h6 class="display-8">Année</h6>
                <h6 class="text-primary"><?= $bc->getYears(); ?></h6>
            </div>  
            <div class="p-2 border rounded col-1 m-2">
                <h6 class="display-8">N° BC</h6>
                <h6 class="text-primary"><?= $bc->getBc(); ?></h6>
            </div>         
            <div class="p-2 border rounded col-2 m-2">
                <h6 class="display-8">N° Commande</h6>
                <h6 class="text-primary"><?= $bc->getCommande(); ?></h6>
            </div> 
            <div class="p-2 border rounded col-2 m-2">
                <h6>Type :</h6> 
                <h6 class="text-primary"><?= $bc->getType(); ?></h6>  
            </div>
            <div class="p-2 border rounded col-2 m-2 ">
                <h6>Date :</h6>
                <h6 class="text-primary"><?= (!empty($bc->getDate())) ? (new DateTime($bc->getDate()))->format('d/m/y') : "" ?></h6> 
            </div>
            <div class="p-2 border rounded col-2 m-2">
                <h6>Montant</h6>
                <h6 class="text-primary"><?= (!empty($bc->getPrice())) ? number_format($bc->getPrice(), 2) : "0.00" ?>  &#x20AC</h6>
            </div>
            <div class="col-2"></div>
                    <form class="col-8 m-2" action="" method="POST">
                        <div class="row border border-4 rounded">
                            <div class="mb-3">
                                <label for="rdv" class="fform-label fs-5">Dernier RDV</label>
                                <input type="date" class="form-control text-success" id="rdv" name="rdv" value="<?= $bc->getRdv(); ?>">
                            </div>   
                            <div class="col ">
                                <label for="etat" class="form-label fs-5">Etat :</label>
                                <select class="form-select mb-3 text-success" aria-label="Default select example" id="etat" name="etat">
                                    <option class="text-success" value="<?= $bc->getEtat(); ?>"><?= $bc->getEtat(); ?></option>
                                    <?php foreach ($etats as $etat) : 
                                        if($bc->getEtat() !== $etat->getName()) :?>
                                            <option  class="text-success" value="<?= $etat->getName(); ?>"><?= $etat->getName(); ?></option>
                                        <?php endif;
                                    endforeach;?>
                                </select>
                            </div>
                            <div class="col ">
                                <label for="commentaire" class="form-label fs-5">Commentaire :</label>
                                <input type="text" class="form-control text-success" id="commentaire" name="commentaire" value="<?= $bc->getCommentaire(); ?>"></input>
                            </div>
                                <input type="hidden" name="csrftoken" value="<?= $token; ?>">
                            <div class="col-3 align-items-center">
                                <button type="submit" class="btn btn-outline-success position-relative top-50 start-50 translate-middle">Modifier <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            </div>      
                        </div>
                    </form>
            <div class="col-2"></div>
            <div class=" col-12 m-2 align-items-center">
                <a href="<?= $this->router->generate("tl-update", ['id' => $bc->getId()]) ?>" class="btn btn-outline-warning w-25 position-relative top-50 start-50 translate-middle">Modifier tout le BT
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>    
            </div>
            <div class=" col-12 m-2 align-items-center">
                <div class="btn-group w-25 position-relative top-50 start-50 translate-middle">
                    <button type="button" class="btn btn-outline-danger dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Supprimer le Bt
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= $this->router->generate('tl-delete', ['id' => $bc->getId()]) . "?csrftoken=" . $token;?>">Oui, je veux supprimer</a>
                        <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Partie droite (PDF) -->
        <div class="col-12 col-md-5">
            <div class="p-2 ">
                <?php if ($bc->getDocument() ===  $viewData['pdfBaseUri']) { ?>
                    <h6>Aucun document importé</h6>
                <?php }else{ ?>
                    <embed src="<?=$viewData['pdfBaseUri'] . $bt->getDocument()?>"  type="application/pdf" width="100%" height="650px">
                <?php } ?>
            </div>
        </div>
    </div>
</div>





