<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
        $this->load->model('general_model');
        $this->load->model('login_model');
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library('session');
        
        if(!($this->session->userdata('language')))
            {
                $this->session->set_userdata('language', 'spanish');
            }
            
        $user_language = $this->session->userdata('language');
        $this->lang->load('rtc_'.$user_language , $user_language);
    }

    public function index() {

        $datos["titulo"] = $this->general_model->rol_usuario($this->session->userdata('rol'))->descripcion;
        $datos["contenido"] = "administrador/usuarios";
        $datos['roles'] = $this->usuarios_model->roles();

        $datos['rol1'] = $this->usuarios_model->obtener_datosRol1();
        $datos['rol2'] = $this->usuarios_model->obtener_datosRol2();
        $datos['rol3'] = $this->usuarios_model->obtener_datosRol3();

        $this->load->view('plantilla', $datos);
    }

    public function crearUsuario() {

        $datos["titulo"] = $this->general_model->rol_usuario($this->session->userdata('rol'))->descripcion;
        $datos["contenido"] = "administrador/crearUsuario";

        $datos['tipo_identificacion'] = $this->usuarios_model->tipos_identificacion();
        $datos['paises'] = $this->usuarios_model->paises();
        $datos['roles'] = $this->usuarios_model->roles();

        $this->load->view('plantilla', $datos);
    }

    public function guardarUsuario() {

        //$this->load->library('email');
        $this->load->library('My_PHPMailer');

        $datosU['nombres'] = $_REQUEST['inputNombres'];
        $datosU['apellidos'] = $_REQUEST['inputApellidos'];
        $datosU['email'] = $_REQUEST['inputEmail'];
        $datosU['codi_pais'] = $_REQUEST['pais'];

        //Se registra la informacion del usuario, restorna el ID que asigna la BD
        $resultadoID = $this->usuarios_model->insertarUsuario($datosU);

        if ($resultadoID) {
            $datosRol['id_usuario'] = $resultadoID;
            $datosRol['rol'] = $_REQUEST['rol_usuario'];
            $datosRol['estado'] = 'AC';
            $resultadoRol = $this->usuarios_model->insertarRolUsuario($datosRol);

            //Asignamos el ID que retorna a la variable id_usuario
            $datosCom['id_usuario'] = $resultadoID;
            $datosCom['cargo'] = $_REQUEST['inputCargo'];
            $datosCom['especialidad'] = $_REQUEST['inputEspeci'];

            $resultadoDatos = $this->usuarios_model->insertarDatosUsuario($datosCom);

            $psswd = $this->generaPass();
            $datosLogin['usuario_id_usuario'] = $resultadoID;
            $datosLogin['usuario'] = $_REQUEST['inputEmail'];
            $datosLogin['clave'] = sha1(md5($psswd));
            $datosLogin['estado'] = 'AC';

            $resultadoLogin = $this->usuarios_model->insertarDatosLogin($datosLogin);

            $this->load->library('email');

            $mail = new PHPMailer();
            $mail->IsSMTP(); // establecemos que utilizaremos SMTP
            $mail->IsHTML(true);
            $mail->SetFrom('rtc-candane@dane.gov.co', $this->lang->line('rtc'));  //Quien env&iacute;a el correo
            $mail->AddReplyTo("esanchez1988@gmail.com", "Edwin Sanchez");  //A quien debe ir dirigida la respuesta
            $mail->Subject = $this->lang->line('Registro de Usuarios RTC');  //Asunto del mensaje
            $mail->AddEmbeddedImage("assets/imgs/logo-rtc.jpg", 'imagen.jpg', "logo-rtc.jpg", 'base64', 'image/jpeg');

            $html = '
              <p><img src="cid:imagen.jpg"></p>
              <p>'.$this->lang->line('bienvenido').'</p>
              <p>'.$this->lang->line('parrafo1EmailRegistro').'.</p>
              <p>'.$this->lang->line('parrafo2EmailRegistro').' <a href="' . base_url() . '" target="_blank">link</a></p>
              <p>'.$this->lang->line('parrafo3EmailRegistro').':<br>
              '.$this->lang->line('user').': ' . $_REQUEST['inputEmail'] . '<br>
              '.$this->lang->line('password').': ' . $psswd . '
              </p>
              <p>.</p>
              ';

            $mail->Body = $html;
            $mail->AddAddress($_REQUEST['inputEmail'], $_REQUEST['inputNombres'] . " " . $_REQUEST['inputApellidos']);
            $mail->addBCC("esanchez1988@gmail.com", "Edwin Sanchez");

            if (!$mail->Send()) {
                $data["message"] = $this->lang->line('errorEnvio') . $mail->ErrorInfo;
                $this->session->set_flashdata('errorBD', $data["message"]);
                redirect(base_url('administrador/usuarios'), 'refresh');
            } else {
                //$data["message"] = "¡Mensaje enviado correctamente!";
                $this->session->set_flashdata('registroExitoso', $this->lang->line('registroExitoUsuario'));
                redirect(base_url('administrador/usuarios'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('errorBD', $this->lang->line('errorBD'));
            redirect(base_url('administrador/usuarios'), 'refresh');
        }
    }

    public function generaPass() {
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);

        //Se define la variable que va a contener la contrase&ntilde;a
        $pass = "";
        //Se define la longitud de la contrase&ntilde;a, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass = 10;

        //Creamos la contrase&ntilde;a
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);

            //Vamos formando la contrase&ntilde;a en cada iteraccion del bucle, a&ntilde;adiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

    public function obtenerCargo() {
        $icargo = $_REQUEST['cargo'];
        $registro = $this->usuarios_model->obtenerCargo($icargo);

        if (is_array($registro)) {
            foreach ($registro as $fila) {
                $respuesta[] = array("label" => $fila->desc_cargo, "value" => $fila->id_cargo);
            }
        } else {
            $respuesta[] = array("label" => " ", "value" => "-1");
        }
        $data = json_encode($respuesta);
        echo $data;
        exit;
    }

    public function obtenerEspecialidad() {
        $iespec = $_REQUEST['espec'];
        $registro = $this->usuarios_model->obtenerEspeci($iespec);

        if (is_array($registro)) {
            foreach ($registro as $fila) {
                $respuesta[] = array("label" => $fila->desc_espec, "value" => $fila->id_espec);
            }
        } else {
            $respuesta[] = array("label" => " ", "value" => "-1");
        }
        $data = json_encode($respuesta);
        echo $data;
        exit;
    }

    public function editarUsuario($idUsuario) {

        $datos["titulo"] = $this->general_model->rol_usuario($this->session->userdata('rol'))->descripcion;
        $datos["contenido"] = "administrador/editarUsuario";

        $datos['datosUsuario'] = $this->usuarios_model->datosUsuario($idUsuario);
        $datos['paises'] = $this->usuarios_model->paises();
        $datos['roles'] = $this->usuarios_model->roles();

        $this->load->view('plantilla', $datos);
    }

    public function actualizarUsuario() {
        $id_usuario = $_REQUEST['id_usuario'];
        $nombres = $_REQUEST['inputNombres'];
        $apellidos = $_REQUEST['inputApellidos'];
        $cargo = $_REQUEST['inputCargo'];
        $especialidad = $_REQUEST['inputEspeci'];
        $email = $_REQUEST['inputEmail'];
        $codi_pais = $_REQUEST['pais'];
        $rol = $_REQUEST['rol_usuario'];

        $act_usuario = $this->usuarios_model->actualizarUsuario($id_usuario, $nombres, $apellidos, $email, $codi_pais);

        if ($act_usuario) {
            $act_usuario_datos = $this->usuarios_model->actualizarUsuarioDatos($id_usuario, $cargo, $especialidad);

            if ($act_usuario_datos) {
                $act_usuario_rol = $this->usuarios_model->actualizarUsuarioRol($id_usuario, $rol);
                if ($act_usuario_rol) {
                    $this->session->set_flashdata('datosUsuario', $this->lang->line('Datos actualizados correctamente'));
                    redirect(base_url('administrador/usuarios'), 'refresh');
                } else {
                    $this->session->set_flashdata('errorBD', $this->lang->line('Ocurrio un error al intentar actualizar el registro del rol'));
                    redirect(base_url('administrador/usuarios'), 'refresh');
                }
            } else {
            $this->session->set_flashdata('errorBD', $this->lang->line('Ocurrio un error al intentar actualizar el registro del cargo y/o especialidad.'));
                redirect(base_url('administrador/usuarios'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('errorBD', $this->lang->line('Ocurrio un error al intentar actualizar el registro de datos.'));
            redirect(base_url('administrador/usuarios'), 'refresh');
        }
    }

    public function borrarUsuario($idUsuario) {

        $delete = $this->usuarios_model->eliminar_usuario($idUsuario);
        redirect(base_url('administrador/usuarios'), 'refresh');
        echo $idUsuario;
    }

}
