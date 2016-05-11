<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function roles() {
        $query = $this->db->query("SELECT * FROM roles WHERE estado = '1'");
        $result = $query->result();
        return $result;
    }

    function obtener_datosRol1() {
        $this->load->database();

        $cadena_sql = "SELECT us.id_usuario, nombres, apellidos, email, pa.desc_pais ";
        $cadena_sql.= "FROM usuario us ";
        $cadena_sql.= "JOIN usuario_rol ur ON ur.id_usuario = us.id_usuario ";
        $cadena_sql.= "JOIN param_paises pa ON pa.codi_pais = us.codi_pais  ";
        $cadena_sql.= "WHERE rol='1' ";
        $query = $this->db->query($cadena_sql);

        return $query->result();
    }

    function obtener_datosRol2() {
        $this->load->database();

        $cadena_sql = "SELECT us.id_usuario, nombres, apellidos, email, pa.desc_pais ";
        $cadena_sql.= "FROM usuario us ";
        $cadena_sql.= "JOIN usuario_rol ur ON ur.id_usuario = us.id_usuario ";
        $cadena_sql.= "JOIN param_paises pa ON pa.codi_pais = us.codi_pais  ";
        $cadena_sql.= "WHERE rol='2' ";
        $query = $this->db->query($cadena_sql);

        return $query->result();
    }

    function obtener_datosRol3() {
        $this->load->database();

        $cadena_sql = "SELECT us.id_usuario, nombres, apellidos, email, pa.desc_pais ";
        $cadena_sql.= "FROM usuario us ";
        $cadena_sql.= "JOIN usuario_rol ur ON ur.id_usuario = us.id_usuario ";
        $cadena_sql.= "JOIN param_paises pa ON pa.codi_pais = us.codi_pais  ";
        $cadena_sql.= "WHERE rol='3' ";

        $query = $this->db->query($cadena_sql);

        return $query->result();
    }

    function tipos_identificacion() {
        $this->load->database();

        $cadena_sql = "SELECT referencia, descripcion  ";
        $cadena_sql.= "FROM param_tipo_iden ";
        $cadena_sql.= "WHERE estado='AC' ";

        $query = $this->db->query($cadena_sql);

        return $query->result();
    }

    function paises() {
        $this->load->database();

        $cadena_sql = "SELECT codi_pais, desc_pais ";
        $cadena_sql.= "FROM param_paises ";

        $query = $this->db->query($cadena_sql);

        return $query->result();
    }

    public function obtenerCargo($inputCargo) {

        $this->load->database();

        $cadena_sql = "SELECT id_cargo, desc_cargo ";
        $cadena_sql.= "FROM param_cargo ";
        $cadena_sql.= "WHERE desc_cargo like '%" . $inputCargo . "%' ";

        $query = $this->db->query($cadena_sql);

        $registro = $query->result();

        return $registro;
    }

    public function obtenerEspeci($inputEspec) {

        $this->load->database();

        $cadena_sql = "SELECT id_espec, desc_espec ";
        $cadena_sql.= "FROM param_especialidad	 ";
        $cadena_sql.= "WHERE desc_espec like '%" . $inputEspec . "%' ";

        $query = $this->db->query($cadena_sql);

        $registro = $query->result();

        return $registro;
    }

    public function validarUsuarioCorreo($inputEmail) {

        $this->load->database();

        $cadena_sql = "SELECT usuario_id_usuario, usuario ";
        $cadena_sql.= "FROM login ";
        $cadena_sql.= "WHERE usuario = '" . $inputEmail . "' ";

        $query = $this->db->query($cadena_sql);

        if ($query->num_rows() > 0) {
            $registro = $query->result();
        } else {
            $registro = '';
        }
        return $registro;
    }

    public function validarUsuarioIdentificacion($tipo_iden, $inputNumero) {

        $this->load->database();

        $cadena_sql = "SELECT tipo_iden, nume_docu ";
        $cadena_sql.= "FROM usuario ";
        $cadena_sql.= "WHERE tipo_iden = '" . $tipo_iden . "' ";
        $cadena_sql.= "AND nume_docu = " . $inputNumero . " ";

        $query = $this->db->query($cadena_sql);

        if ($query->num_rows() > 0) {
            $registro = $query->result();
        } else {
            $registro = '';
        }

        return $registro;
    }

    public function insertarUsuario($param) {
        $this->db->trans_start();
        $this->db->insert('usuario', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function insertarRolUsuario($param) {
        $this->db->trans_start();
        $this->db->insert('usuario_rol', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    public function insertarDatosUsuario($param) {
        $this->db->trans_start();
        $this->db->insert('usuario_datos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    public function insertarDatosLogin($param) {
        $this->db->trans_start();
        $this->db->insert('login', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }

    function datosUsuario($idUsuario) {
        $this->load->database();
 
        $cadena_sql = "SELECT us.id_usuario, nombres, apellidos, email, codi_pais, cargo, especialidad, rol ";
        $cadena_sql.= "FROM usuario us ";
        $cadena_sql.= "JOIN usuario_datos ud ON us.id_usuario = ud.id_usuario  ";
        $cadena_sql.= "JOIN usuario_rol ur ON us.id_usuario = ur.id_usuario ";
        $cadena_sql.= "WHERE us.id_usuario = ".$idUsuario;

        $query = $this->db->query($cadena_sql);

        return $query->result();
    }
    
    function actualizarUsuario($id_usuario, $nombres, $apellidos, $email, $codi_pais)
    {
        $data = array(
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'email' => $email,
            'codi_pais' => $codi_pais
        );
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario', $data);
    }
	
    function activarCuenta($id_usuario)
    {
        $data = array(
            'estado' => 'AC'
        );
        $this->db->where('usuario_id_usuario', $id_usuario);
        return $this->db->update('login', $data);
    }
	
    function activarFecha($id_usuario)
    {
        $data = array(
            'fecha_acti' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario', $data);
    }
    
    function actualizarUsuarioDatos($id_usuario, $cargo, $especialidad)
    {
        $data = array(
            'cargo' => $cargo,
            'especialidad' => $especialidad
        );
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario_datos', $data);
    }
    
    function actualizarUsuarioRol($id_usuario, $rol)
    {
        $data = array(
            'rol' => $rol
        );
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario_rol', $data);
    }
    
    function eliminar_usuario($id_usuario)
    {
        $data = array(
            'rol' => $rol
        );
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuario_rol', $data);
    }
}
