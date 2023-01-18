<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claim extends CI_Controller
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
    }

    public function index()
    {
            $data['titulo']				 		= 'Claims';
            $data['claims']                     = $this -> MY_Claim ->get_all();
            $contenido 	                        = 'claims/grilla_claims.php';
            $template                           = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);
        }

    public function update($claid)
    {
        $data['titulo']				 		= 'Claims';
        $data['Claim']                      = $this->MY_Claim->get_Claim($claid);
        $contenido 	                        = 'claim/claim.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function new_claim()

    {
        $data['titulo']				 		= 'Claim';
        $contenido 	                        = 'claims/new_claim.php';
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
        $claid          = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('claim');
        $clanum         = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('claimnumber');

        $Claref         = $this->input->post('claref');
        $Clainv         = $this->input->post('clainv');
        $Clacon         = $this->input->post('clacon');
        $Claves         = $this->input->post('claves');
        $Claamo         = $this->input->post('claamo');
        $Clacom         = $this->input->post('clacom');
        
        $this->MY_Claim->new_claim($claid, $Claref, $Clainv, $Clacon,$Claves,$Claamo,$Clacom, $clanum);
        $claid          = $claid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('claim', $claid);
        $clanum         = $clanum + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('claimnumber', $clanum);

        $this->index();
    }
    
    public function save()
    {
        $gruid          = $this->input->post('gruid');
        $grudsc         = $this->input->post('grudsc');
        $grutem         = $this->input->post('grutem');
        $data['Claims']  = $this -> MY_Claim ->set_Claims($gruid, $grudsc, $grutem );
        $this->index();
    }

    public function delete($gruid)
    {
        $data['Claims']  = $this -> MY_Claim ->delete_Claims($gruid);
        $this->index();
    } 

}