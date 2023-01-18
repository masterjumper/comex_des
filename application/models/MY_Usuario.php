<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_Usuario extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all ()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_all_filtro ($limit, $start)
    {
        $this -> db -> select('usuario.*, grupo.*');
        $this -> db -> from('usuario, grupo');
        $this -> db -> where('usuario.gruid = grupo.gruid');
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_usuario ($usuid)
    {
        $this -> db -> select('usuario.*, grupo.*');
        $this -> db -> from('usuario, grupo');
        $this -> db -> where('usuario.usuid', $usuid);
        $this -> db -> where('usuario.gruid = grupo.gruid');
        $this -> db -> limit(1);
        $query = $this->db->get()->row();
        return $query;
    }

    public function new_usuario($usuid, $usuuser, $usupass, $usunom, $usuape, $usumai, $gruid, $usuest, $usumarmai)
    {
        $data = array(
            'usuid'     =>$usuid,
            'usuuser'   =>$usuuser,
            'usupass'   =>$usupass,
            'usunom'    =>$usunom,
            'usuape'    =>$usuape,
            'usumai'    =>$usumai,
            'gruid'     =>$gruid,
            'usuest'    =>$usuest,
            'usumarmai'    =>$usumarmai
        );
        $this -> db -> insert('usuario', $data);
    }

    public function get_usuario_all($limit, $start)
    {
        $this -> db -> select('*.usuario, *.grupo');
        $this -> db -> from('usuario, grupo,');
        $this -> db -> where('usuario.gruid = grupo.gruid');
//        $this -> db -> order_by('username', 'asc');
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function record_count()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }

    public function get_usuario_filtro ($filtro_usuuser, $filtro_usunom, $filtro_usuape, $limit, $start)
    {
        $this -> db -> select('usuario.*, grupo.*');
        $this -> db -> from('usuario, grupo');
        $this -> db -> where('usuario.gruid = grupo.gruid');

        if(empty($filtro_usuuser) == FALSE){
            $this -> db -> like('UPPER(usuuser)', strtoupper($filtro_usuuser),'both');
        }
        if(empty($filtro_usunom) == FALSE){
            $this -> db -> like('UPPER(usunom)', strtoupper($filtro_usunom),'both');
        }
        if(empty($filtro_usuape) == FALSE){
            $this -> db -> like('UPPER(usuape)', strtoupper($filtro_usuape),'both');
        }
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function save_usuario($username, $password, $nombre, $apellido, $dirmail, $gruid, $usuest, $usumarmai) {
        $data = array(
            'usuuser'   => $username,
            'usupass'   => $password,
            'usunom'    => $nombre,
            'usuape'    => $apellido,
            'usumai'    => $dirmail,
            'gruid'     => $gruid,
            'usuest'    => $usuest,
            'usumarmai'  => $usumarmai

        );
        $this->db->insert('usuarios', $data);
    }

    public function update_usuario($usuid, $usupass, $usunom, $usuape, $usumai, $gruid, $usuest, $usumarmai) {
        $data = array(
            'usupass' => $usupass,
            'usunom'  => $usunom,
            'usuape'  => $usuape,
            'usumai'  => $usumai,
            'gruid'   => $gruid,
            'usuest'  => $usuest,
            'usumarmai'  => $usumarmai
        );
        $this->db->where('usuid', $usuid);
        $this->db->update('usuario', $data);
    }

    public function delete_usuario($usuid){
        $this->db->where('usuid', $usuid);
        $this->db->delete('usuario');
    }

    public function get_usuest($usuid)
    {
        $this -> db -> select('usuest');
        $this -> db ->from('usuario');
        $this->db->where('usuid', $usuid);
        $query = $this -> db -> get() ->row('usuest');
        return $query;
    }

    public function set_usuest($usuid, $usuest)
    {
        $data = array(
            'usuest' =>$usuest
        );
        $this -> db -> where('usuid', $usuid);
        $this -> db -> update('usuario', $data);
    }

    public function get_all_habilitado ()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $this -> db -> where('usuest', '1');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function update_perfilusuario($usuid, $usupass, $usunom, $usuape, $usumai) {
        $data = array(
            'usupass' => $usupass,
            'usunom'  => $usunom,
            'usuape'  => $usuape,
            'usumai'  => $usumai
        );
        $this->db->where('usuid', $usuid);
        $this->db->update('usuario', $data);
    }

    public function get_perfilusuario ($usuid)
    {
        $this -> db -> select('usuario.*, grupo.*');
        $this -> db -> from('usuario, grupo');
        $this -> db -> where('usuario.usuid', $usuid);
        $this -> db -> limit(1);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_all_externo ()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $this -> db -> where('gruid', '3');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_usu_mai_habilitado ()
    {
        $this -> db -> select('usumai, usunom, usuape');
        $this -> db -> from('usuario');
        $this -> db -> where('usuest', '1');
        $this -> db -> where('usumarmai', '1');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_usureccorr($usuid)
    {
        $this -> db -> select('usumarmai');
        $this -> db ->from('usuario');
        $this->db->where('usuid', $usuid);
        $query = $this -> db -> get() ->row('usumarmai');
        
        return $query;
    }

    public function set_usureccorr($usuid, $usumarmai)
    {
        $data = array(
            'usumarmai' =>$usumarmai
        );
        $this->db->where('usuid', $usuid);
        $this->db->update('usuario', $data);                
    }
    
}