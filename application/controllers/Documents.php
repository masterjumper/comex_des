<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller
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
        $this->load->model('MY_Documents');
        $this->load->model('MY_Business');
        $this->load->model('MY_Usuario');
        $this->load->library('encryption');
        $this->load->library('sendmail');        
    }

    public function index($negid)
    {        
        $negid_decrypt                      = $this->encryption->decrypt(base64_decode($negid));
        if($this->session->userdata('usuid')){
            $negocio = base64_encode($this->encryption->encrypt($negid_decrypt));
            //$config["base_url"]         = base_url() . "documents/index/".$negid_decrypt;
            $config["base_url"]         = base_url() . "documents/index/".$negocio;
            $config["total_rows"]       = $this->MY_Documents->record_count($negid_decrypt);
            $config["per_page"]         = 7;
            $config["uri_segment"]      = 4;
            $config['num_links']        = 20;
            $config['num_tag_open']     = '&nbsp';
            $config['num_tag_close']    = '&nbsp';
            $config['next_tag_open']    = '&nbsp';
            $config['next_link']        = 'Siguiente';
            $config['next_tag_close']   = '&nbsp';
            $config['prev_tag_open']    = '&nbsp';
            $config['prev_link']        = 'Anterior';
            $config['prev_tag_close']   = '&nbsp';
            $this->pagination->initialize($config);
            if($this->uri->segment(4)){
                $page = ($this->uri->segment(4)) ;
            }
            else{
                $page = 0;
            }
            $documents                  = $this->MY_Documents->get_all_documento_pag($negid_decrypt, $config["per_page"], $page);
            $documents_news = array();

            foreach ($documents as $item){
                $document =array(
                    'docnom' =>$item->docnom,
                    'docdsc'=> $item->docdsc,
                    'docfec' =>$item->docfec,
                    'docchk' =>$item->docchk,
                    'docid' =>base64_encode($this->encryption->encrypt($item->docid))
                );
                array_push($documents_news, $document);
            }
            $data['documents']                  = $documents_news;
            $contenido 	                        = 'documents/grilla_documents.php';
            $data["links"]                      = $this->pagination->create_links();
            $negnom                             = $this->MY_Business->get_negnom_by_negid ($negid_decrypt);
            $data['title']                      = '<i class="fa fa-tasks"></i> Business '. $negnom .' - <i class="fa fa-book"></i> Documents/Files';
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
            $negid_decrypt              = $this->encryption->decrypt(base64_decode($negid));
            $config["base_url"]         = base_url() . "documents/index/".$negid_decrypt;
            $config["total_rows"]       = $this->MY_Documents->record_count($negid_decrypt);
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
            $filtro_codigo                      = $this->input->post('filtro_codigo');
            $filtro_nombre                      = $this->input->post('filtro_nombre');
            $documents                          = $this->MY_Documents->get_documento_filtro ($filtro_codigo, $filtro_nombre, $config["per_page"], $page);
            $documents_news = array();

            foreach ($documents as $item){
                $document =array(
                    'docnom' =>$item->docnom,
                    'docdsc'=> $item->docdsc,
                    'docfec' =>$item->docfec,
                    'docchk' =>$item->docchk,
                    'docid' =>base64_encode($this->encryption->encrypt($item->docid))
                );
                array_push($documents_news, $document);
            }

            //print_r($datos_nuevos);
            $data['documents'] = $documents_news;
            $contenido         = 'documents/grilla_documents.php';
            $data["links"]     = $this->pagination->create_links();
            $template          = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);
        }else{
            redirect('/');
        }

    }
    
    public function open($docid)
    {
        $docid_decode =$this->encryption->decrypt(base64_decode($docid));
        $documento_seleccionado = $this->MY_Documents->get_all_by_docid($docid_decode);

        foreach ($documento_seleccionado as $item) {
            $absolute_path      = 'media/files/'.$item->negid.'/';
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

    public function upload_file($negid) {
        $negid_decrypt = $this->encryption->decrypt(base64_decode($negid));
        if (!file_exists('media/files/'.$negid_decrypt)){
            if (!is_dir($negid)) {
                mkdir('./media/files/'. $negid_decrypt, 0777, TRUE);
            }
        }
        $config['upload_path']   =  './media/files/'.$negid_decrypt.'/';
        $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xls|xml|txt|csv|xlsx';
        //$config['allowed_types'] = '*';
        $config['max_size']      = 9999999;
        $config['max_width']     = 3000;
        $config['max_height']    = 3000;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('docpath')) {
            $event = array('error' => $this->upload->display_errors());
        }
        else {
            $archivo = array('upload_data' => $this->upload->data());
            foreach ($archivo as $item){
                $_SESSION['file_name'] = $item['file_name'];
            }
            $event = $archivo;
        }
        return $event;
    }

    public function PrepaymentSwift($negid) {

        $negid_decrypt              = $this->encryption->decrypt(base64_decode($negid));
        $negnom                     = $this->MY_Business->get_negnom_by_negid ($negid_decrypt);
        //$data['title']              = 'Business '. $negnom .' - Prepayment Swift';
        $data['title']              = '<i class="fa fa-tasks"></i> Business '. $negnom .' - <span class="glyphicon glyphicon-list-alt" data-toggle="Upload" data-placement="top" title="Upload"></span> Prepayment Swift';
        $data['negid']              = $negid;
        $data['customer_type_file'] = 'prepaymentswift';
        $contenido                  = 'documents/documents_new.php';
        $template                   = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function BalancePaymentSwift($negid) {
        $negid_decrypt              = $this->encryption->decrypt(base64_decode($negid));
        $negnom                     = $this->MY_Business->get_negnom_by_negid ($negid_decrypt);
        $data['title']              = 'Business '. $negnom .' - Balance Payment Swift';
        $data['title']              = '<i class="fa fa-tasks"></i> Business '. $negnom .' - <span class="glyphicon glyphicon-folder-close" data-toggle="Upload" data-placement="top" title="Upload"></span> Balance Payment Swift';
        $data['negid']              = $negid;
        $data['customer_type_file'] = 'balancepaymentswift';
        $contenido                  = 'documents/documents_new.php';
        $template                   = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function ShippingIntructions($negid) {
        $negid_decrypt              = $this->encryption->decrypt(base64_decode($negid));
        $negnom                     = $this->MY_Business->get_negnom_by_negid ($negid_decrypt);
        //$data['title']              = 'Business '. $negnom .' - Shipping Intructions';
        $data['title']              = '<i class="fa fa-tasks"></i> Business '. $negnom .' - <span class="glyphicon glyphicon-plane" data-toggle="Upload" data-placement="top" title="Upload"></span> Shipping Intructions';
        $data['negid']              = $negid;
        $data['customer_type_file'] = 'shippingintructions';
        $contenido                  = 'documents/documents_new.php';
        $template                   = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new($negid) {
        $negid_decrypt              = $this->encryption->decrypt(base64_decode($negid));
        $_SESSION['file_name']      = "";
        $docpath                    = $this->input->post('docpath');
        $customer_type_file         = $this->input->post('customer_type_file');
        $docid                      = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('documento');
        $doctip                     = 2;//customer
        $docfec = date_format(new DateTime('now'),"Y-m-d");

        $event = $this->upload_file($negid);

        foreach ($event as $item){
            $verification =  $item;
        }

        if(is_array($verification)){
            if($customer_type_file === 'prepaymentswift'){
                $docnom = 'Prepayment';
                $docdsc = 'Prepayment Swift';
            }
            if($customer_type_file === 'balancepaymentswift'){
                $docnom = 'Balance Payment';
                $docdsc = 'Balance Payment Swift';
            }
            if($customer_type_file === 'shippingintructions'){
                $docnom = 'Shipping Intructions';
                $docdsc = 'Shipping Intructions';
            }
            $this->MY_Documents->insert_document($docid, $negid_decrypt, $docnom, $docdsc, $docfec, $_SESSION['file_name'], $doctip);
            $docid = $docid + 1;
            $this->MY_Ultimos_Numeros->update_Ultimo_Numero('documento', $docid);

            //$data['message'] = 'Upload Success!';
            //$data['title'] = ' ';
            $negid = base64_encode($this->encryption->encrypt($negid_decrypt));
            //$data['return_to'] = base_url() . 'business/index/'.$negid;
            
            //$contenido                  = 'message/message.php';
            //$template                   = $_SESSION['grutem'];
            
            $this->session->set_flashdata('success', 'File Saved!');
            redirect(base_url() . 'business/index/'.$negid);
            //$this->$template-> display($contenido, $data);

        }else{
            //$data['message'] = $verification;
            //$data['title'] = 'Error';
            $negid = base64_encode($this->encryption->encrypt($negid_decrypt));
            $data['return_to'] = base_url() . 'business/index/'.$negid;
            //$contenido                  = 'message/message.php';
            //$template                   = $_SESSION['grutem'];
            //$this->$template-> display($contenido, $data);
            $this->session->set_flashdata('error', 'File Not Saved!');
            redirect(base_url() . 'business/index/'.$negid);
        }

    }

    public function agree($docid) {      
        
        $docid_decrypt  = $this->encryption->decrypt(base64_decode($docid));
        $this->MY_Documents->set_document_check ($docid_decrypt);
        $negid          = $this->MY_Documents->get_negid_by_docid($docid_decrypt);
        $listamails     = $this->MY_Usuario->get_usu_mai_habilitado();
        $negnom         = $this->MY_Business->get_negnom($negid);
        $docfecchk      = $this->MY_Documents->get_document_check($docid_decrypt);
        $docnom         = $this->MY_Documents->get_document_docnom($docid_decrypt);

        $this->sendmail->send($listamails, $negnom, $docnom, $docfecchk);
        
        $negid_encode  = base64_encode($this->encryption->encrypt($negid));
        $this->session->set_flashdata('success', 'Registration Successful');
        redirect(base_url().'Documents/index/'.$negid_encode);
    }
}