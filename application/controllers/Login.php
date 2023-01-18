<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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
        $this->load->model('MY_Seguridad');
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->library('Templateuserexterno');
        $this->load->library('templatesuperusuario');
        $this->load->library('Templateuser');
        $this->load->library('Template_error');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $this->load->view('login/login');
    }

    public function verificar()
    {
        $usuario            = $this -> input->post('usuario');
        $password           = $this -> input->post('password');
        $query              = $this -> MY_Seguridad -> get_usuario_password($usuario);
        //verifica si cargo el usuario solamente y no devuelve la contra
        if(empty($query)){

            $this->session->set_flashdata('error', 'User disabled');
            $this->session->set_flashdata('title', 'Access Denided');
            redirect(base_url());
/* 
            $data['message']    = 'Wrong User or Password';
            $data['title']      = 'Access Denided';
            $data['return_to']  = base_url();
            $contenido = 'message/message.php';
            $this->template_error->display_error($contenido, $data); */

        }else {

            $password_decrypted = $this->encryption->decrypt(base64_decode($query));

            if (trim($password_decrypted) == trim($password)) {
                //verificar que no este deshabilitada la empresa
                $habilitada = $this->MY_Seguridad->get_empresa_habilitada_by_usuario($usuario);
                if ($habilitada == 0) {
                    /* redirect(base_url()); */
                    $this->session->set_flashdata('error', 'User disabled');
                    $this->session->set_flashdata('title', 'Access Denided');
                    redirect(base_url());
                }
            }
            if (trim($password_decrypted) == trim($password)) {
                $usuario_datos = $this->MY_Seguridad->get_usuario($usuario);
                foreach ($usuario_datos as $usudat) {
                    $_SESSION['usuid']  = $usudat->usuid;
                    $_SESSION['usunom'] = $usudat->usunom;
                    $_SESSION['usuape'] = $usudat->usuape;
                    $_SESSION['gruid']  = $usudat->gruid;
                    $_SESSION['grutem'] = trim($usudat->grutem);
                }
                $template = $_SESSION['grutem'];
                //$contenido = 'contenido/vacio.php';
                if ($template <> 'templateuserexterno') {
                    $data['titulo'] = 'Inicio';
                    redirect(base_url() . 'Login/inicio');
                    //$this->$template->display($contenido, $data);
                } else {
                    redirect(base_url() . 'Business/index');
                }


            } else {
                $this->session->set_flashdata('error', 'Wrong User or Password');
                $this->session->set_flashdata('title', 'Access Denided');
                redirect(base_url());
                /* $data['message']    = 'Wrong User or Password';
                $data['title']      = 'Access Denided';
                $data['return_to']  = base_url();
                $contenido          = 'message/message.php';
                $this->template_error->display_error($contenido, $data); */
            }
        }
    }

    public function inicio()
    {
        if($this->session->userdata('usuid')) {
            $data['titulo'] = 'Inicio';
            $contenido      = 'contenido/vacio.php';
            $template       = $_SESSION['grutem'];
            if($template <> 'templateuserexterno'){
                $data['titulo'] = 'Inicio';
            }else{
                $data['title']  = 'Home';
            }
            $this->$template-> display($contenido, $data);
            //$this->templateusuario_inicio->display($contenido, $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
}