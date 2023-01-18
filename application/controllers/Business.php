<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller
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
        //$this->load->model('MY_Negocio');
        //$this->load->model('MY_Seguridad');
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->model('MY_Negocio');
        $this->load->model('MY_Business');
        $this->load->model('MY_Cliente');
        $this->load->library('Templateuser');
        $this->load->library('templatesuperusuario');
        $this->load->library('Templateuserexterno');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    public function index()
    {
            $data['title']              = '<i class="fa fa-tasks"></i> Purchases ';
            $datos_nuevos = array();
            $config["total_rows"]       = $this->MY_Business->record_count_by_usuid($_SESSION['usuid']);
            $config["base_url"]         = base_url() . "Business/index/";
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
            if ($this->uri->segment(3)) {
                $page = ($this->uri->segment(3));
            } else {
                $page = 0;
            }
            $_SESSION['current_page']   = $page;
            $datos                      = $this -> MY_Business ->get_all_by_usuid($_SESSION['usuid'],$config["per_page"], $page);

            foreach ($datos as $item){
                $business =array(
                    'negid'     => $item->negid,
                    'businessid'=> base64_encode($this->encryption->encrypt($item->negid)),
                    'negdsc'    => $item->negdsc,
                    'negnom'    => $item->negnom,
                    'negfec'    => $item->negfec);
                array_push($datos_nuevos, $business);
            }
            $data["links"]                      = $this->pagination->create_links();
            $data['negocio']                    = $datos_nuevos;
            $contenido 	                        = 'business/grilla_business.php';
            $template                           = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);
        }

    public function view($negid)
    {
        $negid_decrypt                      = $this->encryption->decrypt(base64_decode($negid));
        //$data['title']				 		= 'Business';
        $data['title']                      = '<i class="fa fa-tasks"></i> Purchases ';
//        $data['titulo']				 		= 'Negocio';
        $data['business']                    = $this->MY_Business->get_business($negid_decrypt);
        $contenido 	                        = 'business/business.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }
    
    
}