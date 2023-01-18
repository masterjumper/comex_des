<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_Cliente extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all ()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $this -> db -> where('gruid' ,3);
        $query = $this -> db ->get() -> result();
        return $query;
    }
    
    public function get_all_planilla ()
    {
        $this -> db -> select('usuario.*, grupo.*, empresa.*');
        $this -> db -> from('usuario, grupo,empresa');
        $this -> db -> where('usuario.empid = empresa.empid');
        $this -> db -> where('usuario.gruid',3);
        $this -> db -> where('grupo.gruid',3);        
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_all_filtro ($limit, $start)
    {
        $this -> db -> select('usuario.*, grupo.*, empresa.*');
        $this -> db -> from('usuario, grupo,empresa');
        $this -> db -> where('usuario.empid = empresa.empid');
        $this -> db -> where('usuario.gruid',3);
        $this -> db -> where('grupo.gruid',3);
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_cliente ($usuid)
    {
        $this -> db -> select('usuario.*');
        $this -> db -> from('usuario, grupo');
        $this -> db -> where('usuario.usuid', $usuid);
        $this -> db -> where('usuario.gruid', 3);
        $this -> db -> limit(1);
        $query = $this->db->get()->row();
        return $query;
    }

    public function new_cliente($usuid, $usuuser, $usupass, $usunom, $usuape, $usumai, $usuest, $empid, $usulstmai)
    {
        $data = array(
            'usuid'     =>$usuid,
            'usuuser'   =>$usuuser,
            'usupass'   =>$usupass,
            'usunom'    =>$usunom,
            'usuape'    =>$usuape,
            'usumai'    =>$usumai,
            'gruid'     =>3,
            'usuest'    =>$usuest,
            'empid'     =>$empid,
            'usulstmai'  => $usulstmai
        );
        $this -> db -> insert('usuario', $data);
    }

    public function record_count()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $this -> db -> where('gruid' ,3);
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }

    public function get_cliente_filtro ($filtro_usuuser, $filtro_usunom, $filtro_usuape, $limit, $start, $filtro_empid)
    {
        $this -> db -> select('usuario.*, grupo.*, empresa.*');
        $this -> db -> from('usuario, grupo, empresa');
        $this -> db -> where('usuario.empid = empresa.empid');
        $this -> db -> where('usuario.gruid',3);
        $this -> db -> where('grupo.gruid',3);

        if(empty($filtro_usuuser) == FALSE){
            $this -> db -> like('usuuser', $filtro_usuuser,'both');
        }
        if(empty($filtro_usunom) == FALSE){
            $this -> db -> like('usunom', $filtro_usunom,'both');
        }
        if(empty($filtro_usuape) == FALSE){
            $this -> db -> like('usuape', $filtro_usuape,'both');
        }
        if(empty($filtro_empid) == FALSE){
            $this -> db -> where('usuario.empid', $filtro_empid);
        }
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function update_cliente($usuid, $usupass, $usunom, $usuape, $usumai, $usuest, $empid, $usulstmai) {
        $data = array(
            'usupass' => $usupass,
            'usunom'  => $usunom,
            'usuape'  => $usuape,
            'usumai'  => $usumai,
            'gruid'   => 3,
            'usuest'  => $usuest,
            'empid'   => $empid,
            'usulstmai'  => $usulstmai
        );
        $this->db->where('usuid', $usuid);
        $this->db->update('usuario', $data);
    }

    public function delete_cliente($usuid){
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

    public function get_all_externo ()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $this -> db -> where('gruid','3');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_all_habilitado ()
    {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $this -> db -> where('gruid', '3');
        $this -> db -> where('usuest', '1');
        $query = $this -> db ->get() -> result();
        return $query;
    }
}