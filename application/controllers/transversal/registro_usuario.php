<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registro_usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
        $this->load->model('usuarios_model');
        $this->load->model('grupos_model');
        $this->load->helper(array('url', 'form', 'html'));
        //$this->load->library('session');
    }

    public function index() {

        $datos["titulo"] = "Registro de Usuarios";
        $datos["contenido"] = "transversal/registro_usuario";
        $datos["id_grupo"] = $id_grupo;

        $this->load->view('plantilla', $datos);
    }

    public function formulario($id_grupo) {

        $datos["titulo"] = "Registro de Usuarios";
        $datos["contenido"] = "transversal/registro_usuario";
        $datos['paises'] = $this->usuarios_model->paises();
        $datos["id_grupo"] = $id_grupo;

        $this->load->view('plantilla', $datos);
    }

    public function guardarUsuario() {

        //$this->load->library('email');
        //$this->load->library('My_PHPMailer');

        $datosU['tipo_iden'] = $_REQUEST['tipo_iden'];
        $datosU['nume_iden'] = $_REQUEST['inputNumeIden'];
        $datosU['nombres'] = $_REQUEST['inputNombres'];
        $datosU['apellidos'] = $_REQUEST['inputApellidos'];
        $datosU['fecha_naci'] = $_REQUEST['fechaNaci'];
        $datosU['sexo'] = $_REQUEST['sexo'];

        //Se registra la informacion del usuario, restorna el ID que asigna la BD
        $resultadoID = $this->usuarios_model->insertarUsuario($datosU);
		//$resultadoID = 4;
        if ($resultadoID) {
			$datosRol['id_usuario'] = $resultadoID;
            $datosRol['rol'] = 3;
            $datosRol['estado'] = 'AC';
            $resultadoRol = $this->usuarios_model->insertarRolUsuario($datosRol);
			            
            $psswd = $_REQUEST['inputClave'];
            $datosLogin['usuario_id_usuario'] = $resultadoID;
            $datosLogin['usuario'] = $_REQUEST['inputEmail'];
            $datosLogin['clave'] = sha1(md5($psswd));
            $datosLogin['estado'] = 'IN';

            $resultadoLogin = $this->usuarios_model->insertarDatosLogin($datosLogin);
						
			$datosActi = $resultadoID;
			
			$datosLink = strrev(base64_encode($datosActi));
			$link = base_url('transversal/registro_usuario/activar/'.$datosLink);
			
			$this->load->library('My_PHPMailer');
			$this->load->library('email');

			$mail = new PHPMailer();
			$mail->IsSMTP(); // establecemos que utilizaremos SMTP
			$mail->IsHTML(true);
			$mail->SetFrom('dane-bhv@dane.gov.co', 'DANE - Banco de Hojas de Vida');  //Quien env&iacute;a el correo
			$mail->Subject = "Activar Cuenta DANE - Banco de Hojas de Vida";  //Asunto del mensaje

			$html = '			
              <p>Bienvenido</p>
              <p>'.$_REQUEST['inputNombres'].',</p>
			  <p>Gracias por registrarte! Puedes hacer click en el siguiente vínculo para activar tu cuenta:.</p>
			  <p>'.$link.'</p>
              <p>Puede acceder a la plataforma a trav&eacute;s del siguiente <a href="' . base_url() . '" target="_blank">link</a></p>
              <p>Sus datos de ingreso son los siguientes:<br>
              Usuario: ' . $_REQUEST['inputEmail'] . '<br>
              </p>
              <p>Recuerde que puede cambiar su contrase&ntilde;a despues de ingresar a la plataforma.</p>';

			$mail->Body = $html;
			$mail->AddAddress($_REQUEST['inputEmail'], $_REQUEST['inputEmail']);
			//$mail->AddAddress("esanchez1988@gmail.com", "Edwin Sanchez");
            $mail->addBCC("esanchez1988@gmail.com", "Edwin Sanchez");
			$mail->Send();
			
			$this->session->set_flashdata('retornoExito', 'Registro Exitoso. Por favor, verifique el correo electr&oacute;nico registrado y active su cuenta');
			redirect(base_url(), 'refresh');
        }else {
            $this->session->set_flashdata('retornoError', 'Ocurrio un error al intentar guardar el registro.');
            redirect(base_url('administrador/usuarios'), 'refresh');
        }
    }
	
	public function activar($usuario)
	{
		$dato = strrev($usuario);
		$dato = base64_decode($dato);
		
		$resultadoLogin = $this->usuarios_model->activarCuenta($dato);
		$resultadoLogin = $this->usuarios_model->activarFecha($dato);
		
		$this->session->set_flashdata('retornoExito', 'Activaci&oacute;n Exitosa, Ingrese con su usuario y contrase&ntilde;a');
		redirect(base_url(), 'refresh');
	}

}
