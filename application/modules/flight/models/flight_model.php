<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed') ;

	class flight_model extends CI_Model {
		function __construct() {
			parent::__construct() ;
		}	

		function insert_airport($data)
		{
			
			$data = array(
			   'airport_code' => $data['airport_code'] ,
			   'airport_name' => $data['airport_name'] ,
			   'country_id' => $data['country_id'] ,
			   'country_name' => $data['country_name'] ,
			   'location_name' => $data['location_name']
			);

			// $data = array(
			//    'airport_code' => "tes" ,
			//    'airport_name' => "tes",
			//    'country_id' =>" tes" ,
			//    'country_name' => "tes" ,
			//    'location_name' => "tes"
			// );

		$this->db->insert('airport', $data); 
		
		}

		function insert_order($token)
		{
			
			$data = array(
			   'token' => $token,
			   'status' => 0
			);

			$this->db->insert('order', $data); 
		
		}

		function update_order($token,$xml)
		{
			// echo $token.' adalah: ';
			// echo $xml;
			$data = array(
			   'response' => $xml,
			   );

			$this->db->where('token', $token);
			$this->db->update('order', $data); 
		}


		function get_airport_list()
		{
			return $query = $this->db->get('airport')->result_array();

		}

		
		
	}
?>