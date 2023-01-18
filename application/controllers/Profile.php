<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 26/06/2017
 * Time: 08:08 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    /**
     * Created by PhpStorm.
     * User: smuguerza
     * Date: 22/05/2017
     * Time: 05:59 AM
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('MY_Profile');
        $this->load->library('encryption');
    }

    public function index()
    {
        if(isset($_SESSION['usuid'])){
            $usuid                              = $_SESSION['usuid'];
            $data['title']                      = '<i class="fa fa-user fa-fw"></i> My Profile';
            $data['titulo']                     = '<i class="fa fa-user fa-fw"></i> Mi Perfil';
            $contenido                          = 'profile/profile.php';
            $template                           = $_SESSION['grutem'];
            if($template === 'templateuserexterno'){
                $data['titulo_user']        ='User';
                $data['titulo_pass']        ='Password';
                $data['titulo_ape']         ='Last Name';
                $data['titulo_nom']         ='Name';
                $data['titulo_mail']        ='E-Mail';
                $data['titulo_btn_guardar'] ='Save';
                $data['titulo_btn_cancelar']='Cancel';
            }else{
                $data['titulo_user']        ='Usuario';
                $data['titulo_pass']        ='Contraseña';
                $data['titulo_ape']         ='Apellido';
                $data['titulo_nom']         ='Nombre';
                $data['titulo_mail']        ='Correo Electronico';
                $data['titulo_btn_guardar'] ='Guardar';
                $data['titulo_btn_cancelar']='Cancelar';
            }
            $data['usuario']                = $this->MY_Profile->get_profile($usuid);
            $data['pass']                   = $this->encryption->decrypt(base64_decode($data['usuario']->usupass));
            //$data['pass']                   = base64_encode($this->encryption->encrypt($this->input->post('usupass')));
            $this->$template-> display($contenido, $data);
        }
    }

    public function update()
    {
        if(isset($_SESSION['usuid'])) {
	        $usuid	    = $_SESSION['usuid'];
            $usupass    = base64_encode($this->encryption->encrypt($this->input->post('usupass')));
            $usunom     = trim($this->input->post('usunom'));
            $usuape     = trim($this->input->post('usuape'));
            $usumai     = trim($this->input->post('usumai'));
            $this->MY_Profile->update_profile($usuid, $usupass, $usunom, $usuape, $usumai);
            //$data['titulo'] = '<i class="fa fa-user fa-fw"></i> My Profile';
            $template                           = $_SESSION['grutem'];
            if($template === 'templateuserexterno'){
                $this->session->set_flashdata('updated', 'Profile Updated');
            }else{
                $this->session->set_flashdata('updated', 'Perfil Actualizado');
            }
           
            redirect(base_url() . "login/inicio");
        }
    }


}
