<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/* include_once APPPATH.'vendor/phpoffice/phpspreadsheet/Spreadsheet';
include_once APPPATH.'vendor/phpoffice/phpspreadsheet/Spreadsheet/Writer/Xlsx'; */
/* use PhpSpreadsheet\Spreadsheet;
use PhpSpreadsheet\Writer\Xlsx; */
class Empresa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MY_Empresa');
        $this->load->model('MY_TipoCliente');
        $this->load->model('MY_Seguridad');
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->library('session');
    }

    public function index()
    {
        $config["base_url"]         = base_url() . "empresa/index/";
        $config["total_rows"]       = $this->MY_Empresa->record_count();
        //$total_rows                 = $this->MY_Empresa->record_count();
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

        $data['titulo']				 		= '<i class="fa fa-industry"></i> Empresas';
        $data['empresas']                   = $this -> MY_Empresa ->get_all_filtro($config["per_page"], $page);

        $data["links"]                      = $this -> pagination->create_links();
        $contenido 	                        = 'empresa/grilla_empresa.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }


    public function filtro()
    {
        $config["base_url"]         = base_url()."empresa/index/";
        $config["total_rows"]       = $this->MY_Empresa->record_count();
        $total_rows                 = $this->MY_Empresa->record_count();
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
        $segment                    = $this->uri->segment(3);
        if ($total_rows >= $segment){
            if($this->uri->segment(3)){
                $page = ($this->uri->segment(3)) ;
            }else {
                $page = 0;
            }
        }else {$page = 0;}
        $filtro_emprazsoc                   = $this->input->post('filtro_emprazsoc');               
        $data['empresas']                   = $this->MY_Empresa->get_empresa_filtro($filtro_emprazsoc, $config["per_page"], $page);
        
        $data["links"]                      = $this->pagination->create_links();
        $data['titulo']				 		= '<i class="fa fa-industry"></i> Empresas';
        $contenido                          = 'empresa/grilla_empresa.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }


    public function update($empid)
    {
        $data['titulo']				 		= '<i class="fa fa-industry"></i> Empresa';
        $data['empresa']                    = $this->MY_Empresa->get_empresa($empid);
        $data['tipocliente']                = $this -> MY_TipoCliente ->get_all();
        $contenido 	                        = 'empresa/empresa.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function new_empresa()

    {
        $data['titulo']				 		= '<i class="fa fa-industry"></i> Empresa';
        $contenido 	                        = 'empresa/new_empresa.php';
        $data['tipocliente']                = $this -> MY_TipoCliente ->get_all();
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new()
    {
        $empid              = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('empresa');
        $emprazsoc          = $this->input->post('emprazsoc');
        $empest             = $this->input->post('empest');
        $tipid              = $this->input->post('tipid');
        $emptagsap          = $this->input->post('emptagsap');
        $data['empresa']    = $this->MY_Empresa->new_empresa($empid, $emprazsoc, $empest, $emptagsap, $tipid, $emptagsap);
        $empid              = $empid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('empresa', $empid);
        $this->session->set_flashdata('success', 'Se Agrego con Exito');
        //$this->index();
        redirect(base_url() . 'Empresa/index/'.$_SESSION['current_page']);
    }
    
    public function save()
    {
        $empid           = $this->input->post('empid');
        $emprazsoc       = $this->input->post('emprazsoc');
        $empest          = $this->input->post('empest');
        $tipid           = $this->input->post('tipid');
        $emptagsap       = $this->input->post('emptagsap');
        $data['empresa'] = $this -> MY_Empresa ->set_empresa($empid, $emprazsoc, $empest, $tipid, $emptagsap);
        $this->session->set_flashdata('success', 'Se Actualizo con Exito');
        redirect(base_url() . 'Empresa/index/'.$_SESSION['current_page']);
    }

   /*  public function delete($empid)
    {
        $data['empresa']  = $this -> MY_Empresa ->delete_empresa($empid);
        $this->index();
    } */

    public function delete($empid)
    {
        $this -> MY_Empresa ->delete_empresa($empid);
        echo json_encode(array('success' => 1));            
    }

    public function borrar($empid)
    {
        $this->session->set_flashdata('delete', $empid);
        redirect(base_url() . "empresa/index");
    }


    public function empresa_modifica_estado($empid)
    {
        $this->session->set_flashdata('changeEmpEst', $empid);
        redirect(base_url() . "empresa/index/".$_SESSION['current_page']);        
    }
    public function set_EmpEst($empid)
    {
    $estado = $this -> MY_Empresa->get_empest($empid);
        if($estado == 1){
            $est = 0;
        }
        else {
            $est = 1;
        }
        $this -> MY_Empresa->set_empest($empid, $est);
        echo json_encode(array('success' => 1, 'text'=>'Se Actualizo con Exito'));
        //redirect(base_url() . "Empresa/index/");
    }

    public function createExcel() {
		$fileName       = 'empresas.xlsx'; 
        $empresas       = $this->MY_Empresa->get_all();
        //$tipocliente    = $this -> MY_TipoCliente ->get_all();
        $spreadsheet    = new Spreadsheet();
        $sheet          = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'Id');        
        $sheet->setCellValue('B1', 'Empresa');
        $sheet->setCellValue('C1', 'Estado');
        $sheet->setCellValue('D1', 'Tipo Empresa');
        $sheet->setCellValue('E1', 'Tag SAP');
        $rows = 2;
        foreach ($empresas as $val){            
            $sheet->setCellValue('A' . $rows, $val->empid);
            $sheet->setCellValue('B' . $rows, $val->emprazsoc);
            if($val->empest == 1 ){
                $sheet->setCellValue('C' . $rows, 'Habilitado');
            }else{
                $sheet->setCellValue('C' . $rows, 'Deshabilitado');
            }           
            $sheet->setCellValue('D' . $rows, $val->tipdsc);           
            $sheet->setCellValue('E' . $rows, $val->emptag);
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("media/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."media/".$fileName);              
    }    
}