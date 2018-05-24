<?php
$voorwerp = haaldetailsop($_GET['voorwerpnummer']);
echo '
<div class="container bg-light">
                   <h1>
                        <?php echo $voorwerp['.looptijd.'] ?> dagen
                    </h1>
                    <div class="row">
                        <div class="col text-center">
                            '. $voorwerp['koper'] . '
                        </div>
                        <div class="col text-center">
                            &euro;'. $voorwerp['bodbedrag'] . '
                        </div>
                        <div class="col text-center">
                           '.  $voorwerp['bodtijdstip'] . '
                        </div>
                    </div>
                </div>';
?>