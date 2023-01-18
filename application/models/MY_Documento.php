<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/05/2017
 * Time: 06:49 AM
 */
Class MY_Documento extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all()
    {
        $this -> db -> select('*');
        $this -> db ->from('documento');
        $query = $this -> db -> get() ->result();
        return $query;
    }

    public function get_all_documento()
    {
        $this -> db ->select('*');
        $this -> db ->from('documento');
        $query = $this -> db -> get() ->result();
        return $query;
    }

    /* public function get_documento_filtro ($filtro_codigo, $filtro_nombre, $limit, $start)
    {
        $this -> db ->select('*');
        $this -> db ->from('documento');

        if(empty($filtro_codigo) == FALSE){
            $this -> db -> like('doccod', $filtro_codigo, 'both');
        }
        if(empty($filtro_nombre) == FALSE){
            $this -> db -> like('docdsc', $filtro_nombre,'both');
        }
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    } */

    public function get_documento_filtro ($negid , $filtro_des, $filtro_nom, $limit, $start)
    {
        $this -> db ->select('*');
        $this -> db ->from('documento');
        $this -> db ->where('negid', $negid );
        if(empty($filtro_nom) == FALSE){
            $this -> db -> like('UPPER(docnom)', strtoupper($filtro_nom), 'both');
        }
        if(empty($filtro_des) == FALSE){
            $this -> db -> like('UPPER(docdsc)', strtoupper($filtro_des),'both');
        }
        $this -> db -> limit($limit, $start);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_all_by_docid($docid)
    {
        $this -> db -> select('*');
        $this -> db ->from('documento');
        $this -> db ->where('docid', $docid);
        $query = $this -> db -> get() ->result();
        return $query;
    }

    public function get_docpat_by_docid($docid)
    {
        $this -> db -> select('docpath');
        $this -> db ->from('documento');
        $this -> db ->where('docid', $docid);
        $query = $this -> db -> get() ->row('docpath');
        return $query;
    }

    public function update_documento($docid, $docnom, $docdsc, $docfec, $docpath)
    {
        $data = array(
            'docnom'     => $docnom,
            'docdsc'     => $docdsc,
            'docfec'     => $docfec,
            'docpath'    => $docpath
        );
        $this -> db ->where('docid', $docid);
        $this -> db ->update('documento', $data);
    }

    public function insert_documento($docid, $negid, $docnom, $docdsc, $docfec, $docpath, $doctip)
    {
        $data = array(
            'docid'     =>$docid,
            'docnom'    => $docnom,
            'docdsc'    => $docdsc,
            'docfec'    => $docfec,
            'docpath'   => $docpath,
            'negid'     => $negid,
            'doctip'   =>  $doctip,
            );

        $this -> db ->insert('documento', $data);
    }

    public function set_documento_codest_by_docid($docid, $codest)
    {
        $data = array(
            'docest'     => $codest
        );
        $this -> db ->where('docid', $docid);
        $this -> db ->update('documento', $data);
    }

    public function delete_documento ($docid)
    {
        $this->db->where('docid', $docid);
        $this->db->delete('documento');
    }

    public function record_count($negid) {
        {
            $this->db->select('*');
            $this->db->from('documento');
            $this -> db ->where('negid', $negid );
            $this->db->order_by('docid', 'ASC');
            $consulta = $this->db->get();
            return $consulta->num_rows();
        }
    }

    public function get_all_documento_pag($negid, $limit, $start)
    {
        $this -> db ->select('*');
        $this -> db ->from('documento');
        $this -> db ->where('negid', $negid );
        $this -> db -> limit($limit, $start);
        $query = $this -> db -> get() ->result();
        return $query;
    }

    public function get_negid_by_docid($docid)
    {
        $this -> db -> select('negid');
        $this -> db ->from('documento');
        $this -> db ->where('docid', $docid);
        $query = $this -> db -> get() ->row('negid');
        return $query;
    }

    public function get_all_by_negid($negid)
    {
        $this -> db -> select('*');
        $this -> db ->from('documento');
        $this -> db ->where('negid', $negid);
        $query = $this -> db -> get() ->result();
        return $query;
    }

}