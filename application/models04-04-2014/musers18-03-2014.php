<?php
if (! defined('BASEPATH')) exit('No direct script access');

class MUsers extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function addUser($email,$password)
	{
		$data = array(
			'email' => $email,
			'pass' => md5($password),
			'rem_pass' => $password,
			'post_date' => date("Y-m-d"),
			'status' => 1,
		); 
                
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}
	
	function checklogin($email, $password)
	{		
		$this->db->select('*');
		$this->db->from('user');
		
		$this->db->where('email',mysql_real_escape_string($email));
		$this->db->where('pass',mysql_real_escape_string(md5($password)));
		$this->db->where('status',1);
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function checkEmailExists($email)
	{
		$query = $this->db->get_where('user', array('email' => $email ));
		$count = $query->num_rows();
		$data = $query->row_array();
		
		return ($count>0) ? $data : 0;
	}
	
	function checkEmail($email)
	{
		$query = $this->db->get_where('user', array('email' => $email ));
		$count = $query->num_rows();
		
		return ($count>0) ? $count : 0;
	}
	
	function changePassword($user_id)
	{
		$data = array(
			'pass' => md5($this->input->post('pass')),
			'rem_pass' => $this->input->post('pass')
		); 
		
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data); 
	}
	
	
	function activateStatus($user_id)
	{		
		$data = array(
			'status' => 1
		); 
		
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data); 
	}
	
	
	function check_facebookduplicate($mail,$fid)
	{
		$query = $this->db->get_where('facebookId', array('email' => $mail,'facebook_id'=> $fid));
		//echo $this->db->last_query();exit;
		$count = $query->num_rows();
		$data = $query->row_array();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	function add_facebookduplicate($mail,$fid)
	{
		$data = array(
			'email' => $mail,
			'facebook_id' => $fid
		); 
				
		$this->db->insert('facebookId', $data);
		
	}
	
	function addUserByFb($mail,$first_name,$last_name,$gender,$birthday)
	{
		//echo $birthday;
		$data = array(
			'email' => $mail,
			'fname' => $first_name,
			'lname' => $last_name,
			'sex' => $gender,
			'birthday' => $birthday,
			'post_date' => date("Y-m-d"),
			'status' => 1
		); 
		//print_r($data);exit;		
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}
	
	
	function getFbUser($mail)
	{
		$query = $this->db->get_where('user', array('email' => $mail,'pass'=> ''));
		$count = $query->num_rows();
		$data = $query->row_array();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	function imgadd($pageselector,$card_image,$userid)
	{
		
		$data = array(
			'image'.$pageselector => $card_image,
			'user_id' => $userid,
			'post_date' => date("Y-m-d")
		);
		if($this->session->userdata('img_id') != '')
		{
			$this->db->where('img_id',$this->session->userdata('img_id'));
			$this->db->update('img', $data);
			return $this->session->userdata('img_id');
		}
		else
		{
			$this->db->insert('img', $data);
			return $this->db->insert_id();
		}
		
	}
	
         function imgInsert($pageselector,$card_image,$userid,$img_top,$img_left){
            $data = array(
			'image'.$pageselector => $card_image,
                        'img'.$pageselector.'_top'=>$img_top,
                        'img'.$pageselector.'_left'=>$img_left,
			'user_id' => $userid,
			'post_date' => date("Y-m-d")
		);
            
            
			$this->db->insert('img', $data);
			return $this->db->insert_id();
        }
        
	function updateImgUser($img_id)
        {
            $this->db->where('img_id',$img_id);
            $this->db->update('img',array('user_id'=>  $this->session->userdata('user_id')));
        }
	
	function getrecentImage($imgid,$userid)
	{
		$this->db->select('i.*');
		$this->db->from('img as i');
		$this->db->where('img_id',$imgid);
		$this->db->where('user_id',$userid);
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	//function delrecentImage($imgid,$userid)
	//{
	//	$this->db->where('img_id',$imgid);
	//	$this->db->where('user_id',$userid);
	//	$this->db->delete('img'); 
	//	
	//}
	
	function setCardMsg($card_msg,$imgid,$userid)
	{		
		$data = array(
			'text_message' => $card_msg
		); 
		$this->db->where('img_id', $imgid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $this->db->affected_rows();
	}
	
	function getAllAdd($userid)
	{
		$this->db->select('i.*,c.country_name');
		$this->db->from('img as i');
		$this->db->join('country as c','i.country = c.country_id','inner');
		$this->db->where('user_id',$userid);
		$this->db->where('active_status',1);
		$this->db->where('zipcode !=',"");
		$this->db->group_by(array("name", "reciver_add1", "contactno")); 
		
		$query = $this->db->get();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		//echo $count;
		return ($count>0) ? $data : 0;
	}
	
	function updateAdd($imgid,$userid)
	{		
		//print_r($this->input->post());//exit;
		
		$data = array(
			'name' => $this->input->post('rname'),
			'country' => $this->input->post('r_country'),
                    	'state' => $this->input->post('r_state'),
			'city' => $this->input->post('r_city'),
			'zipcode' => $this->input->post('r_zip'),
			'contactno' => $this->input->post('conno'),
			'reciver_add1' => $this->input->post('radd1'),
			'delivery_dt' => $this->input->post('d_dt')
		); 
		$this->db->where('img_id', $imgid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return ($this->db->affected_rows() > 0) ? 1 : 0;
	}
	
	function AllCountry()
	{
		$this->db->select('c.*');
		$this->db->from('country as c');
		$query = $this->db->get();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function gettheaddress($imgid)
	{
		$this->db->select('i.*');
		$this->db->from('img as i');
		$this->db->where('i.img_id', $imgid);
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function getRecentCardImages($card_id){
		$this->db->select('i.*');
		$this->db->from('img as i');
		$this->db->where('i.img_id', $card_id);
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function setposition($forpage,$top,$left,$cardid,$userid){
		//print_r($this->input->post());//exit;
		
		$data = array(
			'img'.$forpage.'_top' => $top,
			'img'.$forpage.'_left'  => $left
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
	function setsize($forpage,$width,$height,$cardid,$userid){
		//print_r($this->input->post());//exit;
		
		$data = array(
			'img'.$forpage.'_width' => $width,
			'img'.$forpage.'_height'  => $height
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
	function settxt($forpage,$txt,$cardid,$userid){
		//print_r($this->input->post());//exit;
		
		$data = array(
			'txt'.$forpage => $txt,
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
        function settxtTopLeft($cardid,$userid,$top,$left){
            $data = array(
			'txt2_left' => $left."px",
                        'txt2_top' => $top."px"
                
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
        }
        
        
        
        
	function setpositiontext($forpage,$top,$left,$cardid,$userid) {
		
		$data = array(
			'txt'.$forpage.'_top' => $top,
			'txt'.$forpage.'_left'  => $left
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
	function setsizetext($forpage,$width,$height,$cardid,$userid){
		//print_r($this->input->post());//exit;
		
		$data = array(
			'txt'.$forpage.'_width' => $width,
			'txt'.$forpage.'_height'  => $height
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
	function setfontsize($forpage,$fontvalue,$cardid,$userid){
		//print_r($this->input->post());//exit;
		
		$data = array(
			'txt'.$forpage.'_fsize' => $fontvalue,
		);
		$this->db->where('img_id', $cardid);
		$this->db->where('user_id', $userid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
	function deleteimg($forpage,$cardid){
		//print_r($this->input->post());//exit;
		$oldcard['cardDtls'] = $this->getRecentCardImages($cardid);
		
		@unlink($path.$oldcard['cardDtls']['image'.$pageselector]);
		
		$data = array(
			'image'.$forpage => '',
			'img'.$forpage.'_top' => '',
			'img'.$forpage.'_left'  => '',
			'img'.$forpage.'_width' => '',
			'img'.$forpage.'_height'  => ''
		);
		$this->db->where('img_id', $cardid);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return $cardid;
	}
	
	function getcms($page){
		$this->db->select('p.*');
		$this->db->from('pages as p');
		$this->db->where('p.page_link', $page);
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function checkUser($username)
	{
		$query = $this->db->get_where('user', array('username' => $username ));
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	
	
	
	function getUserDtls($user_id)
	{
		$this->db->select('u.*,c.country_name,s.name as state');
		$this->db->from('user as u');
		$this->db->join('country as c','c.country_id = u.country_id', 'left');
		$this->db->join('state as s','s.state_id = u.state_id AND s.country_id = u.country_id', 'left');
		$this->db->where('u.user_id', $user_id);
		
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	function getUserImgDtls($user_id)
	{
		$query = $this->db->get_where('user_images', array('user_id' => $user_id ));
		$data = $query->result_array();
		$count = $query->num_rows();
		if($count>0)
			return $data;
		else
			return 0;
	}
	function getUserPrimaryImg($user_id)
	{
		$query = $this->db->get_where('user_images', array('user_id' => $user_id,'primary'=>1 ));
		$data = $query->row_array();
		$count = $query->num_rows();
		if($count>0)
			return $data;
		else
			return 0;
	}
	

	function getAllUsers($limit=false, $start=false)
	{
		$order = $this->input->post('order');	
		$fieldname = $this->input->post('fieldname');
		$tablename = $this->input->post('tablename');
		
		$this->db->select('*');    
		$this->db->from('admin');
		
		if($order)
			$this->db->order_by($tablename.'.'.$fieldname,$order);
		else
			$this->db->order_by('email','desc');
			
		$where = array('parent_admin_id'=>$this->session->userdata('admin_id'));
		$this->db->where($where);
		$where = array('admin_id'=>$this->session->userdata('admin_id'));
		$this->db->or_where($where);
		
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}

	function getAllUsers_count()
	{
		$order = $this->input->post('order');	
		$fieldname = $this->input->post('fieldname');
		$tablename = $this->input->post('tablename');
		
		$this->db->select('*');    
		$this->db->from('admin');
		
		if($order)
			$this->db->order_by($tablename.'.'.$fieldname,$order);
		else
			$this->db->order_by('email','desc');
			
		$where = array('parent_admin_id'=>$this->session->userdata('admin_id'));
		$this->db->where($where);
		$where = array('admin_id'=>$this->session->userdata('admin_id'));
		$this->db->or_where($where);


		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
		
	}
	function getUseronline(){
		$this->db->select('*');    
		$this->db->from('user');
		$this->db->join('user_images','user.user_id = user_images.user_id AND cards_user_images.primary = 1');
		$this->db->where('user.status','1');
		$this->db->where('user.is_online','Y');
		$this->db->where('user.user_id !=',$this->session->userdata('user_id'));
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = $query->result_array();
		return $data;
	}
	function updateUserDtls($id){
		$data = array(
				'time_check' => date('Y-m-d H:i:s')       
			);
		$this->db->where('user_id', $id);
		$this->db->update('user', $data);
	}
	
	
	function user_age($age){
		$from = new DateTime($age);
		$to   = new DateTime('today');
		return $from->diff($to)->y;
	}
	
        
	
}

?>