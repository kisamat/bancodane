<div class="navbar navbar-default">
    <div class="container">        
            <div class="navbar-collapse collapse" id="navbar-main">  
				<ul class="nav navbar-nav top-nav-bar-left">
                    <?php
				
					//EN ESTA PARTE SE MANEJA EL MENU DINAMICO PARA LOS DIFERENTES PERFILES
					$menu_padre = $this->login_model->menu_padre_user($this->session->userdata('rol'));

					foreach ($menu_padre as $mp) {
						unset($menu_hijos);
						$menu_hijos = $this->login_model->menu_hijos_user($mp->id_menu);
                                                
						if (is_array($menu_hijos) && count($menu_hijos) > 0) {
							?>
							<li class="dropdown">
								<a href="<?php echo base_url($mp->href) ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $mp->descripcion ?><span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<?php
									foreach ($menu_hijos as $mh) {
										?>
										<li><a href="<?php echo base_url($mh->href) ?>"><?php echo $mh->descripcion; ?></a></li>
										<?php
									}
									?>
								</ul>
							</li>    
							<?php
						} else {
							?>
							<li><a href="<?php echo base_url($mp->href) ?>"><?php echo $mp->descripcion; ?></a></li>
							<?php
						}
					}
					
					if ($this->session->userdata('en_sistema') == TRUE) {
						?>
						
						<li>
							<button type="button" class="btn-base btn-sesion" style="background-color: #AD124B; color: #FFFFFF" data-toggle="button" onclick="location.replace('<?php echo base_url() ?>login/logout_ci')"><span><img class="icon-sesion" src="<?php echo base_url('assets/imgs/icons/logout.png') ?>"</span> <?php echo $this->lang->line('cerrarSesion');?></button>
						</li>
						<?php
						}					
				?>
                </ul>				
            </div>
    </div>
</div>