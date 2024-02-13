<div class="col-12 m-auto">
<?php $token = $this->generateCSRFToken(); ?>
    <div class="row m-auto">
        <!-- Partie gauche -->
        <div class="card col-12 col-lg-6 m-2">
        <div class="row align-self-center">
            <div class=" col-12 m-2 ">
                <?php if($bt->getEtat() === "Terminé" || $bt->getEtat() === "Facturé") { ?>
                    <a href="<?= $this->router->generate('facture-list')?>" class="btn btn-outline-primary">Retour</a>
                <?php } elseif($bt->getEtat() === "Annulé") { ?>
                    <a href="<?= $this->router->generate('annule-list')?>" class="btn btn-outline-primary">Retour</a> 
                 <?php }else { ?>   
                    <a href="<?= $this->router->generate('vth-list')?>" class="btn btn-outline-primary">Retour</a> 
                <?php } ?>
                <img class="vth d-inline" src="<?= $viewData['imagesBaseUri']?>Logo_VTH_CMJN.png" alt=""> 
            </div>
            <div class="p-2 border rounded col-lg-1 m-2">
                <h6 class="display-8">Année</h6>
                <h6 class="text-primary"><?= $bt->getYears(); ?></h6>
            </div>
            <div class="p-2 border rounded col-lg-1 m-2">
                <h6 class="display-8">BT N°</h6>
                <h6 class="text-primary"><?= $bt->getBt(); ?></h6>
            </div>
            <div class="p-2 border rounded col-lg-2 m-2">
                <h6 class="display-8">N° Commande</h6>
                <h6 class="text-primary"><?= $bt->getCommande(); ?></h6>
            </div> 
            <div class="p-2 border rounded col-lg-2 m-2">
                <h6>Type :</h6> 
                <h6 class="text-primary"><?= $bt->getType(); ?></h6>  
            </div>        
            <div class="p-2 border rounded col-lg-2 m-2">
                <h6>SECTEUR :</h6>
                <h6 class="text-primary"><?= $bt->getSecteur(); ?></h6>
            </div>
            <div class="p-2 border rounded col-lg-2 m-2">
                <h6>Montant</h6>
                <h6 class="text-primary"><?= (!empty($bt->getPrice())) ? number_format($bt->getPrice(), 2) : "0.00" ?>  &#x20AC</h6>
            </div>
            <div class="p-2 border  rounded col-lg-6 m-2">
                <h6>Chargé de secteur :</h6>
                <h6 class="text-primary"><?= $bt->getPerson(); ?></h6>
            </div>
            <div class="p-2 border  rounded col-lg-5 m-2 ">
                <h6>Délai demandé :</h6>
                <h6 class="text-primary"> 
                <?php if (!empty($bt->getStart()) && !empty($bt->getEnd())): ?> Du <?=  (!empty($bt->getStart())) ? (new DateTime($bt->getStart()))->format('d/m/y') : "" ?>  
                        au <?= (!empty($bt->getEnd())) ? (new DateTime($bt->getEnd()))->format('d/m/y') : ""?>
                <?php endif; ?></h6> 
            </div>
            <?php if($_SESSION['userObject']->getRole() === "client") { ?>
                <div class="p-2 border rounded col-lg-5 m-2 ">
                    <h6>Etat</h6>
                    <h6 class="text-primary"><?= $bt->getEtat(); ?> </h6> 
                </div>
                <div class="p-2 border  rounded col-lg-6 m-2 ">
                    <h6>Commentaire Proxiserve</h6>
                    <h6 class="text-primary"><?= $bt->getCommentaire(); ?> </h6> 
                </div>
                <div class="col-2"></div>
            <form class="col-lg-8 m-2" action="" method="POST">
                <div class="row">
                    <div class=" border border-end-0 col ">
                        <label for="commentaireVth" class="form-label fs-5">Commentaire :</label>
                        <input type="text" class="form-control text-success mb-2" id="commentaireVth" name="commentaireVth" value="<?= $bt->getCommentaireVTH(); ?>"></input>
                    </div>
                    <input type="hidden" name="csrftoken" value="<?= $token; ?>">
                    <div class=" border  border-start-0  rounded-end col-3 align-items-center">
                        <button type="submit" class="btn btn-outline-success position-relative top-50 start-50 translate-middle">Ajouter <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </form>
            <div class="col-lg-2"></div>
                <?php }else { ?>
                    <div class="p-2 border  rounded col-lg-11 m-2 ">
                        <h6>Commentaire VTH</h6>
                        <h6 class="text-primary"><?= $bt->getCommentaireVTH(); ?> </h6> 
                     </div>
                    <form class="col-lg-10 m-2" action="" method="POST" enctype="multipart/form-data">
                        <div class="row border border-4 rounded">
                            <div class="col-6 mb-3">
                                <label for="rdv" class="fform-label fs-5">Dernier RDV</label>
                                <input type="date" class="form-control text-success" id="rdv" name="rdv" value="<?= $bt->getRdv(); ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="file" class="form-label fs-5">Bon d'Intervention</label>
                             <input type="file" class="form-control text-success" id="file" name="file">
                             </div>   
                            <div class="col ">
                                <label for="etat" class="form-label fs-5">Etat :</label>
                                <select class="form-select mb-3 text-success" aria-label="Default select example" id="etat" name="etat">
                                    <option class="text-success" value="<?= $bt->getEtat(); ?>"><?= $bt->getEtat(); ?></option>
                                    <?php foreach ($etats as $etat) : 
                                        if($bt->getEtat() !== $etat->getName()) :?>
                                            <option  class="text-success" value="<?= $etat->getName(); ?>"><?= $etat->getName(); ?></option>
                                        <?php endif;
                                    endforeach;?>
                                </select>
                            </div>
                            <?php if ($bt->getType() === "SANITAIRES") : ?>
                            <div class="col ">
                                <label for="rob" class="form-label fs-5">Rob :</label>
                                <select class="form-select mb-3 text-success" aria-label="Default select example" id="rob" name="rob">
                                    <option class="text-success" value="<?= $bt->getRob(); ?>"><?= $bt->getRob(); ?></option>
                                    <?php foreach ($robs as $rob) : 
                                        if($bt->getRob() !== $rob->getName()) :?>
                                            <option  class="text-success" value="<?= $rob->getName(); ?>"><?= $rob->getName(); ?></option>
                                        <?php endif;
                                    endforeach;?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <div class="col ">
                                <label for="commentaire" class="form-label fs-5">Commentaire :</label>
                                <input type="text" class="form-control text-success" id="commentaire" name="commentaire" value="<?= $bt->getCommentaire(); ?>"></input>
                            </div>
                                <input type="hidden" name="csrftoken" value="<?= $token; ?>">
                            <div class="col-3 align-items-center">
                                <button type="submit" class="btn btn-outline-success position-relative top-50 start-50 translate-middle">Modifier <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            </div>      
                        </div>
                    </form>
                    <div class="col-2"></div>
            <div class=" col-12 m-2 align-items-center">
                <a href="<?= $this->router->generate("vth-update", ['id' => $bt->getId()]) ?>" class="btn btn-outline-warning w-25 position-relative top-50 start-50 translate-middle">Modifier tout le BT
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
                        <a class="dropdown-item" href="<?= $this->router->generate('vth-delete', ['id' => $bt->getId()]) . "?csrftoken=" . $token;?>">Oui, je veux supprimer</a>
                        <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
        <!-- Partie droite (PDF) -->
        <div class="col-12 col-lg-5">
    <div class="p-2">
        <?php if ($bt->getDocument() === null) : ?>
            <h6>Pas de Bt importé</h6>
        <?php else : ?>
            <div id="btEmbed" class="pdf-embed">
                <embed src="<?= $viewData['pdfBaseUri'] . $bt->getDocument() ?>" type="application/pdf" width="100%" height="650px">
            </div>
        <?php endif ?>

        <?php foreach ($files as $index => $file) : ?>
            <div id="fileEmbed<?= $index ?>" class="pdf-embed" style="display: none;">
                <embed src="<?= $viewData['pdfBaseUri'] . $file->getFileName() ?>" type="application/pdf" width="100%" height="650px">
            </div>
        <?php endforeach ?>

        <div class="text-center mt-3">
            <button type="button" class="btn btn-primary" onclick="showBtEmbed()">Voir Bt</button>
            <?php foreach ($files as $index => $file) : ?>
                <button type="button" class="btn btn-primary m-1" onclick="showFileEmbed(<?= $index ?>)">Voir Fichier <?= $index + 1 ?></button>
            <?php endforeach ?>
        </div>
    </div>
</div>

<script>
    function showBtEmbed() {
        document.getElementById("btEmbed").style.display = "block";
        <?php foreach ($files as $index => $file) : ?>
            document.getElementById("fileEmbed<?= $index ?>").style.display = "none";
        <?php endforeach ?>
    }

    function showFileEmbed(index) {
        <?php foreach ($files as $index => $file) : ?>
            document.getElementById("fileEmbed<?= $index ?>").style.display = "none";
        <?php endforeach ?>
        document.getElementById("btEmbed").style.display = "none";
        document.getElementById("fileEmbed" + index).style.display = "block";
    }
</script>

    </div>
</div>




