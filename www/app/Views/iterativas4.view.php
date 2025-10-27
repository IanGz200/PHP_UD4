<?php

declare(strict_types=1);

?>
<div class="card shadow mb-4">
    <form method="post" action="">
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Ejercicios Iterativas 4</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="texto">Texto a procesar:</label>
                        <textarea class="form-control" name="texto" id="texto"  rows="6"
                        ><?php echo $info['texto'] ?? ''; ?></textarea>
                        <p class="text-danger small">
                            <?php
                            echo $errors['texto'] ?? '';
                            ?>
                        </p>
                    </div>
                    <?php if (isset($input['resultado'])) { ?>
                        <div class="row">
                            <p class="text-success ">
                                <?php echo $input['resultado'] ?>
                            </p>
                        </div>
                    <?php }?>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="col-12 text-right">
                <input type="submit" value="Enviar" class="btn btn-primary ml-2"/>
            </div>
        </div>
    </form>
</div>
