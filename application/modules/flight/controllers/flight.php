<?php

 
/**
 * Description of Test
 *
 * @author Riansyah Rafsanjani
 */
class Flight extends MY_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('curl'); 
    }
    
    public function index() {
        
        $this->middle = 'main_flight'; 
        $this->layout();
    
    }

    public function search()
    {
        $this->middle = 'flight_list'; 
        $this->layout(); 
    }

    public function order()
    {
        $this->middle = 'flight_order'; 
        $this->layout(); 
    }

     public function payment()
    {
        $this->middle = 'flight_payment'; 
        $this->layout(); 
    }

     public function order_information()
    {
        $this->middle = 'flight_order_information'; 
        $this->layout(); 
    }

    public function get_flight()
    {
        $url = "http://api-sandbox.tiket.com/search/flight";
        $param = array(
            'd'=>'CGK',
            'a'=>'DPS',
            'date'=>'2016-09-25',
            'ret_date'=>'2016-09-30',
            'adult'=>1,
            'child'=>0,
            'infant'=>0,
            'token'=>'75f0e15a436644ffd9a226553214cd5236078b26',
            'v'=>3,
            'output'=>'xml');
        echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
       $result = $this->curl->_simple_call('get',$url,$param);
     //var_dump($result);
        echo "<pre>",print_r($result),"</pre>";die();
    }

}

?>