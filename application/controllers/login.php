<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('login_model');
        $this->load->model('general_model');

        $this->load->helper(array('url', 'form'));

        $this->load->library('session');
                    
        if(!($this->session->userdata('language')))
            {
                if($this->uri->segment(1) == 'en')
                {
                    $this->session->set_userdata('language', 'english');                
                }else if($this->uri->segment(1) == 'es')
                    {
                        $this->session->set_userdata('language', 'spanish');
                    }else
                        {
                            $this->session->set_userdata('language', 'spanish');
                        }
            }
            
        $user_language = $this->session->userdata('language');
        $this->lang->load('rtc_'.$user_language , $user_language);
    }

    public function validar_user() {


        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {

            $this->form_validation->set_rules('usuario', 'Email', 'required|trim|min_length[2]|max_length[150]|xss_clean');

            $this->form_validation->set_rules('pass', 'Contrase&ntilde;a', 'required|trim|min_length[5]|max_length[150]|xss_clean');

            //lanzamos mensajes de error si es que los hay


            if ($this->form_validation->run() == FALSE) {

                redirect(base_url());
            } else {

                $username = $this->input->post('usuario');
                $password = sha1(md5($this->input->post('pass')));
                $check_user = $this->login_model->login_user($username, $password);
				
                if ($check_user) {

					
                    foreach ($check_user as $t) {

                        $data = array(
                            'en_sistema' => TRUE,
                            'id_usuario' => $t->id_usuario,
                            'nombre' => $t->nombres . " " . $t->apellidos,
                            'usuario' => $t->usuario,
                            'email' => $t->email,
                            'rol' => $t->rol,
                            'estado' => $t->estado							
                        );
                    }
				
					if($data['estado'] == 'AC')
					{
						$this->session->set_userdata($data);
						redirect(base_url());
					}else
					{
						$this->session->set_flashdata('retornoError', 'El usuario se encuentra inactivo');
						redirect(base_url(), 'refresh');
					}
                    
                } else {

                    $this->session->set_flashdata('retornoError', 'Los datos introducidos son incorrectos');

                    redirect(base_url(), 'refresh');
                }
            }
        } else {

            $this->session->set_flashdata('retornoError', 'Los datos introducidos son incorrectos');

            redirect(base_url());
        }
    }

    public function recordar_clave() {

        $datos["titulo"] = $this->lang->line('recordar_pass');
        $datos["contenido"] = "login/recordar_clave";
        $this->load->view('plantilla', $datos);
    }

    public function enviar_link() {
        
        $result_user = $this->login_model->login_recupera($_REQUEST['usuario']);
        
        if($result_user)
            {
                $clave = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789',8)),0,8);

                $datosLogin['usuario'] = $_REQUEST['usuario'];
                $datosLogin['clave'] = sha1(md5($clave));
            
                $cambio = $this->login_model->actualizar_pass($datosLogin['usuario'],$datosLogin['clave']);
                
            
                $this->load->library('My_PHPMailer');
                $this->load->library('email');

                $mail = new PHPMailer();
                $mail->IsSMTP(); // establecemos que utilizaremos SMTP
                $mail->IsHTML(true);
                $mail->Helo = "www.suatechnology.com"; //Muy importante para que llegue a hotmail y otros
                $mail->SetFrom('rtc-candane@dane.gov.co', 'Red de Transmision del Conocimiento');  //Quien env&iacute;a el correo
                $mail->AddReplyTo("esanchez1988@gmail.com", "Edwin Sanchez");  //A quien debe ir dirigida la respuesta
                $mail->Subject = $this->lang->line('subjet_recupera');  //Asunto del mensaje
                $mail->AddEmbeddedImage("assets/imgs/logo-rtc.jpg", 'imagen.jpg', "logo-rtc.jpg", 'base64', 'image/jpeg');

                $html = '
                  <p><img src="cid:imagen.jpg"></p>
                  <p> '. $this->lang->line('texto_recupera1') .'.</p>
                  <p> '. $this->lang->line('texto_recupera2') .' </p>
                  <p> '. $this->lang->line('texto_recupera3') .' </p>
                  <p> '. $this->lang->line('texto_recupera4').': '. $_REQUEST['usuario'] .' </p>
                  <p> '. $this->lang->line('texto_recupera5').': '. $clave .' </p>';

                $mail->Body = $html;
                $mail->AddAddress($_REQUEST['usuario'], $_REQUEST['usuario']);
                $mail->addBCC("esanchez1988@gmail.com", "Edwin Sanchez");
                $mail->Send();
                /*
                if(!$mail->Send()) {
                    echo 'Message was not sent.'; 
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent.';
                    echo $mail->ErrorInfo;
                }
                */
                //var_dump($mail);exit;
                //exit;
                $this->session->set_flashdata('registroExitoso', $this->lang->line('Se envio informacion al correo electronico para el ingreso a la plataforma'));
                redirect(base_url(), 'refresh');
            }else
                {
                    $this->session->set_flashdata('retornoError', $this->lang->line('El usuario no se encuentra registrado'));
                    redirect(base_url(), 'refresh');
                }
        
       
    }
    
    public function token() {

        $token = md5(uniqid(rand(), true));



        $usuario_data = array(
            'token' => $token,
            'fecha' => date('Y-m-d H:i:s'),
            'logueado' => FALSE
        );

        $this->session->set_userdata($usuario_data);



        return $token;
    }

    public function logout_ci() {

        $this->session->sess_destroy();

        redirect(base_url());
    }

}
