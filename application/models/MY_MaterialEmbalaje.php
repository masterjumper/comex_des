<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_MaterialEmbalaje extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function record_count()
    {
        $this -> db -> select('*');
        $this -> db -> from('materialembalaje');
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }


    public function get_all_filtro ($limit, $start)
    {
        $this -> db -> select('*');
        $this -> db -> from('materialembalaje');
        $this -> db -> limit($limit, $start);
        $this -> db -> order_by('matembid', 'DESC');
        $query = $this -> db ->get() -> result();        
        return $query;
    }


    public function get_all ()
    {
        $this -> db -> select('*');
        $this -> db -> from('materialembalaje');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_materialembalaje ($matembid)
    {
        $this -> db -> select('*');
        $this -> db -> from('materialembalaje');
        $this -> db -> where('matembid', $matembid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function new_materialembalaje($matembid, $matembdsc )
    {
        $data = array(
            'matembid'  =>$matembid,
            'matembdsc' =>$matembdsc,
            
        );
        $this -> db -> insert('materialembalaje', $data);
    }

    public function set_materialembalaje($matembid, $matembdsc )
    {

        $data = array(
            'matembdsc' =>$matembdsc,            
        );
        $this -> db -> where('matembid', $matembid);
        $this -> db -> update('materialembalaje', $data);
    }

    public function delete_materialembalaje ($matembid)
    {
        $this->db->where('matembid', $matembid);
        $this->db->delete('materialembalaje');
    }

 /*    public function get_all_materialembalajes($matembid)
    {
        $this->db->select('count(*)');
        $this->db->where('matembid', $matembid);
        $this->db->from('negocioxmaterialembalaje');
        $query = $this -> db ->get() ->row('count(*)');
        return $query;        
    } */
    
}