<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Convocatorias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function investigaciones() {
        $cadena_sql = "SELECT id_investigacion, nombre_inv  ";
        $cadena_sql.= " FROM param_investigacion ";
        $cadena_sql.= " WHERE estado = 'AC' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function roles() {
        $cadena_sql = "SELECT id_rol_inv, nombre_rol_inv  ";
        $cadena_sql.= " FROM param_rol_inv ";
        $cadena_sql.= " WHERE estado = 'AC' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function sedes() {
        $cadena_sql = "SELECT id_mpio, nom_mpio, nomb_terri  ";
        $cadena_sql.= " FROM param_territorial ter";
        $cadena_sql.= " JOIN param_subsede sed ON ter.id_territorial = sed.id_territorial ";
        $cadena_sql.= " JOIN param_mpios mpi ON sed.id_ciudad = mpi.id_mpio ";
        $cadena_sql.= " ORDER BY 3,2 ";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function insertarDatosConvocatoria($param) {
        $this->db->trans_start();
        $this->db->insert('convocatorias', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    public function insertarConvocatoriaInsc($param) {
        $this->db->trans_start();
        $this->db->insert('convocatorias_inscritos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    
    public function conv_abiertas_info() {
        $cadena_sql = "SELECT con.id_convocatoria, con.id_investigacion, nombre_inv, con.id_rol, nombre_rol_inv  ";
        $cadena_sql.= " FROM convocatorias con ";
        $cadena_sql.= " JOIN param_investigacion inv ON inv.id_investigacion = con.id_investigacion ";
        $cadena_sql.= " JOIN param_rol_inv rol ON rol.id_rol_inv = con.id_rol ";
        $cadena_sql.= " WHERE tipo_conv = 'A' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function conv_cerradas_info() {
        $cadena_sql = "SELECT con.id_convocatoria, con.id_investigacion, nombre_inv, con.id_rol, nombre_rol_inv ";
        $cadena_sql.= " FROM convocatorias con ";
        $cadena_sql.= " JOIN param_investigacion inv ON inv.id_investigacion = con.id_investigacion ";
        $cadena_sql.= " JOIN param_rol_inv rol ON rol.id_rol_inv = con.id_rol ";
        $cadena_sql.= " WHERE tipo_conv = 'C' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function info_convocatoria($id_convocatoria) {
        $cadena_sql = "SELECT distinct con.id_convocatoria, con.id_investigacion, nombre_inv, con.id_rol, nombre_rol_inv, mun.nom_mpio, total_personas, total_insc  ";
        $cadena_sql.= " FROM convocatorias con ";
        $cadena_sql.= " JOIN param_investigacion inv ON inv.id_investigacion = con.id_investigacion ";
        $cadena_sql.= " JOIN param_rol_inv rol ON rol.id_rol_inv = con.id_rol ";
        $cadena_sql.= " JOIN convocatorias_inscritos conins ON conins.id_convocatoria = con.id_convocatoria ";
        $cadena_sql.= " JOIN param_mpios mun ON mun.id_mpio = conins.id_ciudad ";
        $cadena_sql.= " WHERE con.id_convocatoria = ".$id_convocatoria." ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    
    public function conv_cerradas($id_convocatoria) {
        $cadena_sql = "SELECT distinct con.id_convocatoria, con.id_investigacion, nombre_inv, con.id_rol, nombre_rol_inv, total_personas, total_insc  ";
        $cadena_sql.= " FROM convocatorias con ";
        $cadena_sql.= " JOIN param_investigacion inv ON inv.id_investigacion = con.id_investigacion ";
        $cadena_sql.= " JOIN param_rol_inv rol ON rol.id_rol_inv = con.id_rol ";
        $cadena_sql.= " JOIN convocatorias_inscritos conins ON conins.id_convocatoria = con.id_convocatoria ";
        $cadena_sql.= " WHERE con.id_convocatoria = ".$id_convocatoria." ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function infoConv($id) {
        $cadena_sql = "SELECT distinct con.id_convocatoria, con.id_investigacion, nombre_inv, con.id_rol, nombre_rol_inv, total_personas, total_insc, max_inscri  ";
        $cadena_sql.= " FROM convocatorias con ";
        $cadena_sql.= " JOIN param_investigacion inv ON inv.id_investigacion = con.id_investigacion ";
        $cadena_sql.= " JOIN param_rol_inv rol ON rol.id_rol_inv = con.id_rol ";
        $cadena_sql.= " JOIN convocatorias_inscritos conins ON conins.id_convocatoria = con.id_convocatoria ";
        $cadena_sql.= " WHERE con.id_convocatoria = '".$id."' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function listaAreas() {
        $cadena_sql = "SELECT prog.id_programa, prog.desc_programa, desc_areacono ";
        $cadena_sql.= "FROM param_programa prog ";
        $cadena_sql.= "JOIN param_areacono are ON are.id_areacono = prog.id_areacono ";
        $cadena_sql.= " WHERE are.estado = 'AC'";
        $cadena_sql.= " AND prog.estado = 'AC'";
        $cadena_sql.= " ORDER BY 3,2 ";
        
        $query = $this->db->query($cadena_sql);

        $result = $query->result();

        return $result;
    }
    
    public function listaProgramas($idNivel) {
        $cadena_sql = "SELECT prog.id_programa, prog.desc_programa, desc_areacono ";
        $cadena_sql.= "FROM param_programa prog ";
        $cadena_sql.= "JOIN param_areacono are ON are.id_areacono = prog.id_areacono ";
        $cadena_sql.= " WHERE are.estado = 'AC'";
        $cadena_sql.= " AND prog.estado = 'AC'";
        $cadena_sql.= " AND prog.id_nivel = '".$idNivel."'";
        $cadena_sql.= " ORDER BY 3,2 ";
        
        $query = $this->db->query($cadena_sql);

        $result = $query->result();

        return $result;
    }
    
    public function info_por_ciudades($id_convocatoria) {
        $cadena_sql = "SELECT distinct con.id_convocatoria, id_conv_insc , id_ciudad, mun.nom_mpio, total_personas, total_insc, max_inscri  ";
        $cadena_sql.= " FROM convocatorias con ";
        $cadena_sql.= " JOIN convocatorias_inscritos conins ON conins.id_convocatoria = con.id_convocatoria ";
        $cadena_sql.= " JOIN param_mpios mun ON mun.id_mpio = conins.id_ciudad ";
        $cadena_sql.= " WHERE con.id_convocatoria = ".$id_convocatoria." ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    
    public function verifica_usuario($tipo_iden, $nume_iden) {
        $cadena_sql = "SELECT id_usuario, tipo_iden, nume_iden, nombres, apellidos ";
        $cadena_sql.= " FROM usuario ";
        $cadena_sql.= " WHERE tipo_iden = '".$tipo_iden."' ";
        $cadena_sql.= " AND nume_iden = '".$nume_iden."' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function verificaInvitacionUsuario($id_usuario, $id_conv) {
        $cadena_sql = "SELECT id_invitacion, id_convocatoria, id_usuario ";
        $cadena_sql.= " FROM invitaciones ";
        $cadena_sql.= " WHERE id_usuario = '".$id_usuario."' ";
        $cadena_sql.= " AND id_convocatoria = '".$id_conv."' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function usuariosInvitados($id_conv) {
        $cadena_sql = "SELECT id_invitacion, id_convocatoria, inv.id_usuario, aplico, cumple_req, envio_email, fecha_aplico, fecha_correo, nombres, apellidos, tipo_iden, nume_iden, usuario ";
        $cadena_sql.= " FROM invitaciones inv ";
        $cadena_sql.= " JOIN usuario usu ON usu.id_usuario = inv.id_usuario ";
        $cadena_sql.= " JOIN login log ON log.usuario_id_usuario = inv.id_usuario ";
        $cadena_sql.= " WHERE id_convocatoria = '".$id_conv."' ";
        $cadena_sql.= " AND inv.estado = 'AC' ";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function insertarUsuarioInvitacion($param) {
        $this->db->trans_start();
        $this->db->insert('invitaciones', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    
    public function guardarRequisitos($param) {
        $this->db->trans_start();
        $this->db->insert('requisitos', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
    
    public function verificaRequisitos($id_conv) {
        $cadena_sql = "SELECT id_requisito, id_convocatoria, id_nivel, semestres, tiempo, area  ";
        $cadena_sql.= "FROM requisitos ";
        $cadena_sql.= "WHERE id_convocatoria = '" . $id_conv . "'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }   
    
    function actualizarRequisitos($parametros)
    {
        $data = array(
            'id_nivel' => $parametros['id_nivel'],
            'semestres' => $parametros['semestres'],
            'tiempo' => $parametros['tiempo'],
            'area' => $parametros['area']
        );
        
        $array = array('id_requisito' => $parametros['id_requisito']);
        $this->db->where($array);
        return $this->db->update('requisitos', $data);
        
    }
    
    public function datosUsuario($id_usuario) {
        $cadena_sql = "SELECT us.id_usuario, nombres, apellidos, usuario, rol FROM login lo ";
        $cadena_sql.= "JOIN usuario us ON usuario_id_usuario = us.id_usuario ";
        $cadena_sql.= "JOIN usuario_rol ur ON ur.id_usuario = us.id_usuario ";
        $cadena_sql.= "WHERE us.id_usuario = '" . $id_usuario . "'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    function actualizarEnvio($id_usuario, $id_conv)
    {
        $data = array(
            'fecha_correo' => date('Y-m-d H:i:s'),
            'envio_email' => 'SI'
        );
        
        $array = array('id_usuario' => $id_usuario, 'id_convocatoria' => $id_conv);
        $this->db->where($array);
        return $this->db->update('invitaciones', $data);
        
    }
    
    public function buscarInscritos($id_conv) {
        $cadena_sql = "SELECT id_conv_insc, id_convocatoria, id_ciudad, total_personas, total_insc, max_inscri, fecha_inicio, fecha_fin ";
        $cadena_sql.= "FROM convocatorias_inscritos ";
        $cadena_sql.= "WHERE id_convocatoria = '" . $id_conv . "'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function informacionPerfil($investigacion, $rol) {
        $cadena_sql = "SELECT perfil, objeto ";
        $cadena_sql.= "FROM param_perfil_inves ";
        $cadena_sql.= " WHERE id_investigacion = '" . $investigacion . "'";
        $cadena_sql.= " AND id_rol_inv = '" . $rol . "'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    function actualizarInscritos($parametros)
    {
        $data = array(
            'total_personas' => $parametros['total_personas'],
            'max_inscri' => $parametros['max_inscri']
        );
        
        $array = array('id_conv_insc' => $parametros['id_conv_insc']);
        $this->db->where($array);
        return $this->db->update('convocatorias_inscritos', $data);
        
    }
    
    //CIUDADANO
    
    
    public function ciudadano_conv_participa($id_usuario) {
        $cadena_sql = "SELECT usco.id_usu_conv, usco.id_usuario, usco.id_convocatoria, usco.estado, inve.nombre_inv, nombre_rol_inv ";
        $cadena_sql.= "FROM usuario_convocatoria usco ";
        $cadena_sql.= "JOIN convocatorias conv ON usco.id_convocatoria = conv.id_convocatoria ";
        $cadena_sql.= "JOIN param_investigacion inve ON inve.id_investigacion = conv.id_investigacion ";
        $cadena_sql.= "JOIN param_rol_inv rol ON rol.id_rol_inv = conv.id_rol ";
        $cadena_sql.= "WHERE usco.id_usuario = '" . $id_usuario . "'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    
    
    public function ciudadano_conv_abiertas() {
        $cadena_sql = "SELECT conv.id_convocatoria, inve.nombre_inv, nombre_rol_inv ";
        $cadena_sql.= "FROM convocatorias conv ";
        $cadena_sql.= "JOIN param_investigacion inve ON inve.id_investigacion = conv.id_investigacion ";
        $cadena_sql.= "JOIN param_rol_inv rol ON rol.id_rol_inv = conv.id_rol ";
        $cadena_sql.= "WHERE conv.tipo_conv = 'A'";

        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    public function ciudadano_conv_cerradas($id_usuario) {
        $cadena_sql = "SELECT conv.id_convocatoria, inve.nombre_inv, nombre_rol_inv ";
        $cadena_sql.= "FROM invitaciones inv ";
        $cadena_sql.= "JOIN convocatorias conv ON inv.id_convocatoria = conv.id_convocatoria ";
        $cadena_sql.= "JOIN param_investigacion inve ON inve.id_investigacion = conv.id_investigacion ";
        $cadena_sql.= "JOIN param_rol_inv rol ON rol.id_rol_inv = conv.id_rol ";
        $cadena_sql.= " WHERE conv.tipo_conv = 'C'";
        $cadena_sql.= " AND inv.id_usuario = '".$id_usuario."'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
	
	public function verificaCruceConvocatoria($id_usuario) {
        $cadena_sql = "SELECT id_usu_conv, id_usuario, id_convocatoria, estado ";
        $cadena_sql.= "FROM usuario_convocatoria ";
        $cadena_sql.= " WHERE id_usuario = '".$id_usuario."'";
        $cadena_sql.= " AND estado = 'AC'";
        
        $query = $this->db->query($cadena_sql);
        
        $result = $query->result();
        
        return $result;
    }
    
    
    public function insertarConvocatoriaUsuario($param) {
        $this->db->trans_start();
        $this->db->insert('usuario_convocatoria', $param);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return  $insert_id;
    }
}
