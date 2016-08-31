<?php
/*
 * ***************************************************************
 * Script : 
 * Version : 
 * Date :
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */
 
/**
 * Description of Test
 *
 * @author adi
 */
class Flight extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        echo "<h1>Module Test</h1>";
        echo "<p>Modul ini adalah modul HMVC pertama saya</p>";
        echo "<p>Tanpa menggunakan view dan model</p>";
        echo "<p>Lokasi di application/modules/test/controlers/Test.php</p>";
    }
}

?>