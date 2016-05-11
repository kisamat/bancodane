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

$miembroAsociado = $this->session->flashdata('miembroAsociado');
if ($miembroAsociado) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $miembroAsociado ?></strong> 
    </div>
    <?php
}

$correoEnviado = $this->session->flashdata('correoEnviado');
if ($correoEnviado) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $correoEnviado ?></strong> 
    </div>
    <?php
}
?>
<center><h2><?php echo $datosGrupo[0]->nombre_grupo ?></h2></center>
<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <center>
            <a href="<?php echo base_url('coordinador/grupos_trabajo/invitarMiembro/'.$datosGrupo[0]->id_grupo) ?>">
                <img src="<?php echo base_url('assets/img/usuario.png') ?>">
                <br>
                <?php echo $this->lang->line('Invitar Miembro de Grupo'); ?>
            </a>
        </center>
    </div>
</div>
<div id="tabsGrupo">
    <ul>
        <li><a href="#tabsGrupo-1"><?php echo $this->lang->line('Miembros del Grupo de Trabajo'); ?></a></li>
        <li><a href="#tabsGrupo-2"><?php echo $this->lang->line('Asociar Miembros'); ?></a></li>
    </ul>
    <div id="tabsGrupo-1">
        <table id="grupos1" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Nombres'); ?></th>
                    <th><?php echo $this->lang->line('Apellidos'); ?></th>
                    <th><?php echo $this->lang->line('Email'); ?></th>
                    <th><?php echo $this->lang->line('Pa&iacute;s'); ?></th>
                    <th><?php echo $this->lang->line('Fecha Ingreso'); ?></th>
                    <th><?php echo $this->lang->line('Desasociar Miembro'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($miembros as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->nombres ?>
                        </td>
                        <td>
                            <?php echo $row->apellidos ?>
                        </td>
                        <td>
                            <?php echo $row->email ?>
                        </td>                        
                        <td>
                            <?php echo $row->desc_pais ?>
                        </td>                        
                        <td>
                            <?php echo $row->fecha_ingreso ?>
                        </td>                           
                        <td>
                            <center>
                                <a href="<?php echo base_url('coordinador/grupos_trabajo/desasociarMiembro/' . $row->id_usuario . "/" . $datosGrupo[0]->id_grupo) ?>">
                                    <img src="<?php echo base_url('assets/img/no_usuario.png') ?>">
                                </a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
    </div>
    <div id="tabsGrupo-2">
        <table id="grupos2" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Nombres'); ?></th>
                    <th><?php echo $this->lang->line('Apellidos'); ?></th>
                    <th><?php echo $this->lang->line('Email'); ?></th>
                    <th><?php echo $this->lang->line('Pa&iacute;s'); ?></th>
                    <th><?php echo $this->lang->line('Asociar a Grupo de Trabajo'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($nomiembros as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->nombres ?>
                        </td>
                        <td>
                            <?php echo $row->apellidos ?>
                        </td>
                        <td>
                            <?php echo $row->email ?>
                        </td>         
                        <td>
                            <?php echo $row->desc_pais ?>
                        </td>         
                        <td>
                            <center>
                                <a href="<?php echo base_url('coordinador/grupos_trabajo/asociarMiembro/' . $row->id_usuario . "/" . $datosGrupo[0]->id_grupo) ?>">
                                    <img src="<?php echo base_url('assets/img/usuario.png') ?>">
                                </a>
                            </center>
                        </td>         
                </tr>
                <?php
            }
            ?>
            <tbody>
        </table>
    </div>
</div>

