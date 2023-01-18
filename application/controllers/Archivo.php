<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivo extends CI_Controller
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
        $this->load->model('MY_Claim');
        $this->load->model('MY_Seguridad');
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->library('Templateuser');
        $this->load->library('templatesuperusuario');
        $this->load->library('session');
        $this->load->helper(array('url', 'html', 'form', 'file', 'download', 'path'));
    }

    public function documentacion($claid)
    {
            $data['claid']	    = $claid;            
            $data['titulo']     = 'Claim #'. $this->MY_Claim->get_claim_clanum($claid) .  '- Documentation';                    
            $data['archivos']   = $this -> MY_Claim ->get_Claim_archivo_all($claid);
            $contenido 	        = 'archivo/grilla_archivo.php';
            $template           = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);            
        }

    public function new_archivo($claid)
    {        
        $data['claid']	= $claid;
        $clanum         = $this->MY_Claim->get_claim_clanum($claid);        
        $data['titulo'] = 'Claim #'. $this->MY_Claim->get_claim_clanum($claid) .  '- Document'; 
        $contenido 	    = 'archivo/new_archivo.php';
        $template       = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }  
    
    public function carga_archivo($claid) {
        $file_name = "";    
        if (!file_exists('media/claims/'.$claid)){
            if (!is_dir($claid)) {
                mkdir('./media/claims/'. $claid, 0777, TRUE);
            }
        }
        $config['upload_path']   =  './media/claims/'.$claid.'/';
        //$config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xls|xml|txt|csv|xlsx|*';
        $config['allowed_types'] = '*';
        $config['max_size']      = 9999999;
        $config['max_width']     = 3000;
        $config['max_height']    = 3000;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('arcpat')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            //echo 'Error';
        }
        else {
            $archivo = array('upload_data' => $this->upload->data());
            foreach ($archivo as $item){
                $file_name = $item['file_name'];
            }
        }
        return $file_name;
    }

    public function save_new($claid)
    {        
        $arcid  = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('archivo');                
        $archivo = $this->carga_archivo($claid);
        $this->MY_Claim->new_claim_archivo($claid, $arcid, $archivo);        
        $arcid  = $arcid + 1 ;        
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('archivo', $arcid);
        $this->documentacion($claid);
        redirect(base_url().'Archivo/documentacion/'.$claid);
    }

    public function delete($claid, $arcid)
    {
        $arcpat = $this->MY_Claim->get_claim_archivo_arcpat($claid, $arcid);
        $this -> MY_Claim ->delete_claim_archivo($arcid);        
        $absolute_path          = 'media/claims/'.$claid.'/'.trim($arcpat);        
        unlink($absolute_path);
        redirect(base_url().'Archivo/documentacion/'.$claid);
    }

/*
    public function update($gruid)
    {
        $data['titulo']				 		= 'Claims';
        $data['Claims']                      = $this->MY_Claim->get_Claims($gruid);
        $contenido 	                        = 'Claims/Claims.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new()
    {
        /*
        Claref->referencia	
        Calinv->factura
        Clacon->container
        Claves->puerto
        Claamo->monto en USD
        Clacom->comentario
        Empid->empresa
        Claest->estado
        */
        /*
        $claid          = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('claim');
        $clanum         = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('claimnumber');

        $Claref         = $this->input->post('claref');
        $Clainv         = $this->input->post('clainv');
        $Clacon         = $this->input->post('clacon');
        $Claves         = $this->input->post('claves');
        $Claamo         = $this->input->post('claamo');
        $Clacom         = $this->input->post('clacom');

        //$data['Claims']  = 
        $this->MY_Claim->new_claim($claid, $Claref, $Clainv, $Clacon,$Claves,$Claamo,$Clacom, $clanum);
        $claid_new      = $claid + 1 ;        
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('claim', $claid_new);
        $clanum         = $clanum + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('claimnumber', $clanum);

        $this->index($claid);
    }
    
    public function save()
    {
        $gruid          = $this->input->post('gruid');
        $grudsc         = $this->input->post('grudsc');
        $grutem         = $this->input->post('grutem');
        $data['Claims']  = $this -> MY_Claim ->set_Claims($gruid, $grudsc, $grutem );
        $this->index($claid);
    }

    public function delete($gruid)
    {
        $data['Claims']  = $this -> MY_Claim ->delete_Claims($gruid);
        $this->index($claid);
    }

    public function documentacion($claid)
    {
        $data['Documentacion']  = $this -> MY_Claim ->get_Claim_archivo_all($claid);
        $this->index($claid);
    }
*/
}