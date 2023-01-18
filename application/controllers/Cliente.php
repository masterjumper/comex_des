<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cliente extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->model('MY_Cliente');
        $this->load->model('MY_Grupo');
        $this->load->model('MY_Empresa');
        $this->load->library('encryption');
    }

    public function index(){
        $config["base_url"]         = base_url()."Cliente/index/";
        $config["total_rows"]       = $this->MY_Cliente->record_count();        
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
        $data['empresas']                   = $this->MY_Empresa->get_all();
        $data['usuarios']                   = $this->MY_Cliente->get_all_filtro($config["per_page"], $page);
        $data["links"]                      = $this->pagination->create_links();
        $data['titulo']                     = '<i class="fa fa-users"></i> Usuarios';
        $contenido                          = 'cliente/cliente_grilla.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);        
    }

    public function filtro(){
        $config["base_url"]         = base_url()."Cliente/index/";
        $config["total_rows"]       = $this->MY_Cliente->record_count();
        $total_rows                 = $this->MY_Cliente->record_count();
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
        $filtro_usuuser                     = $this->input->post('filtro_usuuser');
        $filtro_usunom                      = $this->input->post('filtro_usunom');
        $filtro_usuape                      = $this->input->post('filtro_usuape');
        $filtro_empid                       = $this->input->post('filtro_empid');
        $data['empresas']                   = $this->MY_Empresa->get_all();
        $data['usuarios']                   = $this->MY_Cliente->get_cliente_filtro($filtro_usuuser, $filtro_usunom, $filtro_usuape, $config["per_page"], $page, $filtro_empid);
        $data["links"]                      = $this->pagination->create_links();
        $data['titulo']                     = '<i class="fa fa-users"></i> Usuarios';
        $contenido                          = 'cliente/cliente_grilla.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function delete($usuid)
    {        
        $this->MY_Cliente->delete_cliente($usuid);        
        echo json_encode(array('success' => 1));        
    }

    public function cliente($usuid){
        $data['grupos']                     = $this->MY_Grupo->get_all();
        $data['usuario']                    = $this->MY_Cliente->get_cliente($usuid);
        $data['pass']                       = $this->encryption->decrypt(base64_decode($data['usuario']->usupass));
        $data['empresas']                   = $this->MY_Empresa->get_all();
        $data['titulo']                     = '<i class="fa fa-users"></i> Usuario';
        $contenido                          = 'cliente/cliente.php';
        $template                           = $_SESSION['grutem'];        
        $this->$template-> display($contenido, $data);
    }

    public function update($usuid){
        $usupass    = base64_encode($this->encryption->encrypt($this->input->post('usupass')));
        $usunom     = trim($this->input->post('usunom'));
        $usuape     = trim($this->input->post('usuape'));
        $usumai     = $this->input->post('usumai');
        $usulstmai  = nl2br($this->input->post('usulstmai'));
        $usulstmai  = $this->cleanText($usulstmai);
        $usuest     = $this->input->post('usuest');
        $empid      = $this->input->post('empid');
        $this->MY_Cliente->update_cliente($usuid, $usupass, $usunom, $usuape, $usumai, $usuest, $empid, $usulstmai);

        $data['titulo']                     = '<i class="fa fa-users"></i> Usuario';
        
        $this->session->set_flashdata('success', 'Se Actualizo con Exito');
        redirect(base_url() . 'Cliente/index/'.$_SESSION['current_page']);     
    }

    public function agregar_cliente(){
        $data['grupos']                     = $this->MY_Grupo->get_all();
        $data['empresas']                   = $this->MY_Empresa->get_all();
        $data['titulo']                     = 'Usuario';
        $contenido                          = 'cliente/cliente_new.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new(){
        $usuid          = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('usuario');
        $usuuser        = $this->input->post('usuuser');
        //$usupass    = $this->input->post('usupass');
        $usupass        = base64_encode($this->encryption->encrypt($this->input->post('usupass')));
        $usunom         = $this->input->post('usunom');
        $usuape         = $this->input->post('usuape');
        $usumai         = $this->input->post('usumai');
        $usulstmai      = nl2br($this->input->post('usulstmai'));
        $usulstmai      = $this->cleanText($usulstmai);
        $usuest         = $this->input->post('usuest');
        $empid          = $this->input->post('empid');
        $this->MY_Cliente->new_cliente($usuid, $usuuser, $usupass, $usunom, $usuape, $usumai,  $usuest, $empid, $usulstmai);
        $usuid      = $usuid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('usuario', $usuid);

        $this->session->set_flashdata('success', 'Se Agrego con Exito');
        //$this->index();
        redirect(base_url() . "Cliente/index/".$_SESSION['current_page']);
    }

    public function set_UsuEst($usuid)
    {
        $estado = $this -> MY_Cliente->get_usuest($usuid);
        if($estado == 1){
            $est = 0;
        }
        else {
            $est = 1;
        }
        $this -> MY_Cliente->set_usuest($usuid, $est);
        //redirect(base_url() . "Cliente/index/".$_SESSION['current_page']);
        echo json_encode(array('success' => 1, 'text'=>'Se Actualizo con Exito'));
    }

    function cleanText($string)
    {
        $search = ["<br />"];
        $replacements = [""];

        return str_replace($search, $replacements, $string);
    }

    public function borrar($usuid)
    {
        $this->session->set_flashdata('delete', $usuid);
        redirect(base_url() . "Cliente/index/".$_SESSION['current_page']);
    }

    public function cliente_modifica_estado($usuid)
    {
        $this->session->set_flashdata('changeUsuEst', $usuid);
        redirect(base_url() . "Cliente/index/".$_SESSION['current_page']);
    }

    public function createExcel() {
		$fileName       = 'usuarios.xlsx'; 
        $negocios       = $this->MY_Cliente->get_all_planilla();
        //$tipocliente    = $this -> MY_TipoCliente ->get_all();
        $spreadsheet    = new Spreadsheet();
        $sheet          = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'Usuario');        
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Apellido');
        $sheet->setCellValue('D1', 'Correo');
        $sheet->setCellValue('E1', 'Empresa');
        $sheet->setCellValue('F1', 'Estado');        
        $rows = 2;
        foreach ($negocios as $val){            
            $sheet->setCellValue('A' . $rows, $val->usuuser);
            $sheet->setCellValue('B' . $rows, $val->usunom);
            $sheet->setCellValue('C' . $rows, $val->usuape);                       
            $sheet->setCellValue('D' . $rows, $val->usumai);   
            $sheet->setCellValue('E' . $rows, $val->emprazsoc);
            if($val->usuest == 1){      
                $sheet->setCellValue('F' . $rows, 'Habilitado');                                             
            }else{
                $sheet->setCellValue('F' . $rows, 'Deshabilitado');      
            }
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("media/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."media/".$fileName);              
    }    
}
