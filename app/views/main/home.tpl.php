<?php if($_SESSION['userObject']->getRole() === "manager" || $_SESSION['userObject']->getRole() === "admin") { ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <a href="<?= $this->router->generate('vth-list');?>" class="shadow-lg col-3 p-5 m-5 btn btn-light rounded rounded-pill border border-4 d-flex justify-content-center align-items-center ">
            <img class="img-fluid" src="<?= $viewData['imagesBaseUri']?>Logo_VTH_CMJN.png" alt="">
        </a>
        <a href="<?= $this->router->generate('tl-list');?>"class="shadow-lg col-3 p-5 m-5 btn btn-light  rounded rounded-pill  border border-4 d-flex justify-content-center align-items-center">
        <img class="img-fluid" src="<?= $viewData['imagesBaseUri']?>touraine-logement.png" alt="">
        </a>
    </div>
</div>
<?php }else{ ?>
    <div class="row d-flex justify-content-center ">
        <a href="<?= $this->router->generate('vth-list');?>" class="shadow-lg col-3 p-5 m-5 btn btn-light rounded rounded-pill  border border-4 d-flex justify-content-center align-items-center">
            <img class="img-fluid" src="<?= $viewData['imagesBaseUri']?>Logo_VTH_CMJN.png" alt="">
        </a>
    </div>
<?php } ?>

