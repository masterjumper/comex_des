<?php

Class MY_Negocio extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_excel()
    {
        $this -> db -> select('negocio.*, empresa.*');
        $this -> db -> from('negocio, empresa');        
        $this -> db -> where('negocio.empid = empresa.empid');        
        $this -> db -> order_by('negid', 'DESC');
        $query = $this -> db ->get() -> result();        
        return $query;
    }

    public function get_all ()
    {
        $this -> db -> select('negocio.*, usuario.*');
        $this -> db -> from('negocio, usuario');
        $this -> db -> where('negocio.usuid = usuario.usuid');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_all_filtro ($limit, $start)
    {
        $this -> db -> select('negocio.*, empresa.*');
        $this -> db -> from('negocio, empresa');
        //$this -> db -> where('usuario.gruid',3);
        $this -> db -> where('negocio.empid = empresa.empid');
        $this -> db -> limit($limit, $start);
        $this -> db -> order_by('negid', 'DESC');
        $query = $this -> db ->get() -> result();
        //echo $this -> db -> last_query();
        return $query;
    }

    public function get_negocio_filtro ($filtro_negbberef, $filtro_negfec, $filtro_empid, $limit, $start)
    {
        $this -> db -> select('negocio.*, empresa.*');
        $this -> db -> from('negocio, empresa');
        $this -> db -> where('negocio.empid = empresa.empid');

        if(empty($filtro_negbberef) == FALSE){
            $this -> db -> like('negocio.negbberef', $filtro_negbberef,'both');
        }
        if(empty($filtro_negfec) == FALSE){
            $this -> db -> like('negocio.negfec', $filtro_negfec,'both');
        }
        if(empty($filtro_empid) == FALSE){
            $this -> db -> where('negocio.empid', $filtro_empid);
        }
        $this -> db -> limit($limit, $start);
        $this -> db -> order_by('negid', 'DESC');
        $query = $this -> db ->get() -> result();

        return $query;
    }

    public function get_negocio ($negid)
    {
        $this -> db -> select('*');
        $this -> db -> from('negocio');
        $this -> db -> where('negid', $negid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function new_negocio($negid, $negnom, $negdsc, $negfec, $negest,$empid , $negcusref, $negbberef)
    {
        $data = array(
            'negid'  =>$negid,
            'negdsc' =>$negdsc,
            'negnom' =>$negnom,
            'negfec' =>$negfec,
            'empid'  =>$empid,
            'negest' =>$negest,
            'negcusref' =>$negcusref,
            'negbberef' =>$negbberef,
        );
        $this -> db -> insert('negocio', $data);
    }

    public function set_negocio($negid, $negnom, $negdsc, $negfec, $negest, $empid, $negcusref, $negbberef)
    {
        $data = array(
            'negdsc' =>$negdsc,
            'negnom' =>$negnom,
            'negfec' =>$negfec,
            'empid'  =>$empid,
            'negest' =>$negest,
            'negcusref' =>$negcusref,
            'negbberef' =>$negbberef,
        );
        $this -> db -> where('negid', $negid);
        $this -> db -> update('negocio', $data);
    }

    public function delete_negocio ($negid)
    {
        $this->db->where('negid', $negid);
        $this->db->delete('negocio');

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

    public function get_usunom_by_negid ($negid)
    {
        $this -> db -> select('empid');
        $this -> db -> from('negocio');
        $this -> db -> where('negid', $negid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> row('empid');

        $this -> db -> select('emprazsoc');
        $this -> db -> from('empresa');
        $this -> db -> where('empid', $query);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> row('emprazsoc');
        return $query;
    }

    public function get_all_by_usuid ($usuid)
    {
        $this -> db -> select('usuario.empid');
        $this -> db -> from('usuario');
        $this -> db -> where('usuario.usuid', $usuid);
        $empid = $this -> db ->get() -> row('empid');


        $this -> db -> select('negocio.*');
        $this -> db -> from('negocio');
        $this -> db -> where('negocio.empid', $empid);
        $query = $this -> db ->get() -> result();
        
        return $query;
    }

    public function record_count()
    {
        $this -> db -> select('*');
        $this -> db -> from('negocio');
        $consulta = $this->db->get();
        return $consulta->num_rows();
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

    public function get_negocio_estado ($negid)
    {
        $this -> db -> select('negest');
        $this -> db -> from('negocio');
        $this -> db -> where('negid', $negid);
        $this -> db -> limit(1);
        $query = $this -> db ->get() -> row('negest');
        return $query;
    }

    public function set_negest($negid, $negest)
    {
        $data = array(
            'negest' =>$negest
        );
        $this -> db -> where('negid', $negid);
        $this -> db -> update('negocio', $data);
    }
}