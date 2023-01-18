<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 06/02/2017
 * Time: 10:26 AM
 */

Class MY_Ultimos_Numeros extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    function get_Ultimo_Numero($ult_desc)
    {
        $this->db->select('ultnroval');
        $this->db->from('ultimonumero');
        $this->db->like('ultnrodsc', $ult_desc);
        $query = $this->db->get()->row('ultnroval');
        return $query;
    }

    function update_Ultimo_Numero($ult_desc, $ultnroval)
    {
        $this->db->set('ultnroval', $ultnroval);
        $this->db->where('ultnrodsc', $ult_desc);
        $this->db->update('ultimonumero');
    }

    function get_All_Ultimos_Numeros()
    {
        $this->db->select('*');
        $this->db->from('ultimonumero');
        $this->db->order_by('ultnroid', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_last_Ultimos_Numeros()
    {
        $this->db->select('ultnroid');
        $this->db->from('ultimonumero');
        $this->db->limit(1);
        $this->db->order_by('ultnroid', 'DESC');

        $query = $this->db->get()->row('ultnroid');
        return $query;
    }

    function save_new($ultnroid,  $ultnrodsc, $ultnroval)
    {
        $data = array(
            'ultnroid'  =>$ultnroid,
            'ultnrodsc' =>$ultnrodsc,
            'ultnroval' =>$ultnroval,
        );
        $this -> db -> insert('ultimonumero', $data);
    }

    function get_ult_all($ultnroid)
    {
        $this->db->select('*');
        $this->db->from('ultimonumero');
        $this->db->where('ultnroid', $ultnroid);
        $query = $this->db->get();
        return $query->result();
    }

    public function set_ult($ultnroid,  $ultnrodsc, $ultnroval)
    {
        $data = array(
            'ultnrodsc' => $ultnrodsc,
            'ultnroval' => $ultnroval
        );
        $this -> db -> where('ultnroid', $ultnroid);
        $this -> db -> update('ultimonumero', $data);
    }

    public function delete_ult ($ultnroid)
    {
        $this->db->where('ultnroid', $ultnroid);
        $this->db->delete('ultimonumero');
    }
}