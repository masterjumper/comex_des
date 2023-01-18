<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('MY_Ultimos_Numeros');
        //$this->load->model('MY_Cliente');
        //$this->load->model('MY_Grupo');
        //$this->load->model('MY_Empresa');
        $this->load->library('encryption');
    }
    public function index()
    {
        $data['titulo']                     = 'Customer Satisfaction Measurement';
        $contenido                          = 'encuesta/encuesta.php';
        $template                           = $_SESSION['grutem'];
        $this->$template-> display($contenido, $data);
    }
    
}
