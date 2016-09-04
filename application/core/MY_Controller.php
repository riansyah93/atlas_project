<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller 
 { 
   //set the class variable.
   var $template  = array();
   var $data      = array();
   //Load layout    
   public function layout($data2 = null) {
     // making temlate and send data to view.
     $this->template['header']   = $this->load->view('partial/header', $this->data, true);
     $this->template['middle'] = $this->load->view($this->middle, $data2, true);
     $this->template['footer'] = $this->load->view('partial/footer', $this->data, true);
     $this->load->view('layouts/layout', $this->template);
   }
}