<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 28/8/2020
 * Time: 10:01
 */

class Sendmail
{
   // protected $_ci;

    function __construct(){
        $this->_ci=&get_instance();
        $this->_ci->load->library('PHPMailer');
        $this->_ci->load->library('SMTP');
    }

    public function send($list=null, $negnom=null, $docnom=null, $docfecchk=null)
    {
        /* $mail = new PHPMailer();
        //permite modo debug para ver mensajes de las cosas que van ocurriendo
        $mail->SMTPDebug = 0;
        //Debo de hacer autenticación SMTP
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAutoTLS = false;
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        //indico a la clase que use SMTP
        $mail->IsSMTP();
        $mail->Host = 'smtp.office365.com';
        //indico el puerto que usa
        $mail->Port = 587;
        //indico un usuario / clave de un usuario de mail
        $mail->Username = 'comexonline@bbe-sa.com.ar';
        $mail->Password = 'Hug.2022*';
        $mail->SetFrom('comexonline@bbe-sa.com.ar', 'Comex OnLine');        
        $mail->Subject = 'Negocio '. $negnom . ' Verificado';
        $mail->MsgHTML('El Documento ' . $docnom . ', fue verificado el dia: ' . $docfecchk);
        foreach ($list as $item){            
            $address = $item -> usumai;
            $name = $item -> usunom . $item ->usuape;
            $mail->AddAddress(trim($address), trim($name));
        }
        $mail->Send(); */
              

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        //$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        $mail->Host =  'smtp.office365.com';//outlook server         
        $mail->SMTPAuth = true;
        //to view proper logging details for success and error messages
        $mail->SMTPDebug = 0;
        //$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        $mail->Host =  'smtp.office365.com';//outlook server            
        $mail->Username = 'comexonline@bbe-sa.com.ar';   //email        
        $mail->Password = 'Hug.2022*' ;   //16 character obtained from app password created
        //$mail->Port = 465;                    //SMTP port
        $mail->Port = 587;                    //SMTP port
        //$mail->SMTPSecure = 'ssl';
        $mail->SMTPSecure = 'tls';
        //sender information
        $mail->setFrom('comexonline@bbe-sa.com.ar', 'Comex OnLine');
        $mail->Subject = 'Negocio '. $negnom . ' Verificado';
        $mail->MsgHTML('El Documento ' . $docnom . ', fue verificado el dia: ' . $docfecchk);
        foreach ($list as $item){            
            $address = $item -> usumai;            
            $name = $item -> usunom . $item ->usuape;
            $mail->AddAddress(trim($address), trim($name));
        }
        $mail->Send();
        /* if (!$mail->send()) {
            echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        } */
        $mail->smtpClose();
        //return;
    }
}