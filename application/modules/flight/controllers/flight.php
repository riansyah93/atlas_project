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
        $this->load->model('flight_model'); 
    }
    
    public function index() {
        
        $this->middle = 'main_flight'; 
        $this->layout();
    
    }

    public function search()
    {   
                $this->middle = 'flight_list'; 
        $this->layout($data); 
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
        if($this->input->get())
        {
            $post = $this->input->get();
            $post['start_date'] = date('Y-m-d',strtotime($post['start_date']));
            if ($post['end_date'] != "-") {
               $post['end_date'] = date('Y-m-d',strtotime($post['end_date']));
            }else
            {
                $post['end_date'] = "-";
            }
            //echo "<pre>",print_r($post),"</pre>";
            
             
        }
        else
        {
            $post = array(
                'depart' => 'CGK',
                'arrival' => 'DPS',
                'adult' => 1,
                'child' => 0,
                'infant' => 0,
                'start_date' => date('Y-m-d',strtotime('+4 day')),
                'end_date' => "-"
                );
        }
        


        $url = "http://api-sandbox.tiket.com/search/flight";
        $param = array(
            'd'=>$post['depart'],
            'a'=>$post['arrival'],
            'date'=>$post['start_date'],
            'adult'=>$post['adult'],
            'child'=>$post['child'],
            'infant'=>$post['infant'],
            'token'=>'75f0e15a436644ffd9a226553214cd5236078b26',
            'v'=>3,
            'output'=>'xml');
        if ($post['end_date'] != "-") {
            $param['ret_date'] = $post['end_date'];
        }

       // echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
        $result = $this->curl->_simple_call('get',$url,$param);
        $xml = simplexml_load_string($result);
        if($xml->departures)
        {
            $data['list'] = $xml->departures;    
        }else
        {
            $data['list'] = " ";
        }
        
        $data['airport'] = $this->flight_model->get_airport_list();
        $data['post'] = $post;
       // echo "<pre>",print_r($data['list']),"</pre>";
        $this->middle = 'flight_list'; 
        $this->layout($data);


        // foreach($xml->departures->result as $temp)
        // {
        //     echo $temp->airlines_name;
        //     echo "<br>";
        // }
        // die();
     //var_dump($result);
            // header('Content-type:text/xml') ;
            // echo $result;exit;
        
    }

    function get_flight_data ()
    {
        $url = "http://api-sandbox.tiket.com/flight_api/get_flight_data";
        
        if($this->input->post())
        {   
            $post = $this->input->post();
            //echo "<pre>",print_r($this->input->post()),"</pre>";die();   
        }else
        {
            redirect('flight/get_flight');
        }


        $param = array(
            'flight_id'=> $post['flight_id'],
            'date'=>$post['start_date'],
            'token'=>'75f0e15a436644ffd9a226553214cd5236078b26',
            'output' => 'xml'
            );

        echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
       // die();

        $result = $this->curl->_simple_call('get',$url,$param);
        $xml = simplexml_load_string($result);
               
        //echo "<pre>",print_r($xml),"</pre>";die();
        $data['list'] = $xml->departures;
      
        $this->middle = 'flight_order'; 
        $this->layout($data);
    }

     function add_order()
    {
        if($this->input->post())
        {
            $post = $this->input->post();

           // echo "<pre>",print_r($post),"</pre>";die(); 
            foreach ($post as $key => $temp) {
                echo $temp."---".$key;
                echo "<br>";
            }
        die();
        }


        $url = "https://api-sandbox.tiket.com/order/add/flight";
        
        $param = array(
            'token'=>'75f0e15a436644ffd9a226553214cd5236078b26',
            'flight_id'=>'2427405',
            'child'=>'1',
            'adult'=>'0',
            'infant'=>'0',
            'conSalutation'=>'Mrs',
            'conFirstName'=>'budianto',
            'conLastName'=>'wijaya',
            'conPhone'=>'%2B6287880182218',
            'conEmailAddress'=>'riansyah.rafsanjani@binus.ac.id',
            'firstnamea1'=>'susi',
            'lastnamea1'=>'wijaya',
            'ida1'=>'1116057107900001',
            'titlea1'=>'Mr',
            'conOtherPhone'=>'%2B628521342534',
            // 'titlec1'=>'Ms',
            // 'firstnamec1'=>'carreen',
            // 'lastnamec1'=>'athalia',
            // 'birthdatec1'=>'2005-02-02',
            // 'titlei1'=>'Mr',
            // 'parenti1'=>'1',
            // 'firstnamei1'=>'wendy',
            // 'lastnamei1'=>'suprato',
            // 'birthdatei1'=>'2011-06-29',
            'output'=>'xml'
            );
        // echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
       // die();

        //$result = $this->curl->_simple_call('get',$url,$param);
        $result = '<tiket><diagnostic><status>200</status><elapsetime>15.1820</elapsetime><memoryusage>7.75MB</memoryusage><unix_timestamp>1472884676</unix_timestamp><confirm>success</confirm><lang>id</lang><currency>IDR</currency></diagnostic><output_type>xml</output_type><myorder><order_id>22390519</order_id><data><expire>27</expire><uri>sriwijaya</uri><order_detail_id>12755897</order_detail_id><order_expire_datetime>2016-09-03 13:50:04</order_expire_datetime><order_type>flight</order_type><customer_price>659000.00</customer_price><order_name>CGK (Jakarta - Cengkareng) - DPS (Denpasar, Bali)</order_name><order_name_detail>Sriwijaya (SJ-272 - Depart)</order_name_detail><order_detail_status>active</order_detail_status><detail><order_detail_id>12755897</order_detail_id><airlines_name>Sriwijaya</airlines_name><flight_number>SJ-272</flight_number><price_adult>659000.00</price_adult><price_child>0.00</price_child><price_infant>0.00</price_infant><flight_date>25 Sep 2016</flight_date><departure_time>05:45</departure_time><arrival_time>08:35</arrival_time><baggage_fee>0</baggage_fee><departure_airport_name>Soekarno Hatta</departure_airport_name><arrival_airport_name>Ngurah Rai</arrival_airport_name><passengers><adult><order_passenger_id>5381879</order_passenger_id><order_detail_id>12755897</order_detail_id><type>adult</type><first_name>susi</first_name><last_name>wijaya</last_name><title>Mr</title><id_number>1116057107900001</id_number><birth_date/><adult_index/><passport_no/><passport_expiry/><passport_issuing_country/><passport_nationality/><check_in_baggage>20</check_in_baggage><check_in_baggage_return/><check_in_baggage_size>20</check_in_baggage_size><check_in_baggage_size_return/><passport_issued_date/><birth_country/><ticket_number/><phone/></adult></passengers><real_flight_date>2016-09-25</real_flight_date><price>659000</price><breakdown_price><category>price adult</category><type>none</type><value>659000</value><currency>IDR</currency><text>Harga Dewasa</text></breakdown_price><breakdown_price><category>total base price</category><type>price</type><value>659000</value><currency>IDR</currency><text>Harga Total</text></breakdown_price><breakdown_price><category>baggage fee</category><type>add</type><value>0</value><currency>IDR</currency><text>Biaya Bagasi</text></breakdown_price><departure_city>CGK</departure_city><arrival_city>DPS</arrival_city></detail><order_photo>https://api-sandbox.tiket.com/images/icon_sriwijaya.jpg</order_photo><order_icon>h3b</order_icon><tax_and_charge>16240.00</tax_and_charge><subtotal_and_charge>675240.00</subtotal_and_charge><delete_uri>https://api-sandbox.tiket.com/order/delete_order?order_detail_id=12755897</delete_uri><business_id>20863</business_id></data><total>675240</total><total_tax>16240</total_tax><total_without_tax>659000</total_without_tax><count_installment>0</count_installment><discount>Dapatkan potongan hingga IDR 16.240,00 saat anda checkout . Tidak berlaku untuk Kartu Kredit.</discount><discount_amount>16240.00</discount_amount></myorder><checkout>https://api-sandbox.tiket.com/order/checkout/22390519/IDR</checkout><login_status>false</login_status><token>75f0e15a436644ffd9a226553214cd5236078b26</token></tiket>';
        $xml = simplexml_load_string($result);
        
        // header('Content-disposition: attachment; filename=order_information.xml');
        // header('Content-type:text/xml') ;
        // echo $xml;exit;

        echo "<pre>",print_r($xml),"</pre>";die();
        $data['my_order'] = $xml->myorder;
        $data['checkout'] = $xml->checkout;
        
        $this->middle = 'flight_order_information'; 
        $this->layout($data);
    }

    function get_all_airport()
    {
       //  $url = "https://api-sandbox.tiket.com/flight_api/all_airport";
        
       //  $param = array(
       //      'token'=>'75f0e15a436644ffd9a226553214cd5236078b26',
       //      'output' => 'xml'
       //      );

       //   echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
       // // die();

       //  $result = $this->curl->_simple_call('get',$url,$param);

        $result = "<tiket>
<diagnostic>
<status>200</status>
<elapsetime>0.1182</elapsetime>
<memoryusage>6.67MB</memoryusage>
<unix_timestamp>1472888117</unix_timestamp>
<confirm>success</confirm>
<lang>id</lang>
<currency>IDR</currency>
</diagnostic>
<output_type>xml</output_type>
<all_airport>
<airport>
<airport_name>Pattimura</airport_name>
<airport_code>AMQ</airport_code>
<location_name>Ambon</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>ATAMBUA</airport_name>
<airport_code>ABU</airport_code>
<location_name>Atambua</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Soa</airport_name>
<airport_code>BJW</airport_code>
<location_name>Bajawa</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sepinggan</airport_name>
<airport_code>BPN</airport_code>
<location_name>BalikPapan</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sultan Iskandar Muda</airport_name>
<airport_code>BTJ</airport_code>
<location_name>Banda Aceh</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Husein Sastranegara</airport_name>
<airport_code>BDO</airport_code>
<location_name>Bandung</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>SYAMSUDDIN NOOR</airport_name>
<airport_code>BDJ</airport_code>
<location_name>Banjarmasin</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>BLIMBINGSARI</airport_name>
<airport_code>DQJ</airport_code>
<location_name>Banyuwangi - BLIMBINGSARI</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Hang Nadim</airport_name>
<airport_code>BTH</airport_code>
<location_name>Batam</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Baubau</airport_name>
<airport_code>BUW</airport_code>
<location_name>Baubau</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Fatmawati Soekarno</airport_name>
<airport_code>BKS</airport_code>
<location_name>Bengkulu</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Kalimarau</airport_name>
<airport_code>BEJ</airport_code>
<location_name>Berau</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Frans Kaisiepo</airport_name>
<airport_code>BIK</airport_code>
<location_name>Biak</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Muhammad Salahuddin</airport_name>
<airport_code>BMU</airport_code>
<location_name>Bima</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>BLIMBINGSARI</airport_name>
<airport_code>BWX</airport_code>
<location_name>BLIMBINGSARI</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Buli</airport_name>
<airport_code>WUB</airport_code>
<location_name>Buli</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Pogugol</airport_name>
<airport_code>UOL</airport_code>
<location_name>Buol</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>NGURAH RAI</airport_name>
<airport_code>DPS</airport_code>
<location_name>Denpasar, Bali</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>H. Hasan Aroeboesman</airport_name>
<airport_code>ENE</airport_code>
<location_name>Ende</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Fakfak</airport_name>
<airport_code>FKQ</airport_code>
<location_name>FakFak</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>GALELA</airport_name>
<airport_code>GLX</airport_code>
<location_name>Galela</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Jalaluddin</airport_name>
<airport_code>GTO</airport_code>
<location_name>Gorontalo</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Gunung Sitoli, Binaka</airport_name>
<airport_code>GNS</airport_code>
<location_name>GunungSitoli</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Soekarno Hatta</airport_name>
<airport_code>CGK</airport_code>
<location_name>Jakarta - Cengkareng</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>HALIM PERDANAKUSUMA</airport_name>
<airport_code>HLP</airport_code>
<location_name>Jakarta - Halim</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sultan Thaha Syaifuddin</airport_name>
<airport_code>DJB</airport_code>
<location_name>Jambi</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sentani</airport_name>
<airport_code>DJJ</airport_code>
<location_name>Jayapura</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Kaimana, Utarom</airport_name>
<airport_code>KNG</airport_code>
<location_name>Kaimana</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Haluoleo</airport_name>
<airport_code>KDI</airport_code>
<location_name>Kendari</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>RAHADI OESMAN</airport_name>
<airport_code>KTG</airport_code>
<location_name>Ketapang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Kotabaru</airport_name>
<airport_code>KBU</airport_code>
<location_name>Kotabaru</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>El Tari</airport_name>
<airport_code>KOE</airport_code>
<location_name>Kupang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Labuanbajo, Komodo</airport_name>
<airport_code>LBJ</airport_code>
<location_name>LabuanBajo</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Labuha, Oesman Sadik</airport_name>
<airport_code>LAH</airport_code>
<location_name>Labuha</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Radin Inten II</airport_name>
<airport_code>TKG</airport_code>
<location_name>Lampung</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Lhokseumawe, Malikussaleh</airport_name>
<airport_code>LSW</airport_code>
<location_name>Lhokseumawe</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Lombok</airport_name>
<airport_code>LOP</airport_code>
<location_name>Lombok, Mataram</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Syukuran Aminuddin Amir</airport_name>
<airport_code>LUW</airport_code>
<location_name>Luwuk</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Abdul Rachman Saleh</airport_name>
<airport_code>MLG</airport_code>
<location_name>Malang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>ROBERT ATTY BESSING</airport_name>
<airport_code>MLN</airport_code>
<location_name>Malinau</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Mamuju</airport_name>
<airport_code>MJU</airport_code>
<location_name>Mamuju</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sam Ratulangi</airport_name>
<airport_code>MDC</airport_code>
<location_name>Manado</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Rendani</airport_name>
<airport_code>MKW</airport_code>
<location_name>Manokwari</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Wai Oti</airport_name>
<airport_code>MOF</airport_code>
<location_name>Maumere</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Kuala Namu</airport_name>
<airport_code>KNO</airport_code>
<location_name>Medan (Kuala Namu)</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>MELALAN</airport_name>
<airport_code>MLK</airport_code>
<location_name>Melak</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Melonguane</airport_name>
<airport_code>MNA</airport_code>
<location_name>Melanguane</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Mopah</airport_name>
<airport_code>MKQ</airport_code>
<location_name>Merauke</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Meulaboh, Cut Nyak Dien</airport_name>
<airport_code>MEQ</airport_code>
<location_name>Meulaboh</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>MOROTAI</airport_name>
<airport_code>OTI</airport_code>
<location_name>MOROTAI</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>BANDAR UDARA BERINGIN</airport_name>
<airport_code>MTW</airport_code>
<location_name>Muara Teweh</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Nabire</airport_name>
<airport_code>NBX</airport_code>
<location_name>Nabire</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Natuna Ranai</airport_name>
<airport_code>NTX</airport_code>
<location_name>NatunaRanai</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>NUNUKAN</airport_name>
<airport_code>NNX</airport_code>
<location_name>Nunukan</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Minangkabau</airport_name>
<airport_code>PDG</airport_code>
<location_name>Padang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Tjilik Riwut</airport_name>
<airport_code>PKY</airport_code>
<location_name>Palangka raya</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sultan Mahmud Badaruddin II</airport_name>
<airport_code>PLM</airport_code>
<location_name>Palembang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Mutiara</airport_name>
<airport_code>PLW</airport_code>
<location_name>Palu</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Depati Amir</airport_name>
<airport_code>PGK</airport_code>
<location_name>Pangkal pinang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>PANGKALAN BUN</airport_name>
<airport_code>PKN</airport_code>
<location_name>Pangkalan Bun</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sultan Syarif Kasim II</airport_name>
<airport_code>PKU</airport_code>
<location_name>Pekanbaru</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sangia Nibandera Pomalaa</airport_name>
<airport_code>PUM</airport_code>
<location_name>Pomalaa</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Supadio</airport_name>
<airport_code>PNK</airport_code>
<location_name>Pontianak</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Poso, Kasiguncu</airport_name>
<airport_code>PSJ</airport_code>
<location_name>Poso</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Mali</airport_name>
<airport_code>ARD</airport_code>
<location_name>Pulau Alor</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>PUTUSSIBAU</airport_name>
<airport_code>PSU</airport_code>
<location_name>Putussibau</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>ROTE</airport_name>
<airport_code>RTI</airport_code>
<location_name>Rote</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Frans Sales Lega</airport_name>
<airport_code>RTG</airport_code>
<location_name>Ruteng</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>TEMINDUNG</airport_name>
<airport_code>SRI</airport_code>
<location_name>Samarinda</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>H. Asan Sampit</airport_name>
<airport_code>SMQ</airport_code>
<location_name>Sampit</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>BANDAR UDARA OLILIT</airport_name>
<airport_code>SXK</airport_code>
<location_name>Saumlaki</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>SELAYAR</airport_name>
<airport_code>YKR</airport_code>
<location_name>Selayar</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Achmad Yani</airport_name>
<airport_code>SRG</airport_code>
<location_name>Semarang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>SIBOLGA</airport_name>
<airport_code>RRZ</airport_code>
<location_name>Sibolga</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Silangit</airport_name>
<airport_code>DTB</airport_code>
<location_name>Silangit</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Lasikin</airport_name>
<airport_code>SNX</airport_code>
<location_name>Sinabang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>SUSILO</airport_name>
<airport_code>SQG</airport_code>
<location_name>Sintang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Adisumarmo</airport_name>
<airport_code>SOC</airport_code>
<location_name>Solo</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Dominique Edward Osok</airport_name>
<airport_code>SOQ</airport_code>
<location_name>Sorong</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sumbawa, Brang Biji</airport_name>
<airport_code>SWQ</airport_code>
<location_name>Sumbawa</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Juanda</airport_name>
<airport_code>SUB</airport_code>
<location_name>Surabaya</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Naha</airport_name>
<airport_code>NAH</airport_code>
<location_name>Tahuna</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Tampolaka</airport_name>
<airport_code>TMC</airport_code>
<location_name>Tambolaka</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>H.A.S Hanandjoeddin</airport_name>
<airport_code>TJQ</airport_code>
<location_name>Tanjung Pandan</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Raja Haji FIsabilillah</airport_name>
<airport_code>TNJ</airport_code>
<location_name>Tanjung Pinang</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>TANJUNG HARAPAN</airport_name>
<airport_code>TJS</airport_code>
<location_name>Tanjung Selor</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>WARUKIN</airport_name>
<airport_code>TJG</airport_code>
<location_name>Tanjung Warukin</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Juwata</airport_name>
<airport_code>TRK</airport_code>
<location_name>Tarakan</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Sultan Babullah</airport_name>
<airport_code>TTE</airport_code>
<location_name>Ternate</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Mozes Kilangin</airport_name>
<airport_code>TIM</airport_code>
<location_name>Timika</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Tobelo</airport_name>
<airport_code>KAZ</airport_code>
<location_name>Tobelo</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>TOLI TOLI</airport_name>
<airport_code>TLI</airport_code>
<location_name>TOLI TOLI</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Tual, Dumatubin</airport_name>
<airport_code>LUV</airport_code>
<location_name>Tual</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>SULTAN HASANUDDIN</airport_name>
<airport_code>UPG</airport_code>
<location_name>Ujungpandang, Makassar</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>WAINGAPU</airport_name>
<airport_code>WGP</airport_code>
<location_name>Waingapu</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Matahora</airport_name>
<airport_code>WNI</airport_code>
<location_name>Wakatobi</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>WAMENA</airport_name>
<airport_code>WMX</airport_code>
<location_name>Wamena</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Wangi wangi, Matahora</airport_name>
<airport_code>WGI</airport_code>
<location_name>Wangi wangi</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>Adi Sutjipto</airport_name>
<airport_code>JOG</airport_code>
<location_name>Yogyakarta</location_name>
<country_id>id</country_id>
<country_name>Indonesia</country_name>
</airport>
<airport>
<airport_name>ADELAIDE</airport_name>
<airport_code>ADL</airport_code>
<location_name>Adelaide</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>Alice Springs</airport_name>
<airport_code>ASP</airport_code>
<location_name>Alice Springs</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>AVALON</airport_name>
<airport_code>AVV</airport_code>
<location_name>AVALON</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>BALLINA BYRON</airport_name>
<airport_code>BNK</airport_code>
<location_name>BALLINA BYRON</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>BRISBANE</airport_name>
<airport_code>BNE</airport_code>
<location_name>Brisbane</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>CAIRNS</airport_name>
<airport_code>CNS</airport_code>
<location_name>Cairns</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>CANBERRA</airport_name>
<airport_code>CBR</airport_code>
<location_name>CANBERRA</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>Coffs Harbour</airport_name>
<airport_code>CFS</airport_code>
<location_name>Coffs Harbour</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>DARWIN</airport_name>
<airport_code>DRW</airport_code>
<location_name>Darwin</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>GOLD COAST</airport_name>
<airport_code>OOL</airport_code>
<location_name>Gold Coast</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>HAMILTON ISLAND</airport_name>
<airport_code>HTI</airport_code>
<location_name>HAMILTON ISLAND</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>HAYMAN ISLAND</airport_name>
<airport_code>HIS</airport_code>
<location_name>HAYMAN ISLAND</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>HOBART</airport_name>
<airport_code>HBA</airport_code>
<location_name>Hobart</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>LAUNCESTON</airport_name>
<airport_code>LST</airport_code>
<location_name>Launceston</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>MACKAY</airport_name>
<airport_code>MKY</airport_code>
<location_name>Mackay (Whitsundays)</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>MELBOURNE</airport_name>
<airport_code>MEL</airport_code>
<location_name>Melbourne</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>MELBOURNE (ALL AIRPORTS)</airport_name>
<airport_code>VIZ</airport_code>
<location_name>Melbourne (all airports)</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>NEWCASTLE - PORT STEPHENS</airport_name>
<airport_code>NTL</airport_code>
<location_name>NEWCASTLE - PORT STEPHENS</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>PERTH</airport_name>
<airport_code>PER</airport_code>
<location_name>Perth</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>SUNSHINE COAST</airport_name>
<airport_code>MCY</airport_code>
<location_name>Sunshine Coast</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>SYDNEY (KINGSFORD-SMITH)</airport_name>
<airport_code>SYD</airport_code>
<location_name>Sydney</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>TOWNSVILLE</airport_name>
<airport_code>TSV</airport_code>
<location_name>TOWNSVILLE</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>ULURU</airport_name>
<airport_code>AYQ</airport_code>
<location_name>Uluru</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>WHITSUNDAY COAST - PROSERPINE</airport_name>
<airport_code>PPP</airport_code>
<location_name>WHITSUNDAY COAST - PROSERPINE</location_name>
<country_id>au</country_id>
<country_name>Australia</country_name>
</airport>
<airport>
<airport_name>SHAH AMANAT</airport_name>
<airport_code>CGP</airport_code>
<location_name>Chittagong</location_name>
<country_id>bd</country_id>
<country_name>Bangladesh</country_name>
</airport>
<airport>
<airport_name>INDIRA GANDHI</airport_name>
<airport_code>DEL</airport_code>
<location_name>Delhi</location_name>
<country_id>bd</country_id>
<country_name>Bangladesh</country_name>
</airport>
<airport>
<airport_name>Dhaka</airport_name>
<airport_code>DAC</airport_code>
<location_name>Dhaka</location_name>
<country_id>bd</country_id>
<country_name>Bangladesh</country_name>
</airport>
<airport>
<airport_name>BRUNEI</airport_name>
<airport_code>BWN</airport_code>
<location_name>Brunei</location_name>
<country_id>bn</country_id>
<country_name>Brunei Darussalam</country_name>
</airport>
<airport>
<airport_name>PHNOM PENH</airport_name>
<airport_code>PNH</airport_code>
<location_name>Phnom Penh</location_name>
<country_id>kh</country_id>
<country_name>Cambodia</country_name>
</airport>
<airport>
<airport_name>SIEM REAP</airport_name>
<airport_code>REP</airport_code>
<location_name>Siem Reap</location_name>
<country_id>kh</country_id>
<country_name>Cambodia</country_name>
</airport>
<airport>
<airport_name>Beijing Capital</airport_name>
<airport_code>PEK</airport_code>
<location_name>Beijing</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Chengdu Shuangliu</airport_name>
<airport_code>CTU</airport_code>
<location_name>Chengdu</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Chongqing Jiangbei</airport_name>
<airport_code>CKG</airport_code>
<location_name>Chongqing</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Guangzhou Baiyun</airport_name>
<airport_code>CAN</airport_code>
<location_name>Guangzhou</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Guilin Liangjiang</airport_name>
<airport_code>KWL</airport_code>
<location_name>Guilin</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>HAIKOU</airport_name>
<airport_code>HAK</airport_code>
<location_name>Haikou</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>HANGZHOU XIAOSHAN</airport_name>
<airport_code>HGH</airport_code>
<location_name>Hangzhou</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Kunming Wujiaba</airport_name>
<airport_code>KMG</airport_code>
<location_name>Kunming</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Nanning Wuxu</airport_name>
<airport_code>NNG</airport_code>
<location_name>Nanning</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Ningbo Lishe</airport_name>
<airport_code>NGB</airport_code>
<location_name>Ningbo</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Qingdao</airport_name>
<airport_code>TAO</airport_code>
<location_name>Qingdao</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Shanghai Pudong</airport_name>
<airport_code>PVG</airport_code>
<location_name>Shanghai</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>SHANTOU / JIEYANG</airport_name>
<airport_code>SWA</airport_code>
<location_name>SHANTOU / JIEYANG</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Shenyang</airport_name>
<airport_code>SHE</airport_code>
<location_name>Shenyang</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Shenzhen</airport_name>
<airport_code>SZX</airport_code>
<location_name>Shenzhen</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Tianjin</airport_name>
<airport_code>TSN</airport_code>
<location_name>Tianjin</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Wuhan Tianhe</airport_name>
<airport_code>WUH</airport_code>
<location_name>Wuhan</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Xi An Xianyang</airport_name>
<airport_code>XIY</airport_code>
<location_name>Xi'an</location_name>
<country_id>cn</country_id>
<country_name>China</country_name>
</airport>
<airport>
<airport_name>Naike</airport_name>
<airport_code>CMB</airport_code>
<location_name>Colombo</location_name>
<country_id>co</country_id>
<country_name>Colombia</country_name>
</airport>
<airport>
<airport_name>NADI</airport_name>
<airport_code>NAN</airport_code>
<location_name>NADI</location_name>
<country_id>fj</country_id>
<country_name>Fiji</country_name>
</airport>
<airport>
<airport_name>HONG KONG</airport_name>
<airport_code>HKG</airport_code>
<location_name>Hong Kong</location_name>
<country_id>hk</country_id>
<country_name>Hong Kong</country_name>
</airport>
<airport>
<airport_name>SARDAR VALLABHBHAI PATEL</airport_name>
<airport_code>AMD</airport_code>
<location_name>Ahmedabad</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Bangalore</airport_name>
<airport_code>BLR</airport_code>
<location_name>Bangalore</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Chennai</airport_name>
<airport_code>MAA</airport_code>
<location_name>Chennai</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Hyderabad</airport_name>
<airport_code>HYD</airport_code>
<location_name>Hyderabad</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Kochi</airport_name>
<airport_code>COK</airport_code>
<location_name>Kochi</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Netaji Subhas Chandra Bosen</airport_name>
<airport_code>CCU</airport_code>
<location_name>Kolkata</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>CHHATRAPATI SHIVAJI</airport_name>
<airport_code>BOM</airport_code>
<location_name>Mumbai</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Thiruvananthapuram</airport_name>
<airport_code>TRV</airport_code>
<location_name>Thiruvananthapuram</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>Tiruchirapalli (Trichy)</airport_name>
<airport_code>TRZ</airport_code>
<location_name>Tiruchirapalli (Trichy)</location_name>
<country_id>in</country_id>
<country_name>India</country_name>
</airport>
<airport>
<airport_name>FUKUOKA</airport_name>
<airport_code>FUK</airport_code>
<location_name>Fukuoka</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>KAGOSHIMA</airport_name>
<airport_code>KOJ</airport_code>
<location_name>Kagoshima</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>KUMAMOTO</airport_name>
<airport_code>KMJ</airport_code>
<location_name>Kumamoto</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>MATSUYAMA</airport_name>
<airport_code>MYJ</airport_code>
<location_name>Matsuyama</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>NAGOYA CHUBU CENTRAIR</airport_name>
<airport_code>NGO</airport_code>
<location_name>Nagoya</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>OITA</airport_name>
<airport_code>OIT</airport_code>
<location_name>Oita</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>OKINAWA, NAHA</airport_name>
<airport_code>OKA</airport_code>
<location_name>Okinawa - Naha</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>OSAKA, KANSAI</airport_name>
<airport_code>KIX</airport_code>
<location_name>Osaka - Kansai</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>SAPPORO, SHIN-CHITOSE</airport_name>
<airport_code>CTS</airport_code>
<location_name>Sapporo - Shin-Chitose</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>TAKAMATSU</airport_name>
<airport_code>TAK</airport_code>
<location_name>Takamatsu</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>Tokyo, Haneda</airport_name>
<airport_code>HND</airport_code>
<location_name>Tokyo - Haneda</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>TOKYO, NARITA</airport_name>
<airport_code>NRT</airport_code>
<location_name>Tokyo - Narita</location_name>
<country_id>jp</country_id>
<country_name>Japan</country_name>
</airport>
<airport>
<airport_name>Wattay</airport_name>
<airport_code>VTE</airport_code>
<location_name>Vientiane</location_name>
<country_id>la</country_id>
<country_name>Laos</country_name>
</airport>
<airport>
<airport_name>MACAU</airport_name>
<airport_code>MFM</airport_code>
<location_name>Macau</location_name>
<country_id>mo</country_id>
<country_name>Macau</country_name>
</airport>
<airport>
<airport_name>Sultan Abdul Halim</airport_name>
<airport_code>AOR</airport_code>
<location_name>Alor Setar</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Bintulu</airport_name>
<airport_code>BTU</airport_code>
<location_name>Bintulu</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Senai</airport_name>
<airport_code>JHB</airport_code>
<location_name>Johor Baru</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Sultan Ismail Petra</airport_name>
<airport_code>KBR</airport_code>
<location_name>Kota Bharu</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Kota Kinabalu</airport_name>
<airport_code>BKI</airport_code>
<location_name>Kota Kinabalu</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>KUALA LUMPUR</airport_name>
<airport_code>KUL</airport_code>
<location_name>Kuala Lumpur</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>SULTAN MAHMUD</airport_name>
<airport_code>TGG</airport_code>
<location_name>Kuala Terengganu</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Kuching</airport_name>
<airport_code>KCH</airport_code>
<location_name>Kuching</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Langkawi</airport_name>
<airport_code>LGK</airport_code>
<location_name>Langkawi</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Malacca</airport_name>
<airport_code>MKZ</airport_code>
<location_name>Malacca</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Miri</airport_name>
<airport_code>MYY</airport_code>
<location_name>Miri</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>PENANG</airport_name>
<airport_code>PEN</airport_code>
<location_name>Penang</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Sandakan</airport_name>
<airport_code>SDK</airport_code>
<location_name>Sandaka</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Sibu</airport_name>
<airport_code>SBW</airport_code>
<location_name>Sibu</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Sultan Abdul Aziz Shah</airport_name>
<airport_code>SZB</airport_code>
<location_name>Subang</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>IPOH</airport_name>
<airport_code>IPH</airport_code>
<location_name>SULTAN AZLAN SHAH</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Tawau</airport_name>
<airport_code>TWU</airport_code>
<location_name>Tawau</location_name>
<country_id>my</country_id>
<country_name>Malaysia</country_name>
</airport>
<airport>
<airport_name>Mandalay</airport_name>
<airport_code>MDL</airport_code>
<location_name>Mandalay</location_name>
<country_id>mm</country_id>
<country_name>Myanmar</country_name>
</airport>
<airport>
<airport_name>YANGOON</airport_name>
<airport_code>RGN</airport_code>
<location_name>Yangoon</location_name>
<country_id>mm</country_id>
<country_name>Myanmar</country_name>
</airport>
<airport>
<airport_name>Tribhuvan</airport_name>
<airport_code>KTM</airport_code>
<location_name>Kathmandu</location_name>
<country_id>np</country_id>
<country_name>Nepal</country_name>
</airport>
<airport>
<airport_name>SCHIPHOL</airport_name>
<airport_code>AMS</airport_code>
<location_name>SCHIPHOL</location_name>
<country_id>nl</country_id>
<country_name>Netherlands</country_name>
</airport>
<airport>
<airport_name>AUCKLAND</airport_name>
<airport_code>AKL</airport_code>
<location_name>AUCKLAND</location_name>
<country_id>nz</country_id>
<country_name>New Zealand</country_name>
</airport>
<airport>
<airport_name>CHRISTCHURCH</airport_name>
<airport_code>CHC</airport_code>
<location_name>CHRISTCHURCH</location_name>
<country_id>nz</country_id>
<country_name>New Zealand</country_name>
</airport>
<airport>
<airport_name>DUNEDIN</airport_name>
<airport_code>DUD</airport_code>
<location_name>DUNEDIN</location_name>
<country_id>nz</country_id>
<country_name>New Zealand</country_name>
</airport>
<airport>
<airport_name>QUEENSTOWN</airport_name>
<airport_code>ZQN</airport_code>
<location_name>QUEENSTOWN</location_name>
<country_id>nz</country_id>
<country_name>New Zealand</country_name>
</airport>
<airport>
<airport_name>WELLINGTON</airport_name>
<airport_code>WLG</airport_code>
<location_name>WELLINGTON</location_name>
<country_id>nz</country_id>
<country_name>New Zealand</country_name>
</airport>
<airport>
<airport_name>Bacolod</airport_name>
<airport_code>BCD</airport_code>
<location_name>Bacolod</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>Mactan-Cebu</airport_name>
<airport_code>CEB</airport_code>
<location_name>Cebu</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>CLARK</airport_name>
<airport_code>CRK</airport_code>
<location_name>Clark</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>Davao</airport_name>
<airport_code>DVO</airport_code>
<location_name>Davao</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>Iloilo</airport_name>
<airport_code>ILO</airport_code>
<location_name>Iloilo</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>NINOY AQUINO</airport_name>
<airport_code>MNL</airport_code>
<location_name>Manila (NAIA)</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>Puerto Princesa</airport_name>
<airport_code>PPS</airport_code>
<location_name>Puerto Princesa</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>Tacloban</airport_name>
<airport_code>TAC</airport_code>
<location_name>Tacloban</location_name>
<country_id>ph</country_id>
<country_name>Philippines</country_name>
</airport>
<airport>
<airport_name>King Abdulaziz</airport_name>
<airport_code>JED</airport_code>
<location_name>Jeddah</location_name>
<country_id>sa</country_id>
<country_name>Saudi Arabia</country_name>
</airport>
<airport>
<airport_name>Changi</airport_name>
<airport_code>SIN</airport_code>
<location_name>Singapore</location_name>
<country_id>sg</country_id>
<country_name>Singapore</country_name>
</airport>
<airport>
<airport_name>Gimhae</airport_name>
<airport_code>PUS</airport_code>
<location_name>Busan</location_name>
<country_id>kr</country_id>
<country_name>South Korea</country_name>
</airport>
<airport>
<airport_name>Incheon</airport_name>
<airport_code>ICN</airport_code>
<location_name>Seoul</location_name>
<country_id>kr</country_id>
<country_name>South Korea</country_name>
</airport>
<airport>
<airport_name>TAIWAN TAOYUAN</airport_name>
<airport_code>TPE</airport_code>
<location_name>Taipei</location_name>
<country_id>tw</country_id>
<country_name>Taiwan</country_name>
</airport>
<airport>
<airport_name>DON MUEANG</airport_name>
<airport_code>DMK</airport_code>
<location_name>Bangkok - Don Mueang</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>SUVARNABHUMI</airport_name>
<airport_code>BKK</airport_code>
<location_name>Bangkok - Suvarnabhumi</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>CHIANG MAI</airport_name>
<airport_code>CNX</airport_code>
<location_name>Chiang Mai</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Mae Fah Luang-Chiang Rai</airport_name>
<airport_code>CEI</airport_code>
<location_name>Chiang Rai</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Hat Yai</airport_name>
<airport_code>HDY</airport_code>
<location_name>Hat Yai</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Krabi</airport_name>
<airport_code>KBV</airport_code>
<location_name>Krabi</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Nakhon Phanom</airport_name>
<airport_code>KOP</airport_code>
<location_name>Nakhon Phanom</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Nakhon Si Thammarat</airport_name>
<airport_code>NST</airport_code>
<location_name>Nakhon Si Thammarat</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Narathiwat</airport_name>
<airport_code>NAW</airport_code>
<location_name>Narathiwat</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>PHUKET</airport_name>
<airport_code>HKT</airport_code>
<location_name>Phuket</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Surat Thani</airport_name>
<airport_code>URT</airport_code>
<location_name>Surat Thani</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Trang</airport_name>
<airport_code>TST</airport_code>
<location_name>Trang</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Ubon Ratchathani</airport_name>
<airport_code>UBP</airport_code>
<location_name>Ubon Ratchathani</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Udonthani</airport_name>
<airport_code>UTH</airport_code>
<location_name>Udon Thani</location_name>
<country_id>th</country_id>
<country_name>Thailand</country_name>
</airport>
<airport>
<airport_name>Presidente Nicolau Lobato</airport_name>
<airport_code>DIL</airport_code>
<location_name>Dili</location_name>
<country_id>tl</country_id>
<country_name>Timor-Leste</country_name>
</airport>
<airport>
<airport_name>ABU DHABI</airport_name>
<airport_code>ABU</airport_code>
<location_name>Abu Dhabi</location_name>
<country_id>ae</country_id>
<country_name>United Arab Emirates</country_name>
</airport>
<airport>
<airport_name>ABU DHABI</airport_name>
<airport_code>AUH</airport_code>
<location_name>Abu Dhabi</location_name>
<country_id>ae</country_id>
<country_name>United Arab Emirates</country_name>
</airport>
<airport>
<airport_name>DUBAI INTERNATIONAL AIRPORT</airport_name>
<airport_code>DXB</airport_code>
<location_name>Dubai</location_name>
<country_id>ae</country_id>
<country_name>United Arab Emirates</country_name>
</airport>
<airport>
<airport_name>DYCE AIRPORT</airport_name>
<airport_code>ABZ</airport_code>
<location_name>edinbrugh</location_name>
<country_id>gb</country_id>
<country_name>United Kingdom</country_name>
</airport>
<airport>
<airport_name>LONDON</airport_name>
<airport_code>LGW</airport_code>
<location_name>London</location_name>
<country_id>gb</country_id>
<country_name>United Kingdom</country_name>
</airport>
<airport>
<airport_name>LONDON HEATHROW</airport_name>
<airport_code>LHR</airport_code>
<location_name>palmers green</location_name>
<country_id>gb</country_id>
<country_name>United Kingdom</country_name>
</airport>
<airport>
<airport_name>HONOLULU</airport_name>
<airport_code>HNL</airport_code>
<location_name>HONOLULU</location_name>
<country_id>us</country_id>
<country_name>United States</country_name>
</airport>
<airport>
<airport_name>LOS ANGELES INTERNATIONAL AIRPORT</airport_name>
<airport_code>LAX</airport_code>
<location_name>Los Angeles</location_name>
<country_id>us</country_id>
<country_name>United States</country_name>
</airport>
<airport>
<airport_name>SAN DIEGO INTERNATIONAL AIRPORT</airport_name>
<airport_code>SAN</airport_code>
<location_name>North Harbor Drive San Diego</location_name>
<country_id>us</country_id>
<country_name>United States</country_name>
</airport>
<airport>
<airport_name>BUON MA THUOT</airport_name>
<airport_code>BMV</airport_code>
<location_name>Buon Ma Thuot</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>DA NANG</airport_name>
<airport_code>DAD</airport_code>
<location_name>Da Nang</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>DONG HOI</airport_name>
<airport_code>VDH</airport_code>
<location_name>Dong Hoi</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>HAI PHONG</airport_name>
<airport_code>HPH</airport_code>
<location_name>Hai Phong</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>TAN SON NHAT</airport_name>
<airport_code>SGN</airport_code>
<location_name>Ho Chi Minh City</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>HUI</airport_name>
<airport_code>HUI</airport_code>
<location_name>HUI</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>NHA TRANG</airport_name>
<airport_code>CXR</airport_code>
<location_name>Nha Trang</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>NOI BAI</airport_name>
<airport_code>HAN</airport_code>
<location_name>Noi Bai</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>PHU QUOC</airport_name>
<airport_code>PQC</airport_code>
<location_name>Phu Quoc</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>QUY NHON</airport_name>
<airport_code>UIH</airport_code>
<location_name>Quy Nhon</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>THANH HOA</airport_name>
<airport_code>THD</airport_code>
<location_name>Thanh Hoa</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>TUY HOA</airport_name>
<airport_code>TBB</airport_code>
<location_name>Tuy Hoa</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
<airport>
<airport_name>VINH</airport_name>
<airport_code>VII</airport_code>
<location_name>Vinh</location_name>
<country_id>vn</country_id>
<country_name>Vietnam</country_name>
</airport>
</all_airport>
<login_status>false</login_status>
<token>75f0e15a436644ffd9a226553214cd5236078b26</token>
</tiket>";
        $xml = simplexml_load_string($result);
             
        foreach ($xml->all_airport->airport as $key) {
            $temp['airport_code'] = $key->airport_code;
            $temp['airport_name'] = $key->airport_name;
            $temp['location_name'] = $key->location_name;
            $temp['country_id'] = $key->country_id;
            $temp['country_name'] = $key->country_name;
            $this->flight_model->insert_airport($temp);
        }

        //echo "<pre>",print_r($xml->),"</pre>";die();
        //$data['list'] = $xml->departures;
      echo "success";
        // $this->middle = 'flight_order'; 
        // $this->layout($data);
    }

}

?>