<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 26/06/2017
 * Time: 08:08 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
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
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->model('MY_Usuario');
        $this->load->model('MY_Grupo');
        $this->load->library('encryption');
    }

    public function index()
    {
        //$_SESSION['NotPen']     			= $this->MY_Notificacion->record_count($_SESSION['usuid']);
        //$data['NotPen']         			= $_SESSION['NotPen'];
        //$data['notificaciones'] 			= $this->MY_Notificacion->get_notificacion_by_usuid($_SESSION['usuid']);
        $config["base_url"]         = base_url()."Usuario/index/";
        $config["total_rows"]       = $this->MY_Usuario->record_count();
        $config["per_page"]         = 7;
        $config["uri_segment"]      = 3;
        $config['num_links']        = 20;
        $config['full_tag_open']    = '<ul class="pagination">';        
        $config['full_tag_close']   = '</ul>';        
        $config['first_link']       = 'First';        
        $config['last_link']        = 'Last';        
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close']  = '</span></li>';        
        $config['prev_link']        = '&laquo';        
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close']   = '</span></li>';        
        $config['next_link']        = '&raquo';        
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close']   = '</span></li>';        
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close']   = '</span></li>';        
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close']    = '</a></li>';        
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close']    = '</span></li>';
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }
        $_SESSION['current_page']           = $page;
        $data['usuarios']                   = $this->MY_Usuario->get_all_filtro($config["per_page"], $page);
        $data["links"]                      = $this->pagination->create_links();
        $data['titulo']                     = 'Usuario';
        $contenido                          = 'usuario/usuarios_grilla.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function filtro()
    {
        $config["base_url"]         = base_url() . "Usuario/index/";
        $config["total_rows"]       = $this->MY_Usuario->record_count();
        //$total_rows                 = $this->MY_Usuario->record_count();
        $config["per_page"]         = 7;
        $config["uri_segment"]      = 3;
        $config['num_links']        = 20;
        $config['full_tag_open']    = '<ul class="pagination">';        
        $config['full_tag_close']   = '</ul>';        
        $config['first_link']       = 'First';        
        $config['last_link']        = 'Last';        
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close']  = '</span></li>';        
        $config['prev_link']        = '&laquo';        
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close']   = '</span></li>';        
        $config['next_link']        = '&raquo';        
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close']   = '</span></li>';        
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close']   = '</span></li>';        
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close']    = '</a></li>';        
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close']    = '</span></li>';
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }
        /*
        $segment                    = $this->uri->segment(3);
        if ($total_rows >= $segment){
            if($this->uri->segment(3)){
                $page = ($this->uri->segment(3)) ;
            }else {
                $page = 0;
            }
        }else {$page = 0;}
        */
        $filtro_usuuser                     = $this->input->post('filtro_usuuser');
        $filtro_usunom                      = $this->input->post('filtro_usunom');
        $filtro_usuape                      = $this->input->post('filtro_usuape');
        $data['usuarios']                   = $this->MY_Usuario->get_usuario_filtro($filtro_usuuser, $filtro_usunom, $filtro_usuape, $config["per_page"], $page);
        $data["links"]                      = $this->pagination->create_links();
        $data['titulo']                     = 'Usuario';
        $contenido                          = 'usuario/usuarios_grilla.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function delete($usuid)
    {
        $this->MY_Usuario->delete_usuario($usuid);
        redirect(base_url() . "Usuario/index/".$_SESSION['current_page']);
    }

    public function usuario($usuid)
    {
        $data['grupos']  = $this->MY_Grupo->get_all();
        //$data['sectorfabrica']   = $this->MY_Sector_Fabrica->get_all();
        $data['usuario'] = $this->MY_Usuario->get_usuario($usuid);
        $data['pass']    = $this->encryption->decrypt(base64_decode($data['usuario']->usupass));
        $data['titulo']  = 'Usuario';
        $contenido       = 'usuario/usuario.php';
        $template        = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function update($usuid)
    {
        //$usupass    = $this->input->post('usupass');
        $usupass    = base64_encode($this->encryption->encrypt($this->input->post('usupass')));
        $usunom     = trim($this->input->post('usunom'));
        $usuape     = trim($this->input->post('usuape'));
        $usumai     = trim($this->input->post('usumai'));
        $gruid      = $this->input->post('gruid');
        $usuest     = $this->input->post('usuest');
        $usumarmai  = $this->input->post('usumarmai');
        $this->MY_Usuario->update_usuario($usuid, $usupass, $usunom, $usuape, $usumai, $gruid, $usuest,$usumarmai);
        $data['titulo']                     = 'Usuario';
        redirect(base_url() . "Usuario/index/".$_SESSION['current_page']);
    }

    public function agregar_usuario(){

        $data['grupos']                     = $this->MY_Grupo->get_all();
        $data['titulo']                     = 'Usuario';
        $contenido                          = 'usuario/usuario_new.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new(){
        $usuid      = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('usuario');
        $usuuser    = $this->input->post('usuuser');
        $usupass    = base64_encode($this->encryption->encrypt($this->input->post('usupass')));
        $usunom     = $this->input->post('usunom');
        $usuape     = $this->input->post('usuape');
        $usumai     = $this->input->post('usumai');
        $gruid      = $this->input->post('gruid');
        $usuest     = $this->input->post('usuest');
        $usumarmai  = $this->input->post('usumarmai');
        $this->MY_Usuario->new_usuario($usuid,$usuuser, $usupass, $usunom, $usuape, $usumai, $gruid, $usuest, $usumarmai);
        $usuid      = $usuid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('usuario', $usuid);
        redirect(base_url() . "Usuario/index/".$_SESSION['current_page']);
    }

    public function usuario_modifica_estado($usuid)
    {
        $estado = $this -> MY_Usuario->get_usuest($usuid);
        if($estado == 1){
            $est = 0;
        }
        else {
            $est = 1;
        }
        $this -> MY_Usuario->set_usuest($usuid, $est);
        $this->session->set_flashdata('success', 'Se Actualizo con Exito');
        redirect(base_url() . "Usuario/index/".$_SESSION['current_page']);
    }

    public function usuario_modifica_reccorr($usuid)
    {
        $reccorr = $this -> MY_Usuario->get_usureccorr($usuid);
        
        if($reccorr == 1){
            $est = 0;
        }
        else {
            $est = 1;
        }
        $this -> MY_Usuario->set_usureccorr($usuid, $est);
        $this->session->set_flashdata('success', 'Se Actualizo con Exito');
        redirect(base_url() . "Usuario/index/".$_SESSION['current_page']);
    }

}
