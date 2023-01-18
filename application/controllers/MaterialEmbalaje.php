<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaterialEmbalaje extends CI_Controller
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
        $this->load->model('MY_MaterialEmbalaje');        
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->library('Templateuser');
        $this->load->library('templatesuperusuario');
        $this->load->library('session');
    }

    public function index(){
        $config["base_url"]         = base_url() . "MaterialEmbalaje/index/";
        $config["total_rows"]       = $this->MY_MaterialEmbalaje->record_count();
        $total_rows                 = $this->MY_MaterialEmbalaje->record_count();
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
        $data['materialembalajes']       = $this->MY_MaterialEmbalaje->get_all_filtro($config["per_page"], $page);        
        $data["links"]              = $this->pagination->create_links();
        $data['titulo']				= '<i class="fa fa-dropbox"></i> Materiales de Embalajes';
        //$data['materialembalajes']     = $this -> MY_MaterialEmbalaje ->get_all();
        $contenido 	                = 'materialembalaje/grilla_materialembalaje.php';
        $template                   = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function update($matembid)
    {
        $data['titulo']				 		= '<i class="fa fa-dropbox"></i> Materia de Embalaje';
        $data['materialembalaje']                = $this->MY_MaterialEmbalaje->get_materialembalaje($matembid);
        $contenido 	                        = 'materialembalaje/materialembalaje.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function new_materialembalaje()
    {
        $data['titulo']				 		= '<i class="fa fa-dropbox"></i> Materia de Embalaje';
        $contenido 	                        = 'materialembalaje/new_materialembalaje.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new()
    {
        $matembid          = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('materialembalaje');
        $matembdsc         = $this->input->post('matembdsc');
        $data['materialembalaje']  = $this->MY_MaterialEmbalaje->new_materialembalaje($matembid, $matembdsc);
        $matembid          = $matembid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('materialembalaje', $matembid);
        $this->session->set_flashdata('success', 'Se Registro con Exito');
        redirect(base_url() . 'MaterialEmbalaje/index');
    }
    
    public function save()
    {
        $matembid          = $this->input->post('matembid');
        $matembdsc         = $this->input->post('matembdsc');                
        $data['materialembalaje']  = $this -> MY_MaterialEmbalaje ->set_materialembalaje($matembid, $matembdsc );
        $this->session->set_flashdata('success', 'Registro Actualizado');
        redirect(base_url() . 'MaterialEmbalaje/index');
    }

    public function borrar($matembid){        
        $this->session->set_flashdata('delete', $matembid);            
        redirect(base_url() . "MaterialEmbalaje/index/".$_SESSION['current_page']);        
    }

    public function delete($matembid)
    {   
        $materialembalaje = $this -> MY_MaterialEmbalaje ->get_all_materialembalaje($matembid);        
        if($materialembalaje == 1){            
            echo json_encode(array('success' => 1, 'text'=>'El Material de Embalaje tiene ventas Asociadas'));
        }else{            
            $data['materialembalaje']  = $this -> MY_MaterialEmbalaje ->delete_materialembalaje($matembid);
            echo json_encode(array('success' => 0));             
            //redirect(base_url() . "MaterialEmbalaje/index/".$_SESSION['current_page']);
        }
    }
}