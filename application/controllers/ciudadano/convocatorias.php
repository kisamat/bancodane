<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Convocatorias extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('usuarios_model');
		$this -> load -> model('general_model');
		$this -> load -> model('login_model');
		$this -> load -> model('usuarios_model');
		$this -> load -> model('convocatorias_model');
		$this -> load -> model('perfil_model');
		$this -> load -> helper(array('url', 'form', 'html'));
		$this -> load -> library('session');

		if (!($this -> session -> userdata('language'))) {
			$this -> session -> set_userdata('language', 'spanish');
		}

		$user_language = $this -> session -> userdata('language');
		$this -> lang -> load('rtc_' . $user_language, $user_language);
	}

	public function index() {

		$datos["titulo"] = $this -> general_model -> rol_usuario($this -> session -> userdata('rol')) -> descripcion;
		$datos["contenido"] = "ciudadano/convocatorias";

		$datos['conv_participando'] = $this -> convocatorias_model -> ciudadano_conv_participa($this -> session -> userdata('id_usuario'));
		$datos['conv_abiertas'] = $this -> convocatorias_model -> ciudadano_conv_abiertas();
		$datos['conv_cerradas'] = $this -> convocatorias_model -> ciudadano_conv_cerradas($this -> session -> userdata('id_usuario'));

		$this -> load -> view('plantilla', $datos);
	}

	public function guardarConvocatoria() {

		$datosC['tipo_conv'] = $_REQUEST['tipo_conv'];
		$datosC['id_investigacion'] = $_REQUEST['investigacion'];
		$datosC['id_rol'] = $_REQUEST['rol'];
		$datosC['perfil'] = $_REQUEST['perfil'];
		$datosC['objeto'] = $_REQUEST['objeto'];
		$datosC['obligaciones'] = $_REQUEST['obligaciones'];

		$resultadoConvocatoria = $this -> convocatorias_model -> insertarDatosConvocatoria($datosC);

		if ($resultadoConvocatoria) {
			for ($ciu = 0; $ciu < count($_REQUEST['ciudades']); $ciu++) {
				$datosI['id_convocatoria'] = $resultadoConvocatoria;
				$datosI['id_ciudad'] = $_REQUEST['ciudades'][$ciu];
				$datosI['fecha_inicio'] = $_REQUEST['fechaInicio'];
				$datosI['fecha_fin'] = $_REQUEST['fechaFin'];

				$resultadoConvocatoriaIns = $this -> convocatorias_model -> insertarConvocatoriaInsc($datosI);
			}

			$this -> session -> set_flashdata('retornoExito', 'Se registro la convocatoria correctamente');
			redirect(base_url('administrador/convocatorias'), 'refresh');
		} else {
			$this -> session -> set_flashdata('retornoError', 'Error al registrar la convocatoria');
			redirect(base_url('administrador/convocatorias'), 'refresh');
		}
	}

	public function aplicar($idConvocatoria) {

		//verificar si el usuario esta aplicando a una convocatoria actualmente
		$datos['conv_participando'] = $this -> convocatorias_model -> verificaCruceConvocatoria($this -> session -> userdata('id_usuario'));

		if (count($datos['conv_participando']) > 0) {
			$this -> session -> set_flashdata('retornoError', 'No puede aplicar a la convocatoria, ya que se encuentra participando actualmente en una convocatoria activa');
			redirect(base_url('administrador/convocatorias'), 'refresh');
		} else {
			$datosC['id_usuario'] = $this -> session -> userdata('id_usuario');
			$datosC['id_convocatoria'] = $idConvocatoria;
			$datosC['estado'] = 'AC';

			$resultadoConvocatoria = $this -> convocatorias_model -> insertarConvocatoriaUsuario($datosC);
			
			if ($resultadoConvocatoria) {
				
				$infoConv = $this -> convocatorias_model -> infoConv($idConvocatoria);
				echo "<pre>";
				print_r($infoConv);
				echo "</pre>";
				exit;
				$this -> load -> library('My_PHPMailer');

				$this -> load -> library('email');
				$configMail = array('protocol' => 'smtp', 'smtp_host' => 'mail.dane.gov.co', 'smtp_port' => 25, 'smtp_user' => 'aplicaciones@dane.gov.co', 'smtp_pass' => '0u67UtapW3v', 'mailtype' => 'html', 'charset' => 'utf-8', 'newline' => "\r\n");
				//cargamos la configuración para enviar mail
				$this -> email -> initialize($configMail);

				$this -> email -> from('aplicaciones@dane.gov.co', 'Innovación');
				$this -> email -> to($this -> session -> userdata('mail'));
				$this -> email -> cc('esanchez1988@gmail.com');
				$this -> email -> subject('Registro a la convocatoria'.$infoConv[0]->nombre_inv.' - '.$infoConv[0]->nombre_rol_inv.'');
				
				$html = '
						  <p><b>Bievenido</b></p>
						  <p>Usted se ha registrado para participar en la convocatoria '.$infoConv[0]->nombre_inv.' - '.$infoConv[0]->nombre_rol_inv.' </p>
						  <p><b>Hasta:</b> ' . $_POST['to'] . '</p>
						  <p><b>Asunto:</b> ' . $_POST['title'] . '</p>
						  <p><b>Descripción:</b> ' . $_POST['event'] . '</p>
						  ';

				$this -> email -> message($html);
				if ($this -> email -> send()) {
				}

			}

			$this -> session -> set_flashdata('retornoExito', 'Usted ha aplicado correctamente a la convocatoria, por favor verifique su correo para continuar con el proceso.');
			redirect(base_url('administrador/convocatorias'), 'refresh');

		}

		$datosC['tipo_conv'] = $_REQUEST['tipo_conv'];
		$datosC['id_investigacion'] = $_REQUEST['investigacion'];
		$datosC['id_rol'] = $_REQUEST['rol'];
		$datosC['perfil'] = $_REQUEST['perfil'];
		$datosC['objeto'] = $_REQUEST['objeto'];
		$datosC['obligaciones'] = $_REQUEST['obligaciones'];

		$resultadoConvocatoria = $this -> convocatorias_model -> insertarDatosConvocatoria($datosC);

		if ($resultadoConvocatoria) {
			for ($ciu = 0; $ciu < count($_REQUEST['ciudades']); $ciu++) {
				$datosI['id_convocatoria'] = $resultadoConvocatoria;
				$datosI['id_ciudad'] = $_REQUEST['ciudades'][$ciu];
				$datosI['fecha_inicio'] = $_REQUEST['fechaInicio'];
				$datosI['fecha_fin'] = $_REQUEST['fechaFin'];

				$resultadoConvocatoriaIns = $this -> convocatorias_model -> insertarConvocatoriaInsc($datosI);
			}

			$this -> session -> set_flashdata('retornoExito', 'Se registro la convocatoria correctamente');
			redirect(base_url('administrador/convocatorias'), 'refresh');
		} else {
			$this -> session -> set_flashdata('retornoError', 'Error al registrar la convocatoria');
			redirect(base_url('administrador/convocatorias'), 'refresh');
		}
	}

}
