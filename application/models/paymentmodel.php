<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Paymentmodel extends CI_Model 
{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function user_payments($id,$txn_id,$amt,$cur,$sts) {
		$data = array(
			'user_id' => $id,
			'txn_id' => $txn_id,
			'amount' => $amt,
			'currency' => $cur,
			'status' => $sts
		);
		$this->db->insert('payments', $data);
	}
	
	
	function update_db($id,$img_id,$fname,$lname,$addr1,$addr2,$cty,$state,$zip,$amt,$con,$arr){
		$data = array(
			'user_id' => $id,
			'txn_id' => $arr['TRANSACTIONID'],
			'amount' => $amt,
			'currency' => $arr['CURRENCYCODE'],
			'fname' => $fname,
			'lname' => $lname,
			'address1' => $addr1,
			'address2' => $addr2,
			'city' => $cty,
			'state' => $state,
			'zip' => $zip,
			'country' => $con,
			'status' => 'Completed'
		);
		$this->db->insert('payments', $data);
	}
	
	function update_cards_img_tbl($img_id)
	{
		
		$data = array(
				'active_status' => 1       
			);
		$this->db->where('img_id', $img_id);
		$this->db->update('img', $data);
		
		$userInfo = $this->db->get_where('cards_user',array('user_id'=>$this->session->userdata('user_id')))->row_array();
		$newCardLimit = $userInfo['cardsend'] - 1;
		
		
		//$this->db->where('user_id',$this->session->userdata('user_id'));
		//$this->db->update('cards_user',array('cardsend'=>$newCardLimit));
		
		
	}
	
	
	
}
?>