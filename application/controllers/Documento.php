<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller
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
        $this->load->library('pagination');
        $this->load->library('javascript');
        $this->load->library('calendar');
        $this->load->helper(array('url', 'html', 'form', 'file', 'download', 'path'));
        $this->load->model('MY_Grupo');
        $this->load->model('MY_Seguridad');
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->model('MY_Documento');
        $this->load->model('MY_Negocio');
    }

    public function index($negid)
    {
        if($this->session->userdata('usuid')){
            $config["base_url"]         = base_url() . "documento/index/".$negid;
            $config["total_rows"]       = $this->MY_Documento->record_count($negid);
            $config["per_page"]         = 7;
            $config["uri_segment"]      = 4;
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

            if($this->uri->segment(4)){
                $page = ($this->uri->segment(4)) ;
            }
            else{
                $page = 0;
            }
            $data['documentos']                 = $this->MY_Documento->get_all_documento_pag($negid, $config["per_page"], $page);
            $contenido 	                        = 'documento/grilla_documento.php';
            $data["links"]  = $this->pagination->create_links();
            $negnom                             = $this->MY_Negocio->get_negnom_by_negid ($negid);
            $clinom                             = $this->MY_Negocio->get_usunom_by_negid ($negid);
            //$data['titulo']                     = '<i class="fa fa-industry"></i> '.$clinom . ' - <i class="fa fa-tasks"></i> '. $negnom .' - <i class="fa fa-book"></i> Documentos';
            $data['titulo']                     = '<i class="fa fa-industry"></i> '. $clinom . ' <i class="fa fa-arrow-right"></i> <i class="fa fa-tasks"></i> '. $negnom .' <i class="fa fa-arrow-right"></i> <i class="fa fa-book"></i> Documentos';
            $data['negid']                      = $negid;
            $template                           = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);
        }else{
                redirect('/');
        }
    }


    public function filtro($negid)
    {
        if($this->session->userdata('usuid')){
            $config["base_url"]         = base_url() . "documento/index/".$negid;
            $config["total_rows"]       = $this->MY_Documento->record_count($negid);
            $config["per_page"]         = 7;
            $config["uri_segment"]      = 4;
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
            if($this->uri->segment(4)){
                $page = ($this->uri->segment(4)) ;
            }
            else{
                $page = 0;
            }
            $filtro_des                      = $this->input->post('filtro_des');
            $filtro_nom                      = $this->input->post('filtro_nom');
            $data['documentos']                 = $this->MY_Documento->get_documento_filtro ($negid, $filtro_des, $filtro_nom, $config["per_page"], $page);
            $negnom                             = $this->MY_Negocio->get_negnom_by_negid ($negid);
            $clinom                             = $this->MY_Negocio->get_usunom_by_negid ($negid);
            $data['titulo']                     = '<i class="fa fa-industry"></i> '. $clinom . ' <i class="fa fa-arrow-right"></i> <i class="fa fa-tasks"></i> '. $negnom .' <i class="fa fa-arrow-right"></i> <i class="fa fa-book"></i> Documentos';
            $data['negid']                      = $negid;
            $contenido 	                        = 'documento/grilla_documento.php';
            $data["links"]  = $this->pagination->create_links();
            $template                           = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);
        }else{
            redirect('/');
        }
    }

    public function update($docid)
    {
        $negid                              = $this->MY_Documento->get_negid_by_docid($docid);
        $negnom                             = $this->MY_Negocio->get_negnom_by_negid ($negid);
        $clinom                             = $this->MY_Negocio->get_usunom_by_negid ($negid);
        $data['documento']                  = $this->MY_Documento->get_all_by_docid($docid);
        $_SESSION['file_name']              = $this->MY_Documento->get_docpat_by_docid($docid);
        $contenido 	                        = 'documento/documento.php';
        /* $data['titulo']                     = $clinom . ' - Negocio '. $negnom .'- Documentos'; */        
        $data['titulo']                     = '<i class="fa fa-industry"></i> '.$clinom . ' <i class="fa fa-arrow-right"></i> <i class="fa fa-tasks"></i> '. $negnom .' <i class="fa fa-arrow-right"></i> <i class="fa fa-book"></i> Editar Documento';
        $data['negid']                      = $negid;
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save($docid)
    {
        $negid          = $this->MY_Documento->get_negid_by_docid($docid);
        $docnom         = $this->input->post('docnom');
        $docdsc         = $this->input->post('docdsc');
        $docfec         = $this->input->post('docfec');
        //$docpath        = $this->input->post('docpath');
        $docpathtxt     = $this->input->post('docpathtxt');
        if ($docpathtxt <> ""){
            $this->carga_archivo($negid);
        }else{
            $_SESSION['file_name']      = $docpathtxt;
        }
        $this->MY_Documento->update_documento($docid, $docnom, $docdsc, $docfec, $_SESSION['file_name']);
        $_SESSION['file_name']      = '';
        $this->session->set_flashdata('success', 'Se Actualizo con Exito');
        //$this->index();
        redirect(base_url() . 'documento/index/'.$negid);
        //$this->index($negid);
    }

    public function nuevo($negid)
    {
        $negnom                             = $this->MY_Negocio->get_negnom_by_negid ($negid);
        $clinom                             = $this->MY_Negocio->get_usunom_by_negid ($negid);
        //$data['titulo']                     = 'Negocio '. $negnom .' - Documento Nuevo';
        $data['titulo']                     = '<i class="fa fa-industry"></i> '.$clinom . ' <i class="fa fa-arrow-right"></i><i class="fa fa-tasks"></i> '. $negnom .' <i class="fa fa-arrow-right"></i><i class="fa fa-book"></i> Documento Nuevo';
        $data['negid']                      = $negid;
        $contenido                          = 'documento/documento_nuevo.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_nuevo($negid)
    {
        $_SESSION['file_name'] = "";
        $docnom                     = $this->input->post('docnom');
        $docdsc                     = $this->input->post('docdsc');
        $docfec                     = $this->input->post('docfec');
        $docpath                    = $this->input->post('docpath');
        $doctip                     = 1;//empresa
        $docid                      = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('documento');
        $this->carga_archivo($negid);
        $this->MY_Documento->insert_documento($docid, $negid, $docnom, $docdsc, $docfec, $_SESSION['file_name'],$doctip);
        $docid                      = $docid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('documento', $docid);
        $this->session->set_flashdata('success', 'Se Agrego con Exito');
        //$this->index();
        redirect(base_url() . 'documento/index/'.$negid);
        //$this->index($negid);
    }

    public function abrir($docid)
    {
        $documento_seleccionado = $this->MY_Documento->get_all_by_docid($docid);

        foreach ($documento_seleccionado as $item) {
            $absolute_path          = 'media/files/'.$item->negid.'/';
            $absolute_path      = $absolute_path . rtrim($item->docpath, '/');
            $file_name          = trim($item->docpath);
        }
        if (is_file(trim($absolute_path))) {
            $mime = 'application/force-download';
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Transfer-Encoding: binary');
            header('Connection: close');
            readfile(base_url() . $absolute_path);
            exit();
        }
    }

    public function carga_archivo($negid) {

        if (!file_exists('media/files/'.$negid)){
            if (!is_dir($negid)) {
                mkdir('./media/files/'. $negid, 0777, TRUE);
            }
        }

        $config['upload_path']   =  './media/files/'.$negid.'/';
        //$config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xls|xml|txt|csv|xlsx|*';
        $config['allowed_types'] = '*';
        $config['max_size']      = 9999999;
        $config['max_width']     = 3000;
        $config['max_height']    = 3000;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('docpath')) {
            //$error = array('error' => $this->upload->display_errors());
            //print_r($error);
            //echo 'Error';
        }
        else {
            $archivo = array('upload_data' => $this->upload->data());
            foreach ($archivo as $item){
                $_SESSION['file_name'] = $item['file_name'];
            }
        }
        return;
    }

    public function delete($docid)
    {
        $negid          = $this->MY_Documento->get_negid_by_docid($docid);
        $documento_seleccionado = $this->MY_Documento->get_all_by_docid($docid);
        $absolute_path          ="";
        //$negid = "";
        foreach ($documento_seleccionado as $item) {
           // $negid = $item->negid;
            $absolute_path      = 'media/files/'.$item->negid.'/';
            $absolute_path      = $absolute_path . rtrim($item->docpath, '/');
            //$file_name          = trim($item->docpat);
        }

        /* if (file_exists($absolute_path)){
            unlink(base_url().$absolute_path);
        } */
        $this->MY_Documento->delete_documento($docid);        
        echo json_encode(array('success' => 1, 'negid'=>$negid ));
    }

    public function borrar($docid)
    {
        $this->session->set_flashdata('delete', $docid);
        $negid = $this->MY_Documento->get_negid_by_docid($docid);
        redirect(base_url() . 'documento/index/'.$negid);
    }
}