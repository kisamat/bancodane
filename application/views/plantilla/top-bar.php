    <header>
        <div >
        <div class="logos">
        	&nbsp;
        </div>    
        <div class="login-inicial" >
    	<?php 
            if($this->session->userdata('id_usuario') == '')
            {
        ?>
        <form class="navbar-form" role="search" action="<?php echo base_url('login/validar_user') ?>" id="login" name="login" method="post">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <div class="form-group has-feedback" style="text-align: left; margin-top: -20px">
                <label class="control-label"><b>Email</b></label><br>
		<input id="usuario" name="usuario" class="validate[required,custom[email]]  form-control" type="email" placeholder="Email"><br>
            </div>
            <div class="form-group has-feedback" style="text-align: left;">
                <label class="control-label"><b>Contrase&ntilde;a</b></label><br>
		<input type="password" id="pass" name="pass" class="validate[required] form-control" placeholder="Contraseña"><br>
		<a>Has olvidado tu contrase&ntilde;a?</a>
            </div>
						
            <button class="btn btn-default btn-lg" style="background-color: #AD124B; color: #FFFFFF" type="submit"><?php echo $this -> lang -> line('ingresar'); ?></button>
        </form>
	<?php
	}else if ($this->session->userdata('en_sistema') == TRUE) {
	?>
            <h1><?php echo $this->session->userdata('nombre') ?></h1>
        <?php
        }
	?>
    	</div>
        
            
        </div>
        
        
        <div class="separador">
        	&nbsp;
        </div>
    </header>