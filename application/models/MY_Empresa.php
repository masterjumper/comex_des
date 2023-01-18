<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_Empresa extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all ()
    {
        $this -> db -> select('empresa.*, tipocliente.tipdsc');
        $this -> db -> from('empresa, tipocliente');
        $this -> db -> where('empresa.tipid = tipocliente.tipid');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_all_filtro ($limit, $start)
    {
        $this -> db -> select('empresa.*, tipocliente.tipdsc');
        $this -> db -> from('empresa, tipocliente');
        $this -> db -> where('empresa.tipid = tipocliente.tipid');
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();        
        return $query;
    }


    public function get_empresa ($empid)
    {
        $this -> db -> select('*');
        $this -> db -> from('empresa');
        $this -> db -> where('empid', $empid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function new_empresa($empid, $emprazsoc, $empest, $emptipid, $emptag=null)
    {
        $data = array(
            'empid'  =>$empid,
            'emprazsoc' =>$emprazsoc,
            'empest' => $empest,
            'emptag' => $emptag,
            'tipid' => $emptipid
        );
        $this -> db -> insert('empresa', $data);
    }

    public function set_empresa($empid, $emprazsoc, $empest, $emptipid, $emptag=null)
    {
        $data = array(
            'emprazsoc' =>$emprazsoc,
            'empest' => $empest,
            'emptag' => $emptag,
            'tipid'  => $emptipid
        );
        $this -> db -> where('empid', $empid);
        $this -> db -> update('empresa', $data);        
    }

    public function delete_empresa ($empid)
    {
        $this->db->where('empid', $empid);
        $this->db->delete('empresa');
    }

    public function set_empest($empid, $empest)
    {
        $data = array(
            'empest' =>$empest
        );
        $this -> db -> where('empid', $empid);
        $this -> db -> update('empresa', $data);
    }

    public function get_empest($empid)
    {
        $this -> db -> select('empest');
        $this -> db -> from('empresa');
        $this -> db -> where('empid', $empid);
        $query = $this -> db -> get() ->row('empest');
        return $query;
    }

    public function record_count()
    {
        $this -> db -> select('*');
        $this -> db -> from('empresa');
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }

    public function get_empresa_filtro ($emprazsoc, $limit, $start)
    {
        $this -> db -> select('*');
        $this -> db -> from('empresa, tipocliente');
        $this -> db -> where('empresa.tipid = tipocliente.tipid');
        if($emprazsoc <> ''){
            $this -> db -> like('UPPER(emprazsoc)' , strtoupper($emprazsoc), 'both');
        }
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();        
        return $query;
    }
}