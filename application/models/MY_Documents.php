<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/05/2017
 * Time: 06:49 AM
 */
Class MY_Documents extends CI_Model
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

    public function get_documento_filtro ($filtro_codigo, $filtro_nombre, $limit, $start)
    {
        $this -> db ->select('*');
        $this -> db ->from('documento');

        if(empty($filtro_codigo) == FALSE){
            $this -> db -> like('doccod', $filtro_codigo, 'both');
        }
        if(empty($filtro_nombre) == FALSE){
            $this -> db -> like('docdsc', $filtro_nombre,'both');
        }
        $this -> db ->where('doctip', 1);//empresa
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

    public function insert_document($docid, $negid, $docnom, $docdsc, $docfec, $docpath, $doctip)
    {
        $data = array(
            'docid'     => $docid,
            'docnom'    => $docnom,
            'docdsc'    => $docdsc,
            'docfec'    => $docfec,
            'docpath'   => $docpath,
            'negid'     => $negid,
            'doctip'    =>  $doctip,
            'docfecupl' =>  date_format(new DateTime('now'),"Y-m-d H:i:s")
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
            $this -> db ->where('doctip', 1);//empresa

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
        $this -> db ->where('doctip', 1);//empresa
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
    
    public function set_document_check($docid){
        $data = array(
            'docchk'     => 1,
            'docfecchk'  => date_format(new DateTime('now'),"Y-m-d H:i:s")
        );
        $this -> db ->where('docid', $docid);
        $this -> db ->update('documento', $data);
    }

    public function get_document_check($docid){
        $this -> db ->select('docfecchk');
        $this -> db ->from('documento');
        $this -> db ->where('docid', $docid);
        $query = $this -> db -> get() ->row('docfecchk');
        return $query;
    }

    public function get_document_docnom($docid){
        $this -> db ->select('docnom');
        $this -> db ->from('documento');
        $this -> db ->where('docid', $docid);
        $query = $this -> db -> get() ->row('docnom');
        return $query;
    }
}