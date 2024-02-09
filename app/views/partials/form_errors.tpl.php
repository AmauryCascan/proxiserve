<?php   if(isset($errorList)) : ?>
                    <div class="alert alert-warning" role="alert">
                        <ul class="mb-0">
                            <?php foreach($errorList as $error) : ?>
                                <!-- pour chaque message d'erreur dans le tableau, on ajoute un li -->
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php  endif; ?>