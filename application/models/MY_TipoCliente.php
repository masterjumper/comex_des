<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_TipoCliente extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function record_count()
    {
        $this -> db -> select('*');
        $this -> db -> from('tipocliente');
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }


    public function get_all_filtro ($limit, $start)
    {
        $this -> db -> select('*');
        $this -> db -> from('tipocliente');
        $this -> db -> limit($limit, $start);
        $this -> db -> order_by('tipid', 'DESC');
        $query = $this -> db ->get() -> result();        
        return $query;
    }


    public function get_all ()
    {
        $this -> db -> select('*');
        $this -> db -> from('tipocliente');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_tipocliente ($tipid)
    {
        $this -> db -> select('*');
        $this -> db -> from('tipocliente');
        $this -> db -> where('tipid', $tipid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function new_tipocliente($tipid, $tipdsc )
    {
        $data = array(
            'tipid'  =>$tipid,
            'tipdsc' =>$tipdsc,
            
        );
        $this -> db -> insert('tipocliente', $data);
    }

    public function set_tipocliente($tipid, $tipdsc )
    {

        $data = array(
            'tipdsc' =>$tipdsc,            
        );
        $this -> db -> where('tipid', $tipid);
        $this -> db -> update('tipocliente', $data);
    }

    public function delete_tipocliente ($tipid)
    {
        $this->db->where('tipid', $tipid);
        $this->db->delete('tipocliente');
    }

    public function get_all_empresas($tipid)
    {
        $this->db->select('count(*)');
        $this->db->where('tipid', $tipid);
        $this->db->from('empresa');
        $query = $this -> db ->get() ->row('count(*)');
        return $query;        
    }
    
}