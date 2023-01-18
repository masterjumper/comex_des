<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoCliente extends CI_Controller
{
    /**
     * Created by PhpStorm.
     * User: smuguerza
     * Date: 22/05/2017
     * Time: 05:59 AM
     */
    //var $fechadesde = null;
    //var $fechahasta = null;
    function __construct()
    {
        parent::__construct();
        $this->load->model('MY_TipoCliente');        
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->library('Templateuser');
        $this->load->library('templatesuperusuario');
        $this->load->library('session');
    }

    public function index(){
        $config["base_url"]         = base_url() . "TipoCliente/index/";
        $config["total_rows"]       = $this->MY_TipoCliente->record_count();
        $total_rows                 = $this->MY_TipoCliente->record_count();
        $config["per_page"]         = 7;
        $config["uri_segment"]      = 3;
        $config['num_links']        = 20;
        $config['full_tag_open']    = '<ul class="pagination">';        
        $config['full_tag_close']   = '</ul>';        
        $config['first_link']       = 'Primero';        
        $config['last_link']        = 'Ultimo';        
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
        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 0;
        }
        $_SESSION['current_page']   = $page;
        $data['tipoclientes']       = $this->MY_TipoCliente->get_all_filtro($config["per_page"], $page);        
        $data["links"]              = $this->pagination->create_links();
        $data['titulo']				= '<i class="fa fa-tag"></i> Tipos de Empresas';
        //$data['tipoclientes']     = $this -> MY_TipoCliente ->get_all();
        $contenido 	                = 'tipocliente/grilla_tipocliente.php';
        $template                   = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function update($tipid)
    {
        $data['titulo']				 		= '<i class="fa fa-tag"></i> Tipo de Empresa';
        $data['tipocliente']                = $this->MY_TipoCliente->get_tipocliente($tipid);
        $contenido 	                        = 'tipocliente/tipocliente.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function new_tipocliente()
    {
        $data['titulo']				 		= '<i class="fa fa-tag"></i> Tipo de Empresa';
        $contenido 	                        = 'tipocliente/new_tipocliente.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new()
    {
        $tipid          = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('tipocliente');
        $tipdsc         = $this->input->post('tipdsc');
        $data['tipocliente']  = $this->MY_TipoCliente->new_tipocliente($tipid, $tipdsc);
        $tipid          = $tipid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('tipocliente', $tipid);
        redirect(base_url() . 'TipoCliente/index');
    }
    
    public function save()
    {
        $tipid          = $this->input->post('tipid');
        $tipdsc         = $this->input->post('tipdsc');        
        $data['tipocliente']  = $this -> MY_TipoCliente ->set_tipocliente($tipid, $tipdsc );
        $this->index();
    }

    public function borrar($tipid){        
        $this->session->set_flashdata('delete', $tipid);            
        redirect(base_url() . "TipoCliente/index/".$_SESSION['current_page']);        
    }

    public function delete($tipid)
    {   
        $empresas = $this -> MY_TipoCliente ->get_all_empresas($tipid);        
        if($empresas == 1){            
            echo json_encode(array('success' => 1, 'text'=>'El Tipo de Empresa tiene Empresas Asociadas'));
        }else{            
            $data['tipocliente']  = $this -> MY_TipoCliente ->delete_tipocliente($tipid);
            echo json_encode(array('success' => 0));             
            //redirect(base_url() . "TipoCliente/index/".$_SESSION['current_page']);
        }
    }
}