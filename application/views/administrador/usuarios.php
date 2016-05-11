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

$registroExitoso = $this->session->flashdata('registroExitoso');
if ($registroExitoso) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong>OK!</strong> <?php echo $registroExitoso ?>
    </div>
    <?php
}
?>

<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <center>
            <a href="<?php echo base_url('administrador/usuarios/crearUsuario') ?>">
                <img src="<?php echo base_url('assets/img/usuario.png') ?>">
                <br>
                <?php echo $this->lang->line('crearUsuario'); ?>
            </a>
        </center>
    </div>
</div>


<div id="tabs">
    <ul>
        <li><a href="#tabs-1"><?php echo $this->lang->line('administradoresRTC'); ?></a></li>
        <li><a href="#tabs-2"><?php echo $this->lang->line('Coordinadores'); ?></a></li>
        <li><a href="#tabs-3"><?php echo $this->lang->line('Miembros'); ?></a></li>
    </ul>
    <div id="tabs-1">
        <table id="usuarios1" class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('ID'); ?></th>
                    <th><?php echo $this->lang->line('Nombres'); ?></th>
                    <th><?php echo $this->lang->line('Apellidos'); ?></th>
                    <th><?php echo $this->lang->line('Email'); ?></th>
                    <th><?php echo $this->lang->line('Pais'); ?></th>
                    <th><?php echo $this->lang->line('Editar'); ?></th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rol1 as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->id_usuario ?>
                        </td>                        
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
                                <a href="<?php echo base_url('administrador/usuarios/editarUsuario/'.$row->id_usuario) ?>">
                                    <img src="<?php echo base_url('assets/img/editar.png') ?>" width="20">
                                </a>
                            </center>
                        </td>
                        <!--
                        <td>
                            <center>
                                <a onclick="borrarUsuario(<?php echo $row->id_usuario?>)" href="#">
                                    <img src="<?php echo base_url('assets/img/no.png') ?>" width="20">
                                </a>
                            </center>
                        </td>-->
                    </tr>
                    <?php
                }
                ?>
            <tbody>
        </table>
    </div>
    <div id="tabs-2">
        <table id="usuarios2" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('ID'); ?></th>
                    <th><?php echo $this->lang->line('Nombres'); ?></th>
                    <th><?php echo $this->lang->line('Apellidos'); ?></th>
                    <th><?php echo $this->lang->line('Email'); ?></th>
                    <th><?php echo $this->lang->line('Pais'); ?></th>
                    <th><?php echo $this->lang->line('Editar'); ?></th>   
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rol2 as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->id_usuario ?>
                        </td>
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
                                <a href="<?php echo base_url('administrador/usuarios/editarUsuario/'.$row->id_usuario) ?>">
                                    <img src="<?php echo base_url('assets/img/editar.png') ?>" width="20">
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
    <div id="tabs-3">
        <table id="usuarios3" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('ID'); ?></th>
                    <th><?php echo $this->lang->line('Nombres'); ?></th>
                    <th><?php echo $this->lang->line('Apellidos'); ?></th>
                    <th><?php echo $this->lang->line('Email'); ?></th>
                    <th><?php echo $this->lang->line('Pais'); ?></th>
                    <th><?php echo $this->lang->line('Editar'); ?></th>   
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rol3 as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row->id_usuario ?>
                        </td>
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
                                <a href="<?php echo base_url('administrador/usuarios/editarUsuario/'.$row->id_usuario) ?>">
                                    <img src="<?php echo base_url('assets/img/editar.png') ?>" width="20">
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

<div id="crearUsuario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('Crear Usuario'); ?></h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Cerrar'); ?></button>
                <button type="button" class="btn btn-primary"><?php echo $this->lang->line('Guardar'); ?></button>
            </div>
        </div>
    </div>
</div>

<div id="borrar-confirm" title="Borrar Usuario">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro que quiere borrar este usuario?</p>
</div>