<?php
$errorBD = $this->session->flashdata('errorBD');
if ($errorBD) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $errorBD ?>
    </div>
    <?php
}

$errorArchivo = $this->session->flashdata('errorArchivo');
if ($errorArchivo) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>Error!</strong> <?php echo $errorArchivo ?>
    </div>
    <?php
}

$respuestaCreada = $this->session->flashdata('respuestaCreada');
if ($respuestaCreada) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $respuestaCreada ?></strong> 
    </div>
    <?php
}
?>
<div>
    <fieldset>
        <legend><h2><?php echo $detalleForo[0]->foro_tema ?></h2></legend>
        <div class="row">            
            <div class="col-lg-8">
                <h7><?php echo $detalleForo[0]->foro_fecha ?></h7>
            </div>
            <div class="col-lg-8">
                <h7>
                    <?php echo $detalleForo[0]->nombres . " " . $detalleForo[0]->apellidos ?><br>
                    <?php echo $detalleForo[0]->email ?>
                </h7>
            </div>
            <?php
            if (trim($detalleForo[0]->ruta) != '') {
                ?>
                <div class="col-lg-4">
                    <h3>Archivos Asociados</h3>
                    <a href="<?php echo base_url('uploads/' . $detalleForo[0]->nombre) ?>">
                        <i class="fa fa-fw fa-file fa-3x"></i><?php echo $detalleForo[0]->nombre ?>
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="col-lg-8">
                <h4><?php echo $detalleForo[0]->foro_descripcion ?></h4>
            </div>

        </div>


    </fieldset>
    <div class="row">
        <div class="col-lg-12">
            <center>
                <a href="<?php echo base_url('coordinador/grupos_trabajo/responderForo/' . $id_grupo . "/" . $detalleForo[0]->id_foro) ?>">
                    <img src="<?php echo base_url('assets/img/responder.png') ?>"> <br>                              
                    Reponder Tema
                </a>
            </center>
        </div>
    </div>
</div>


<div id="detalleForosResp">
    <?php
    foreach ($respuestasForo as $row) {
        ?>
        <h3><a href="#"><?php echo $row->respuesta_fecha ?></a></h3>
        <div>
            <div class="row text-success alert-info">
                <div class="col-lg-4">
                    <img src="<?php echo base_url('assets/img/usuario.png') ?>">
                </div>
                <div class="col-lg-4">
                    <h2><?php echo $row->respuesta_nombre ?></h2>
                </div>
                <div class="col-lg-4">
                    Nombre: <?php echo $row->respuesta_nombre ?><br>
                    Email: <?php echo $row->respuesta_email ?><br>
                    Fecha Respuesta: <?php echo $row->respuesta_fecha ?>                    
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-8 text-info">
                    <?php echo $row->respuesta ?>
                </div>
                <?php
                if (trim($row->ruta) != '') {
                    ?>
                    <div class="col-lg-4">
                        <h3>Archivos Asociados</h3>
                        <a href="<?php echo base_url('uploads/' . $row->nombre) ?>">
                            <i class="fa fa-fw fa-file fa-3x"></i><?php echo $row->nombre ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>  
</div>


