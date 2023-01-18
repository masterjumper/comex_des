<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_Profile extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_profile ($usuid)
    {
        $this -> db -> select('usuario.*, grupo.*');
        $this -> db -> from('usuario, grupo');
        $this -> db -> where('usuario.usuid', $usuid);
        $this -> db -> where('usuario.gruid = grupo.gruid');
        $this -> db -> limit(1);
        $query = $this->db->get()->row();
        return $query;
    }

    public function update_profile($usuid, $usupass, $usunom, $usuape, $usumai) {
        $data = array(
            'usupass' => $usupass,
            'usunom'  => $usunom,
            'usuape'  => $usuape,
            'usumai'  => $usumai
        );
        $this->db->where('usuid', $usuid);
        $this->db->update('usuario', $data);
    }

}