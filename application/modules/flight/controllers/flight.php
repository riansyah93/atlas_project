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

    public function get_token()
    {
        $url = "http://api-sandbox.tiket.com/apiv1/payexpress";
        $param = array(
            'method'=>'getToken',
            'secretkey'=>'28486aa800a2d6921d87d212c87743dd',
            'output'=>'xml'
            );
        
        //echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
        $result = $this->curl->_simple_call('get',$url,$param);
        $xml = simplexml_load_string($result);
        //echo "<pre>",print_r($xml),"</pre>";
        return $xml->token;

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
        $token_id = $this->get_token();

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
            'token'=>(string)$token_id,
            'v'=>3,
            'output'=>'xml');
        if ($post['end_date'] != "-") {
            $param['ret_date'] = $post['end_date'];
        }

        echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
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
        $data['token_id'] =(string)$token_id;
        //echo "<pre>",print_r($data['list']),"</pre>";
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
            'token'=>$post['token_id'],
            'output' => 'xml'
            );

       // echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
       // die();

        $result = $this->curl->_simple_call('get',$url,$param);
        $xml = simplexml_load_string($result);
               
        //echo "<pre>",print_r($xml),"</pre>";die();
        $data['list'] = $xml->departures;
        $data['token_id'] = $post['token_id'];
        $this->middle = 'flight_order'; 
        $this->layout($data);
    }

     function add_order()
    {
        if($this->input->post())
        {
            $post = $this->input->post();

             //echo "<pre>",print_r($post),"</pre>";
            // foreach ($post as $key => $temp) {
            //     echo $temp."---".$key;
            //     echo "<br>";
            // }
         
        }


        $url = "http://api-sandbox.tiket.com/order/add/flight";
        
        $param = array(
            'token'=>$post['token_id'],
            'flight_id'=>$post['flight_id'],
            'child'=>$post['count_child'],
            'adult'=>$post['count_adult'],
            'infant'=>$post['count_infant'],
            'conSalutation'=>$post['conSalutation'],
            'conFirstName'=>$post['conFirstName'],
            'conLastName'=>$post['conLastName'],
            'conPhone'=>$post['conPhone'],
            'conEmailAddress'=>$post['conEmailAddress'],
            // 'firstnamea1'=>$post['firstnamea1'],
            // 'lastnamea1'=>$post['lastnamea1'],
            // 'ida1'=>'1',
            // 'titlea1'=>$post['titlea1'],
            'conOtherPhone'=>$post['conOtherPhone'],
            'output'=>'xml'
            );

        //CHECK ADULT
        for($a=1;$a<=$post['count_adult'];$a++)
        {
            $param['firstnamea'.$a] = $post['firstnamea'.$a];
            $param['lastnamea'.$a] = $post['lastnamea'.$a];
            $param['ida'.$a] = $a;
            $param['titlea'.$a] = $post['titlea'.$a];
            $param['birthdatea'.$a] = $post['yearBirtha'.$a].'-'.$post['monthBirtha'.$a].'-'.$post['datebirtha'.$a];
            
        }

        //CHECK CHILD
        for($a=1;$a<=$post['count_child'];$a++)
        {
            $param['firstnamec'.$a] = $post['firstnamec'.$a];
            $param['lastnamec'.$a] = $post['lastnamec'.$a];
            $param['idc'.$a] = $a;
            $param['titlec'.$a] = $post['titlec'.$a];
            $param['birthdatec'.$a] = $post['yearBirthc'.$a].'-'.$post['monthBirthc'.$a].'-'.$post['datebirthc'.$a];
        }

        for($a=1;$a<=$post['count_infant'];$a++)
        {
            $param['parenti'.$a] = $post['parenti'.$a];
            $param['firstnamei'.$a] = $post['firstnamei'.$a];
            $param['lastnamei'.$a] = $post['lastnamei'.$a];
            $param['idi'.$a] = $a;
            $param['titlei'.$a] = $post['titlei'.$a];
            $param['birthdatei'.$a] = $post['yearBirthi'.$a].'-'.$post['monthBirthi'.$a].'-'.$post['datebirthi'.$a];
        }


        //echo "<pre>",print_r($param),"</pre>";die(); 

        //echo $url.($param ? '?'.http_build_query($param, NULL, '&') : '');
        $result = $this->curl->_simple_call('get',$url,$param);
        // die();
        $this->flight_model->insert_order($post['token_id']);
        // $xml = simplexml_load_string($result);
        $xml = simplexml_load_string($result);
         // echo "<pre>",print_r($xml),"</pre>";

         // echo "coba cek order <br>";


        #CHECK ORDER BY TOKEN AND SAVE TO DATABASE JSON FORMAT
        $url = "http://api-sandbox.tiket.com/order";
        $param = array(
            'token'=>$post['token_id'],
            'output'=>'json'
            );

        $result = $this->curl->_simple_call('get',$url,$param);
        //$xml = simplexml_load_string($result);

        $this->flight_model->update_order($post['token_id'],$result);

        //echo "<pre>",print_r($result),"</pre>";
        $order_information = json_decode($result);
        $data['myorder'] = $order_information->myorder;
        $this->middle = 'flight_order_information'; 
        $this->layout($data);
    }

    function check_order()
    {
        $order_response = '{"diagnostic":{"status":200,"elapsetime":"15.1959","memoryusage":"8.23MB","unix_timestamp":1477728873,"confirm":"success","lang":"id","currency":"IDR"},"output_type":"json","myorder":{"order_id":"22396657","data":[{"expire":28,"uri":"citilink","order_detail_id":"12769127","order_expire_datetime":"2016-10-29 15:28:17","order_type":"flight","customer_price":"632500.00","order_name":"CGK (Jakarta - Cengkareng) - DPS (Denpasar, Bali)","order_name_detail":"Citilink (QG-854 - Depart)","order_detail_status":"active","detail":{"order_detail_id":"12769127","airlines_name":"Citilink","flight_number":"QG-854","trip":"depart","price_adult":"632500.00","price_child":"0.00","price_infant":"0.00","flight_date":"02 Nov 2016","departure_time":"11:35","arrival_time":"14:30","baggage_fee":"0","departure_airport_name":"Soekarno Hatta","arrival_airport_name":"Ngurah Rai","passengers":{"adult":[{"order_passenger_id":"5387901","order_detail_id":"12769127","type":"adult","first_name":"Cody","last_name":"Vang","title":"Mrs","id_number":"1","birth_date":null,"adult_index":null,"passport_no":null,"passport_expiry":null,"passport_issuing_country":null,"passport_nationality":null,"check_in_baggage":"20","check_in_baggage_return":null,"check_in_baggage_size":"20","check_in_baggage_size_return":null,"passport_issued_date":null,"birth_country":null,"ticket_number":null,"phone":null}]},"real_flight_date":"2016-11-02","price":632500,"breakdown_price":[{"category":"price adult","type":"none","value":632500,"currency":"IDR","text":"Harga Dewasa"},{"category":"total base price","type":"price","value":632500,"currency":"IDR","text":"Harga Total"},{"category":"baggage fee","type":"add","value":"0","currency":"IDR","text":"Biaya Bagasi"}],"departure_city":"CGK","arrival_city":"DPS"},"order_photo":"http:\/\/api-sandbox.tiket.com\/images\/icon_citilink.jpg","order_icon":"h3b","tax_and_charge":"15710.00","subtotal_and_charge":"648210.00","delete_uri":"https:\/\/api-sandbox.tiket.com\/order\/delete_order?order_detail_id=12769127","business_id":"20865"}],"total":648210,"total_tax":15710,"total_without_tax":632500,"count_installment":0,"promo":[],"discount":"Dapatkan potongan hingga IDR 15.710,00 saat anda checkout . Tidak berlaku untuk Kartu Kredit.","discount_amount":"15710.00"},"checkout":"https:\/\/api-sandbox.tiket.com\/order\/checkout\/22396657\/IDR","login_status":"false","token":"d241ed6998629611f87b4971c0b126eb285610ff"}';

        $order_information = json_decode($order_response);
        $data['myorder'] = $order_information->myorder;
        echo "<pre>",print_r($data['myorder']),"</pre>";

        $this->middle = 'flight_order_information'; 
        $this->layout($data);

    }

}

?>