<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Negocio extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->model('MY_Negocio');
        $this->load->model('MY_Documento');
        $this->load->model('MY_Cliente');
        $this->load->model('MY_Empresa');
        $this->load->library('Templateuser');
        $this->load->library('templatesuperusuario');
        $this->load->library('Templateuserexterno');
        $this->load->library('session');
    }

    public function index()
    {
        $config["base_url"]         = base_url() . "Negocio/index/";
        $config["total_rows"]       = $this->MY_Negocio->record_count();
        $total_rows                 = $this->MY_Negocio->record_count();
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
        $data['negocios']           = $this->MY_Negocio->get_all_filtro($config["per_page"], $page);
        $data['empresas']           = $this->MY_Empresa->get_all();
        $data["links"]              = $this->pagination->create_links();
        $data['titulo']             = '<i class="fa fa-tasks"></i> Ventas';
        $contenido                  = 'negocio/grilla_negocio.php';
        $template                   = $_SESSION['grutem'];
        $this->$template->display($contenido, $data);
    }

    public function filtro()
    {
        $config["base_url"]         = base_url()."Negocio/index/";
        $config["total_rows"]       = $this->MY_Negocio->record_count();
        $total_rows                 = $this->MY_Negocio->record_count();
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
        $segment                    = $this->uri->segment(3);
        if ($total_rows >= $segment){
            if($this->uri->segment(3)){
                $page = ($this->uri->segment(3)) ;
            }else {
                $page = 0;
            }
        }else {$page = 0;}
        $filtro_negbberef                   = $this->input->post('filtro_negbberef');
        $filtro_negfec                      = $this->input->post('filtro_negfec');
        $filtro_empid                       = $this->input->post('filtro_empid');
        $data['empresas']                   = $this->MY_Empresa->get_all();
        $data['negocios']                   = $this->MY_Negocio->get_negocio_filtro($filtro_negbberef, $filtro_negfec, $filtro_empid, $config["per_page"], $page);
        $data["links"]                      = $this->pagination->create_links();
        $data['titulo']                     = '<i class="fa fa-tasks"></i> Ventas';
        $contenido                          = 'negocio/grilla_negocio.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }


    public function update($negid)
    {
        $data['titulo']                     = '<i class="fa fa-tasks"></i> Venta';
        $data['negocio']                    = $this->MY_Negocio->get_negocio($negid);
        $data['empresas']                   = $this->MY_Empresa->get_all();
        $data['clientes']                   = $this->MY_Cliente->get_all_habilitado();
        $contenido 	                        = 'negocio/negocio.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function new_negocio()
    {
        $data['titulo']                     = '<i class="fa fa-tasks"></i> Venta';
        $contenido 	                        = 'negocio/new_negocio.php';
        $data['empresas']                   = $this -> MY_Empresa ->get_all();
        $data['clientes']                   = $this -> MY_Cliente ->get_all_habilitado();
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new()
    {
        $negid              = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('negocio');
        $negnom             = $this->input->post('negnom');
        $negdsc             = $this->input->post('negdsc');
        $negfec             = $this->input->post('negfec');
        $empid              = $this->input->post('empid');
        $negest             = $this->input->post('negest');
        $negcusref             = $this->input->post('negcusref');
        $negbberef             = $this->input->post('negbberef');
        
        $data['negocio']    = $this->MY_Negocio->new_negocio($negid, $negnom, $negdsc, $negfec, $negest, $empid, $negcusref, $negbberef);
        $negid              = $negid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('negocio', $negid);
        $this->session->set_flashdata('success', 'Se Agrego con Exito');
        redirect(base_url() . 'negocio/index');
    }
    
    public function save($negid)
    {
        $negnom             = $this->input->post('negnom');
        $negdsc             = $this->input->post('negdsc');
        $negfec             = $this->input->post('negfec');
        //$usuid          = $this->input->post('usuid');
        $negest             = $this->input->post('negest');
        $empid              = $this->input->post('empid');
        $negcusref             = $this->input->post('negcusref');
        $negbberef             = $this->input->post('negbberef');
        $data['negocio']    = $this -> MY_Negocio ->set_negocio($negid, $negnom, $negdsc, $negfec, $negest, $empid , $negcusref, $negbberef);
        $this->session->set_flashdata('success', 'Se Actualizo con Exito');
        //$this->index();
        redirect(base_url() . 'negocio/index');
    }

    public function delete($negid){        
        $negest = $this -> MY_Negocio ->get_negocio_estado($negid);
        if($negest == 1){
            //Negocio cerrado 
            echo json_encode(array('success' => 1, 'text'=>'El Negocio esta Cerrado'));
        }else{
            $documentos = $this -> MY_Documento ->get_all_by_negid($negid);
            $flag = 0;
            foreach ($documentos as $docs) {

                if($docs->docchk == 1){
                    //Documentos Verificados por el Cliente
                    echo json_encode(array('success' => 1, 'text'=>'La Venta tiene Documentos Verificados por el Cliente'));
                    $flag = 1;
                    break;
                }
                if($docs->doctip == 2){
                    //Documentos de Externos
                    echo json_encode(array('success' => 1, 'text'=>'La Venta tiene Documentos del Cliente'));
                    $flag = 1;
                    break;
                }
            }
            if($flag == 0){
                $this -> MY_Negocio ->delete_negocio($negid);
                echo json_encode(array('success' => 0));
            }
        }

    }

    public function borrar($negid){
        $this->session->set_flashdata('delete', $negid);
        redirect(base_url() . "negocio/index/".$_SESSION['current_page']);
    }

    public function negocio_modifica_estado($negid){
        $this->session->set_flashdata('changeNegEst', $negid);
        redirect(base_url() . "negocio/index/".$_SESSION['current_page']);
    }

    public function set_NegEst($negid)
    {
        $estado = $this -> MY_Negocio->get_negocio_estado($negid);
        if($estado == 1){
            $est = 0;
        }
        else {
            $est = 1;
        }
        $this -> MY_Negocio->set_negest($negid, $est);
        echo json_encode(array('success' => 1, 'text'=>'Se Actualizo con Exito'));
    }

    public function createExcel() {
		$fileName       = 'ventas.xlsx'; 
        $negocios       = $this->MY_Negocio->get_all_excel();
        //$tipocliente    = $this -> MY_TipoCliente ->get_all();
        $spreadsheet    = new Spreadsheet();
        $sheet          = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'BBE Ref. #');        
        $sheet->setCellValue('B1', 'Customer Ref. #');
        //$sheet->setCellValue('C1', 'Venta');
        $sheet->setCellValue('C1', 'Descripcion');
        $sheet->setCellValue('D1', 'Fecha');
        $sheet->setCellValue('E1', 'Empresa');
        $rows = 2;
        foreach ($negocios as $val){            
            $sheet->setCellValue('A' . $rows, $val->negbberef);
            $sheet->setCellValue('B' . $rows, $val->negcusref);
            //$sheet->setCellValue('C' . $rows, $val->negnom);                       
            $sheet->setCellValue('C' . $rows, $val->negdsc);      
            $sheet->setCellValue('D' . $rows, $val->negfec);           
            $sheet->setCellValue('E' . $rows, $val->emprazsoc);                        
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("media/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."media/".$fileName);              
    }    
}