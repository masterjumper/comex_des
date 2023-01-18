<?php

Class MY_Business extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_negnom_by_negid ($negid)
    {
        $this -> db -> select('negnom');
        $this -> db -> from('negocio');
        $this -> db -> where('negid', $negid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> row('negnom');
        return $query;
    }    

    public function get_negnom ($negid)
    {
        $this -> db -> select('negnom');
        $this -> db -> from('negocio');
        $this -> db -> where('negid', $negid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> row('negnom');
        return $query;
    }

    public function get_all_by_usuid ($usuid, $limit, $start)
    {
        $this -> db -> select('usuario.empid');
        $this -> db -> from('usuario');
        $this -> db -> where('usuario.usuid', $usuid);
        $empid = $this -> db ->get() -> row('empid');


        $this -> db -> select('negocio.*');
        $this -> db -> from('negocio');
        $this -> db -> where('negocio.empid', $empid);
        $this -> db -> limit($limit, $start);
        $this -> db -> order_by('negid', 'DESC');
        $query = $this -> db ->get() -> result();

        return $query;
    }


    public function record_count_by_usuid($usuid)
    {
        $this -> db -> select('usuario.empid');
        $this -> db -> from('usuario');
        $this -> db -> where('usuario.usuid', $usuid);
        $empid = $this -> db ->get() -> row('empid');


        $this -> db -> select('negocio.*');
        $this -> db -> from('negocio');
        $this -> db -> where('negocio.empid', $empid);
        $consulta = $this->db->get();
        return $consulta->num_rows();
    }

    public function get_business ($negid)
    {
        $this -> db -> select('*');
        $this -> db -> from('negocio');
        $this -> db -> where('negid', $negid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> result();
        return $query;
    }
}