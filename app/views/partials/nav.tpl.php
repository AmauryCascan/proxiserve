<nav class="navbar sticky-top navbar-expand">
    <div class="container-fluid bg-light  position-relative">
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <!-- avec le if ci-dessous, on vérifie si l'utilisateur est connecté ou pas ! -->
                <?php if(isset($_SESSION['userObject']) && $_SESSION['userObject']->getStatus() === 1) :?>
                
                <!-- l'utilisateur est connecté ! -->
                <a class="navbar-brand" href="<?= $this->router->generate('main-home');?>">Home</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['userObject']->getFirstname() . " ". $_SESSION['userObject']->getLastname() ?>
                    </button>
                    <div class="dropdown-menu">
                        <?php if($_SESSION['userObject']->getRole() === "manager") { ?>
                        <a class="dropdown-item" href="<?= $this->router->generate('user-list') ?>">Utilisateurs</a>
                        <a class="dropdown-item" href="<?= $this->router->generate('infos-list');?>">Types/secteurs/Etats</a>       
                        <a class="dropdown-item" href="<?= $this->router->generate('security-logout') ?>">Logout</a>
                        <?php }else{ ?>
                        <a class="dropdown-item" href="<?= $this->router->generate('security-logout') ?>">Logout</a>
                        <?php } ?>       
                    </div>
                <?php endif; ?>      
                </div>
                    <?php if(isset($_SESSION['userObject']) && $_SESSION['userObject']->getStatus() === 1 && strpos($_SERVER['REQUEST_URI'], 'vth') !== false) : ?>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "vthTravaux/add") ? "active" : "" ?>" 
                                    href="<?= $this->router->generate('vth-add');?>">Nouveau Bon</a>
                            <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "vth/encours") ? "active" : "" ?>"
                                 href="<?= $this->router->generate('vth-list');?>">En cours</a>
                            <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "vth/facture") ? "active" : "" ?>" 
                                href="<?= $this->router->generate('facture-list');?>">Facturé</a>
                            <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "vth/annule") ? "active" : "" ?>" 
                                href="<?= $this->router->generate('annule-list');?>">Annulé</a>
                                <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "vth/robinetterie") ? "active" : "" ?>" 
                                href="<?= $this->router->generate('robinetterie-list');?>">Robinetterie</a>
                            <?php if($_SESSION['userObject']->getRole() === "manager" || $_SESSION['userObject']->getRole() === "admin") : ?>
                            <?php endif ?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['userObject']) && strpos($_SERVER['REQUEST_URI'], 'tl') !== false) : 
                            if($_SESSION['userObject']->getRole() === "manager" || $_SESSION['userObject']->getRole() === "admin") :?>
                            <div class="btn-group">
                            <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "tlTravaux/add") ? "active" : "" ?>" 
                                    href="<?= $this->router->generate('tl-add');?>">Nouveau Bon</a> 
                                <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "tl/encours") ? "active" : "" ?>"
                                     href="<?= $this->router->generate('tl-list');?>">En cours</a>
                                <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "tl/facture") ? "active" : "" ?>" 
                                    href="<?= $this->router->generate('facturetl-list');?>">Facturé</a>
                                <a class="btn btn-sm btn-outline-dark <?= ($currentPage === "tl/annule") ? "active" : "" ?>" 
                                    href="<?= $this->router->generate('annuletl-list');?>">Annulé</a>
                            </div>
                        <?php endif;
                    endif; ?>
                
            </div>     
    </div>
</nav>
