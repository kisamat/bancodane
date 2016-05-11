<?php
$usuario_incorrecto = $this->session->flashdata('usuario_incorrecto');
if ($usuario_incorrecto) {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> <?php echo $usuario_incorrecto ?>
    </div>
    <?php
}


$registroExitoso = $this->session->flashdata('registroExitoso');
if ($registroExitoso) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <strong><?php echo $registroExitoso ?></strong> 
    </div>
    <?php
}
?>

<div  class="container">
    <form class="form-signin" action="<?php echo base_url('login/enviar_link') ?>" id="login" name="login" method="post">
        <h2 class="form-signin-heading"><?php echo $this->lang->line('titulo_recuperar'); ?></h2>
        <label for="usuario" class="sr-only"> <?php echo $this->lang->line('email'); ?></label>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input type="email" id="usuario" name="usuario" class="validate[required,custom[email]]  form-control" placeholder="Email" required="" autofocus="">
        </div>
        
        
        <p class="text-info text-center"><?php echo $this->lang->line('envio_recupera_clave'); ?></p>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('enviar'); ?></button>
    </form>
</div>