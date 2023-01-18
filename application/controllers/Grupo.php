<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo extends CI_Controller
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
        $this->load->model('MY_Grupo');
        $this->load->model('MY_Seguridad');
        $this->load->model('MY_Ultimos_Numeros');
        $this->load->library('Templateuser');
        $this->load->library('templatesuperusuario');
        $this->load->library('session');
    }

    public function index()
    {
            $data['titulo']				 		= 'Grupo';
            $data['grupos']                     = $this -> MY_Grupo ->get_all();
            $contenido 	                        = 'grupo/grilla_grupo.php';
            $template                           = $_SESSION['grutem'];
            $this->$template-> display($contenido, $data);
        }

    public function update($gruid)
    {
        $data['titulo']				 		= 'Grupo';
        $data['grupo']                      = $this->MY_Grupo->get_grupo($gruid);
        $contenido 	                        = 'grupo/grupo.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function new_grupo()

    {
        $data['titulo']				 		= 'Grupo';
        $contenido 	                        = 'grupo/new_grupo.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }

    public function save_new()
    {
        $gruid          = $this->MY_Ultimos_Numeros->get_Ultimo_Numero('grupo');
        $grudsc         = $this->input->post('grudsc');
        $grutem         = $this->input->post('grutem');
        $data['grupo']  = $this->MY_Grupo->new_grupo($gruid, $grudsc, $grutem);
        $gruid          = $gruid + 1;
        $this->MY_Ultimos_Numeros->update_Ultimo_Numero('grupo', $gruid);
        $this->index();
    }
    
    public function save()
    {
        $gruid          = $this->input->post('gruid');
        $grudsc         = $this->input->post('grudsc');
        $grutem         = $this->input->post('grutem');
        $data['grupo']  = $this -> MY_Grupo ->set_grupo($gruid, $grudsc, $grutem );
        $this->index();
    }

    public function delete($gruid)
    {
        $data['grupo']  = $this -> MY_Grupo ->delete_grupo($gruid);
        $this->index();
    }

}