<div class="card">
                    <div class="card-header">Etat</div>
                    <div class="card-body">
                    <form  action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du type</label>
                            <input type="text" class="form-control" id="name" value ="<?= $etat->getName() ?>" name="name">
                        </div>
                        <input type="hidden" name="csrftoken" value="<?= $this->generateCSRFToken(); ?>">
                        <div class="d-grid">