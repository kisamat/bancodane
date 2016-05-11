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
        $this->load->model('usuarios_model');
        $this->load->model('general_model');
        $this->load->model('login_model');
        $this->load->model('usuarios_model');
        $this->load->model('convocatorias_model');
        $this->load->model('perfil_model');
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library('session');


        if (!($this->session->userdata('language'))) {
            $this->session->set_userdata('language', 'spanish');
        }

        $user_language = $this->session->userdata('language');
        $this->lang->load('rtc_' . $user_language, $user_language);
    }

    public function index() {

        $datos["titulo"] = $this->general_model->rol_usuario($this->session->userdata('rol'))->descripcion;
        $datos["contenido"] = "administrador/convocatorias";
        $datos['investigaciones'] = $this->convocatorias_model->investigaciones();
        $datos['roles'] = $this->convocatorias_model->roles();
        $datos['ciudades'] = $this->convocatorias_model->sedes();

        $datos['conv_abiertas'] = $this->convocatorias_model->conv_abiertas_info();
        $datos['conv_cerradas'] = $this->convocatorias_model->conv_cerradas_info();

        $this->load->view('plantilla', $datos);
    }

    public function invitar($id) {

        $datos["titulo"] = $this->general_model->rol_usuario($this->session->userdata('rol'))->descripcion;
        $datos["contenido"] = "administrador/invitar";
        $datos["idConv"] = $id;
        $datos["usuariosInvitados"] = $this->convocatorias_model->usuariosInvitados($id);

        $this->load->view('plantilla', $datos);
    }

    public function guardarConvocatoria() {

        $datosC['tipo_conv'] = $_REQUEST['tipo_conv'];
        $datosC['id_investigacion'] = $_REQUEST['investigacion'];
        $datosC['id_rol'] = $_REQUEST['rol'];
        $datosC['perfil'] = $_REQUEST['perfil'];
        $datosC['objeto'] = $_REQUEST['objeto'];
        $datosC['obligaciones'] = $_REQUEST['obligaciones'];

        $resultadoConvocatoria = $this->convocatorias_model->insertarDatosConvocatoria($datosC);

        if ($resultadoConvocatoria) {
            for ($ciu = 0; $ciu < count($_REQUEST['ciudades']); $ciu++) {
                $datosI['id_convocatoria'] = $resultadoConvocatoria;
                $datosI['id_ciudad'] = $_REQUEST['ciudades'][$ciu];
                $datosI['fecha_inicio'] = $_REQUEST['fechaInicio'];
                $datosI['fecha_fin'] = $_REQUEST['fechaFin'];


                $resultadoConvocatoriaIns = $this->convocatorias_model->insertarConvocatoriaInsc($datosI);
            }

            $this->session->set_flashdata('retornoExito', 'Se registro la convocatoria correctamente');
            redirect(base_url('administrador/convocatorias'), 'refresh');
        } else {
            $this->session->set_flashdata('retornoError', 'Error al registrar la convocatoria');
            redirect(base_url('administrador/convocatorias'), 'refresh');
        }
    }

    public function requisitos($id) {

        $datos["titulo"] = $this->general_model->rol_usuario($this->session->userdata('rol'))->descripcion;
        $datos["contenido"] = "administrador/requisitos";
        $datos['investigaciones'] = $this->convocatorias_model->investigaciones();
        $datos['roles'] = $this->convocatorias_model->roles();
        $datos['ciudades'] = $this->convocatorias_model->sedes();
        $datos['niveles'] = $this->perfil_model->niveles();
        $datos['areas'] = $this->convocatorias_model->listaAreas();

        $datos['infoConv'] = $this->convocatorias_model->infoConv($id);
        $datos['infoRequ'] = $this->convocatorias_model->verificaRequisitos($id);

        $this->load->view('plantilla', $datos);
    }

    public function cargaPrograma() {
        if ($this->input->post('nivel')) {
            $nivel = $this->input->post('nivel');
            $programas = $this->convocatorias_model->listaProgramas($nivel);
            foreach ($programas as $fila) {
                ?>
                <option value="<?= $fila->id_programa ?>" data-section=" <?= $fila->desc_areacono ?> "><?= $fila->desc_programa ?></option>
                <?php
            }
        }
    }
    
    
    public function cargaInfoPerfil() {
        if ($this->input->post('investigacion') && $this->input->post('rol')) {
            
            $investigacion = $this->input->post('investigacion');
            $rol = $this->input->post('rol');
            
            $descripcion = $this->convocatorias_model->informacionPerfil($investigacion, $rol);
            
            if($descripcion)
                {
                    echo $descripcion[0]->perfil;
                }else{
                    echo "";
                }
        }
    }
    
    public function cargaInfoObjeto() {
        if ($this->input->post('investigacion') && $this->input->post('rol')) {
            
            $investigacion = $this->input->post('investigacion');
            $rol = $this->input->post('rol');
            
            $descripcion = $this->convocatorias_model->informacionPerfil($investigacion, $rol);
            
            if($descripcion)
                {
                    echo $descripcion[0]->perfil;
                }else{
                    echo "";
                }
        }
    }

    public function guardarRequisitos($id_conv) {
        
        $datosReq['id_convocatoria'] = $id_conv;
        $datosReq['id_nivel'] = $_REQUEST['nivel'];
        $datosReq['semestres']= $_REQUEST['semestres'];
        $datosReq['tiempo']= $_REQUEST['experiencia'];
        $areas = '';
        if($_REQUEST['area'] != '' || isset($_REQUEST['area']))
            {
                
                for($i=0;$i<count($_REQUEST['area']);$i++)
                {
                    $areas.=$_REQUEST['area'][$i].",";
                }
            }
        
        $datosReq['area']=$areas;
        
        $datosRequisitos = $this->convocatorias_model->verificaRequisitos($id_conv);
        
        if($datosRequisitos)
            {
                $id_requisito = $datosRequisitos[0]->id_requisito;
                $datosReq['id_requisito'] = $id_requisito;
                $datosUsuario = $this->convocatorias_model->actualizarRequisitos($datosReq);
                
            }else{
                $datosUsuario = $this->convocatorias_model->guardarRequisitos($datosReq);
            }
        
        $datosInscritos = $this->convocatorias_model->buscarInscritos($id_conv);    
        
        if($datosInscritos)
        {
            for($j=0;$j<count($datosInscritos);$j++)
            {
                $datosActIns['id_conv_insc'] = $datosInscritos[$j]->id_conv_insc;
                $datosActIns['total_personas'] = $_REQUEST['contra-'.$datosInscritos[$j]->id_conv_insc];
                $datosActIns['max_inscri'] = $_REQUEST['inscri-'.$datosInscritos[$j]->id_conv_insc] * 3;
                
                $datosUsuario = $this->convocatorias_model->actualizarInscritos($datosActIns);
            }
        }
        
        $this->session->set_flashdata('retornoExito', 'Se actualiz&oacute; los requisitos de la convocatoria');
        redirect(base_url('administrador/convocatorias'), 'refresh');
        
    }

    public function cargarInvitaciones($id_conv) {
        $this->load->library('PHPExcel.php');

        $config['upload_path'] = './uploads/invitaciones/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '10000';
        $config['file_name'] = "invitacion_" . $this->session->userdata('id_usuario') . "_" . $id_conv;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('doc_excel')) {

            $error = array('error' => $this->upload->display_errors());
            //var_dump($error);
            $this->session->set_flashdata('retornoError', 'Ocurrio un problema al intentar subir el archivo, recuerde que debe subir archivos Excel');
            redirect(base_url('administrador/convocatorias'), 'refresh');
            exit;
        } else {
            //var_dump($this->PHPExcel_IOFactory);
            $nombre_archivo = "invitacion_" . $this->session->userdata('id_usuario') . "_" . $id_conv . ".xls";
            $rutaArchivo = './uploads/invitaciones/' . $nombre_archivo;

            $objPHPExcel = PHPExcel_IOFactory::load($rutaArchivo);
            //var_dump($archivo);


            $archivo = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $msj = "";
            for ($i = 2; $i <= count($archivo); $i++) {
                $infoUsuario = $this->convocatorias_model->verifica_usuario($archivo[$i]['E'], $archivo[$i]['F']);

                if (count($infoUsuario) > 0) {
                    $msj.= "El usuario " . $archivo[$i]['A'] . " " . $archivo[$i]['B'] . " ya se encuentra registrado como usuario <br>";
                    $idUsuario = $infoUsuario[0]->id_usuario;
                } else {
                    $datoUsu['nombres'] = $archivo[$i]['A'];
                    $datoUsu['apellidos'] = $archivo[$i]['B'];
                    $datoUsu['tipo_iden'] = $archivo[$i]['E'];
                    $datoUsu['nume_iden'] = $archivo[$i]['F'];
                    $datoUsu['sexo'] = $archivo[$i]['C'];
                    $datoUsu['telefono'] = $archivo[$i]['H'];
                    $datoUsu['celular'] = $archivo[$i]['G'];

                    $idUsuario = $this->usuarios_model->insertarUsuario($datoUsu);

                    if ($idUsuario) {
                        $datosUsuRol['id_usuario'] = $idUsuario;
                        $datosUsuRol['rol'] = 3;
                        $datosUsuRol['estado'] = 'AC';

                        $idUsuarioRol = $this->usuarios_model->insertarRolUsuario($datosUsuRol);

                        $datosUsuLogin['usuario_id_usuario'] = $idUsuario;
                        $datosUsuLogin['usuario'] = $archivo[$i]['I'];
                        $datosUsuLogin['clave'] = sha1(md5($archivo[$i]['F']));
                        $datosUsuLogin['estado'] = 'AC';

                        $idUsuarioLogin = $this->usuarios_model->insertarDatosLogin($datosUsuLogin);
                    }

                    $msj.= "El usuario " . $archivo[$i]['A'] . " " . $archivo[$i]['B'] . " se agreg&oacute; como usuario nuevo<br>";
                }
                //Verificar si el usuario ya se encuentra registrado en esa convocatoria
                $usuario_conv = $this->convocatorias_model->verificaInvitacionUsuario($idUsuario, $id_conv);

                if (count($usuario_conv) > 0) {
                    $msj.= "El usuario " . $archivo[$i]['A'] . " " . $archivo[$i]['B'] . " ya se encuentra asociado a esta convocatoria<br>";
                } else {
                    //Asociar el usuario a la convocatoria
                    $datosInvReg['id_convocatoria'] = $id_conv;
                    $datosInvReg['id_usuario'] = $idUsuario;
                    $datosInvReg['aplico'] = 'NO';
                    $datosInvReg['cumple_req'] = 'NO';
                    $datosInvReg['estado'] = 'AC';
                    $registraConv = $this->convocatorias_model->insertarUsuarioInvitacion($datosInvReg);

                    $msj.= "El usuario " . $archivo[$i]['A'] . " " . $archivo[$i]['B'] . " se asoci&oacute; correctamente a la convocatoria<br>";
                }
            }

            $this->session->set_flashdata('retornoExito', "Informaci&oacute;n de carga: <br>" . $msj);
            redirect(base_url('administrador/convocatorias/invitar/' . $id_conv), 'refresh');
            exit;
        }
    }

    public function enviarCorreo($id_conv, $id_usuario) {

        $this->load->library('My_PHPMailer');
        $this->load->library('email');

        $datosUsuario = $this->convocatorias_model->datosUsuario($id_usuario);
        $datosConv = $this->convocatorias_model->infoConv($id_conv);


        $mail = new PHPMailer();
        $mail->IsSMTP(); // establecemos que utilizaremos SMTP
        $mail->IsHTML(true);
        $mail->SetFrom('dane-bhv@dane.gov.co', 'DANE - Banco de Hojas de Vida');  //Quien env&iacute;a el correo
        $mail->Subject = "Invitaci&oacute;n convocatoria DANE";  //Asunto del mensaje

        $html = '			
              <p>Bienvenido</p>
              <p>' . $datosUsuario[0]->nombres . " " . $datosUsuario[0]->apellidos . ',</p>
                <p>Usted ha sido registrado para participar en la convocatoria '.$datosConv[0]->nombre_inv.'</p>
              <p>Puede acceder a la plataforma a trav&eacute;s del siguiente <a href="' . base_url() . '" target="_blank">link</a> y continuar con su proceso para aplicar a la convocatoria</p>
              <p>Sus datos de ingreso son los siguientes:<br>
              Usuario: ' . $datosUsuario[0]->usuario . '<br>
              Contraseña: En caso de que no hubiese realizado el proceso de registro previamente, puede ingresar con su numero de identificaci&oacute;n, en caso contrario ingresar con su contrase&ntilde;a registrada<br>
              </p>
              <p>Recuerde que puede cambiar su contrase&ntilde;a despues de ingresar a la plataforma.</p>';

        $mail->Body = $html;
        $mail->AddAddress($datosUsuario[0]->usuario, $datosUsuario[0]->usuario);
        //$mail->AddAddress("esanchez1988@gmail.com", "Edwin Sanchez");
        $mail->addBCC("esanchez1988@gmail.com", "Edwin Sanchez");
        $mail->Send();
        
        $actuConv = $this->convocatorias_model->actualizarEnvio($id_usuario,$id_conv);
        
        $this->session->set_flashdata('retornoExito', 'Env&iacute;o de correo exitoso a '.$datosUsuario[0]->usuario);
        redirect(base_url('administrador/convocatorias/invitar/' . $id_conv), 'refresh');
    }

}
