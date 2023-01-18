<?php
/**
 * Created by PhpStorm.
 * User: smuguerza
 * Date: 31/01/2017
 * Time: 01:46 PM
 */
Class MY_Claim extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all ()
    {
        $this -> db -> select('*');
        $this -> db -> from('claim');
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_claim ($claid)
    {
        $this -> db -> select('*');
        $this -> db -> from('claim');
        $this -> db -> where('claid', $claid);
        //$this -> db -> limit(1);
        $query = $this -> db ->get() -> result();
        return $query;
    }

    public function get_claim_clanum ($claid)
    {
        $this -> db -> select('clanum');
        $this -> db -> from('claim');
        $this -> db -> where('claid', $claid);                
        $query = $this -> db ->get() -> row('clanum');
        return $query;
//        echo $this -> db ->last_query();        
    }

    public function new_claim($claid, $claref, $clainv, $clacon,$claves,$claamo,$clacom, $clanum)
    {
        $data = array(
            'claid' =>$claid,            
            'claref'=>$claref,
            'clainv'=>$clainv,	
            'clacon'=>$clacon,	
            'claves'=>$claves,	
            'claamo'=>$claamo,	
            'clacom'=>$clacom,
            'clafec'=>date("Y-m-d"),            
            'clanum'=>$clanum,
            'claest'=>1 //en proceso            
        );
        $this -> db -> insert('claim', $data);
    }

    public function set_claim($claid, $claref, $clainv, $clacon, $claves, $claamo, $clacom)
    {

        $data = array(
            'claref'=>$claref,
            'clainv'=>$clainv,	
            'clacon'=>$clacon,	
            'claves'=>$claves,	
            'claamo'=>$claamo,	
            'clacom'=>$clacom            
        );
        $this -> db -> where('claid', $claid);
        $this -> db -> update('claim', $data);
    }

    public function delete_claim ($claid)
    {
        $this->db->where('claid', $claid);
        $this->db->delete('claim');

    }
    
    public function get_Claim_archivo_all ($claid){
        $this -> db -> select('*');
        $this -> db -> from('archivo');
        $this -> db -> where('claid', $claid);        
        $query = $this -> db ->get() -> result();
        return $query;
    }

/*-----------------------Archivo---------------------------------*/
    public function new_claim_archivo ($claid, $arcid, $arcpat){
        $data = array(
            'arcid' => $arcid,            
            'arcfec'=> date("Y-m-d"),
            'arcpat'=> $arcpat,
            'claid' => $claid            
        );        
        $this -> db -> insert('archivo', $data);
    }
        
    public function delete_claim_archivo ($arcid){    
        $this -> db -> where('arcid', $arcid);
        $this -> db -> delete('archivo');
    }

    public function get_claim_archivo_arcpat ($claid, $arcid){
        $this -> db -> select('arcpat');
        $this -> db -> from('archivo');
        $this -> db -> where('claid', $claid);        
        $this -> db -> where('arcid', $arcid);        
        $query = $this -> db ->get() -> row('arcpat');
        return $query;
    }

}