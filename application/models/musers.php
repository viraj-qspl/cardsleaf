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
		$this->db->where('status',1);
		$mailquery = $this->db->get();
		
		$maildata = $mailquery->row_array();
		$mailcount = $mailquery->num_rows();
		
		if($mailcount>0)
		{
			$findflag = 1;
			
			$this->db->select('*');
			$this->db->from('user');
			
			$this->db->where('email',mysql_real_escape_string($email));
			$this->db->where('pass',mysql_real_escape_string(md5($password)));
			$this->db->where('status',1);
			$query = $this->db->get();
			
			$data = $query->row_array();
			$count = $query->num_rows();
			
			if($count>0) $findflag = 2;
			
			return ($count>0) ? $data : $findflag;
		}
		else
		{
		 $findflag = 0;
		 return $findflag;
		}
		
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
		$this->db->
		update('user', $data); 
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
		
         function imgUpdate($pageselector,$card_image,$userid,$img_top,$img_left){
            $data = array(
			'image'.$pageselector => $card_image,
                        'img'.$pageselector.'_top'=>$img_top,
                        'img'.$pageselector.'_left'=>$img_left,
			'user_id' => $userid,
			'post_date' => date("Y-m-d")
		);
            
            $this->db->where('img_id',$this->session->userdata('img_id'));
			$this->db->update('img', $data);
			return;
        }		
		
		
		function initCard($userid)
		{
			
			$this->db->insert('cards_img',array('user_id' => $userid));
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
		
		//print_r($data);
		for($i=0;$i<sizeof($data);$i++)
		{
			if($data[$i]['country']==99)
			{
				$this->db->select('s.*');
				$this->db->from('state as s');
				$this->db->where('s.country_id',99);
				$this->db->where('s.state_id',$data[$i]['state']);
				$statequery = $this->db->get();
				$statedata = $statequery->row_array();
				$data[$i]['state']=$statedata;
			}
		}
		//echo $count;
		return ($count>0) ? $data : 0;
	}
	
	function updateAdd($imgid,$userid)
	{		
		//print_r($this->input->post());exit;
	
		$data = array(
			//'email' => $this->input->post('remail'),
			'name' => $this->input->post('rname'),
			'lname' => $this->input->post('lname'),
			'country' => $this->input->post('r_country'),
                    	'state' => $this->input->post('r_state'),
			'city' => $this->input->post('r_city'),
			'zipcode' => $this->input->post('r_zip'),
			'contactno' => $this->input->post('conno'),
			'reciver_add1' => $this->input->post('radd1'),
			'delivery_dt' => date("Y-m-d", strtotime($this->input->post('d_dt')))
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
		
		//print_r($data);//exit;
		
		if($data['country']==99)
		{
			$this->db->select('s.*');
			$this->db->from('state as s');
			$this->db->where('s.country_id',99);
			$this->db->where('s.state_id',$data['state']);
			$statequery = $this->db->get();
			$statedata = $statequery->row_array();
			
			$data['state']=$statedata;
		}
		
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
	
        function settxtTopLeft($forpage,$cardid,$userid,$top,$left){
            $data = array(
			'txt'.$forpage.'_left' => $left."px",
                        'txt'.$forpage.'_top' => $top."px"
                
		);
		
		
		
		
		$this->db->where('user_id', $userid);
		$this->db->where('img_id', $cardid);
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
	
	function getAllpack(){
		$this->db->select('p.*');
		$this->db->from('package as p');
		
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->result_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function receiverInfo($cardid){
		$this->db->select('i.*,s.name as sname,c.country_name as cname');
		$this->db->from('img as i');
		$this->db->join('country as c','c.country_id = i.country');
		$this->db->join('state as s','s.state_id = i.state');
		$this->db->where('i.img_id', $cardid);
		
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function getVendorbyZone($zone)
	{
		return $this->db->get_where('cards_admin',array('zone'=>$zone,'account_type'=>2))->result_array();
	}
	
	function dispatch($vendorId,$imageId)
	{
		$this->db->where('img_id',$imageId);
		$this->db->update('cards_img',array('dispatch_to'=>$vendorId,'dispatch'=>1));
		return $this->db->affected_rows();
	}
	
	
	function dispatch2($vendorId,$imageId)
	{
		$this->db->where('pic_id',$imageId);
		$this->db->update('cards_pic',array('dispatch_to'=>$vendorId,'dispatch'=>1));
		return $this->db->affected_rows();
	}	
	
	
	
	
	function getUserById($userid)
	{		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_id',$userid);
		$this->db->where('status',1);
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function getPackById($packid)
	{		
		$this->db->select('p.*');
		$this->db->from('package as p');
		$this->db->where('pid',$packid);
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		return ($count>0) ? $data : 0;
	}
	
	function buypack($packid,$totcard,$userid)
	{		
		$data = array(
			'packagechoose' => $packid,
			'cardsend' => $totcard,
			'buying_dt' => date('Y-m-d')
		);
		$this->db->where('user_id', $userid);
		$this->db->update('user', $data);
		
		
	}
	
	function cardsell($userid,$restcard)
	{
		$data = array(
			'cardsend' => $restcard,
		);
		$this->db->where('user_id', $userid);
		$this->db->update('user', $data);
	}
	
	function downloadcount($userid,$imgid)
	{
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_id',$userid);
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		
		if(!empty($data['dncard']))
		$cards_arr = explode(',',$data['dncard']);
		else
		$cards_arr = array();
		
		//print_r($cards_arr);
		//!in_array($imgid,$cards_arr);
		
		//if true then decrement value 1 else 0
		$dn_flag = !in_array($imgid,$cards_arr) ? 1 : 0;
		
		if($dn_flag == 1)
		{
			if(empty($cards_arr))
				$c_arr = $imgid;
			else
				$c_arr = $data['dncard'].','.$imgid;
				
			$data = array(
			'dncard' => $c_arr,
			);
			$this->db->where('user_id', $userid);
			$this->db->update('user', $data);
		}
		
		return $dn_flag;
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
	
	function updateUserDtls($id){
		$data = array(
				'time_check' => date('Y-m-d H:i:s')       
			);
		$this->db->where('user_id', $id);
		$this->db->update('user', $data);
	}

	
	
	
	
	
	


	function imgPictureInsert($image_name,$user_id,$text){
            $data = array(
			'image_name'=> $image_name,
			'user_id' => $user_id,
			'text' => $text
		);            
            
		$this->db->insert('picture', $data);
		return $this->db->insert_id();
    }
	
	function getUserPictureCount($user){
		$query = $this->db->get_where('picture', array('user_id' => $user ));
		$count = $query->num_rows();
		
		if($count>0)
			return $count;
		else
			return 0;
	}
	
	/* Function to update card delivery details
	*
	*
	*/
	function updateDeliveryDetails($addData)
	{
		$data = array(
			'name' => $addData['name'],
			'country' => $addData['country'],
            'state' => $addData['state'],
			'city' => $addData['city'],
			'zipcode' => $addData['zipcode'],
			'contactno' => $addData['contact_no'],
			'reciver_add1' => $addData['street_address'],
			'delivery_dt' => date("Y-m-d", strtotime($addData['delivery_date']))
		); 
		
		$this->db->where('img_id', $addData['card_id']);
		$this->db->where('user_id', $addData['user_id']);
		$this->db->update('img', $data);
		//echo $this->db->last_query();//exit;
		
		return ($this->db->affected_rows() > 0) ? 1 : 0;
	}
	
	/* Fuction to update user login password.
	*
	*/
	function updateUserPassword($userid,$password){
		$data = array(
			'rem_pass' => $password,
			'pass' => md5($password),
		); 
		
		$this->db->where('user_id', $userid);
		$this->db->update('user', $data);
		
		return ($this->db->affected_rows() > 0) ? 1 : 0;
	}
	
	function validateUserLogin($email,$password){
		$query = $this->db->get_where('user', array('email' => $email,'rem_pass'=> $password ));
		$count = $query->num_rows();
		$data = $query->row_array();
		
		return ($count>0) ? $data : 0;	
	}	
	
	
	function initPicture()
	{
		$this->db->insert('cards_temppic',array('text'=>''));
		return $this->db->insert_id();

	}
	
	function getPicInfo($id)
	{
		$this->db->select('*');
		$this->db->from('temppic');
		$this->db->join('tempimages','temppic.pic_id = tempimages.pic_id','left');
		$this->db->where('temppic.pic_id',$id);
		return $this->db->get()->result_array();
	}
	
	function addPicture($pic_id,$image_name)
	{
		$this->db->insert('tempimages',array('pic_id'=>$pic_id,'pic_name'=>$image_name));	
		return	$this->db->insert_id();
	
	}
	
	function deletePicture($img_id)
	{
		$this->db->where('img_id',$img_id);
		$this->db->delete('tempimages');
		
		return $this->db->affected_rows();
	
	}
	
	function updateText($pic_id,$text)
	{
		$this->db->where('pic_id',$pic_id);
		$this->db->update('temppic',array('text'=>nl2br($text)));
	}
	
	function updateFinalPic($picInfo)
	{

		$path = 'media/temp/'.$this->session->userdata('pic_id');		
		$scan_path = scandir($path);
		
		
		foreach($scan_path as $key=>$value)
		{
			if($key==0 || $key==1 || $value=='thumb')
				continue;
						
			copy($path.'/'.$value,'media/pics/'.$value);	
		}
		
		
		
		$path = 'media/temp/'.$this->session->userdata('pic_id').'/thumb';
		
		$scan_path = scandir($path);
		
		foreach($scan_path as $key=>$value)
		{
			if($key==0 || $key==1)
				continue;
				
			copy($path.'/'.$value,'media/pics/thumb/'.$value);
		}

		
	
		$this->deleteDir('media/temp/'.$this->session->userdata('pic_id').'/');
	
		$pic_receiver = $this->session->userdata('pic_receiver');
	
		$picText = $picInfo[0]['text'];
		
		$data = array(
			'text'=>$picText,
			'user_id'=>$this->session->userdata('user_id'),
			'email'=>'',
			'name'=>$pic_receiver['rname'],
			'lname'=>$pic_receiver['lname'],
			'country'=>$pic_receiver['r_country'],
			'state'=>$pic_receiver['state'],
			'city'=>$pic_receiver['r_city'],
			'zipcode'=>$pic_receiver['r_zip'],
			'reciver_add1'=>$pic_receiver['radd1'],
			'delivery_dt'=>date('Y-m-d',strtotime($pic_receiver['d_dt'])),
			'post_date'=>date('Y-m-d'),
			'contactno'=>$pic_receiver['conno'],
		);
		
	//	if(isset($pic_receiver['keepadd']))
			$data['active_status'] = 1;
		
		$this->db->insert('pic',$data);

		$pic_id = $this->db->insert_id();
		
		$this->session->set_userdata('finpic_id',$pic_id);	
		
		foreach($picInfo as $key=>$value)
		{
			$data = array(
				'pic_id'=>$pic_id,
				'user_id'=>$this->session->userdata('pic_id'),
				'image_name'=>$value['pic_name']	
			);
			
			$this->db->insert('picimg',$data);
		}
		
		$this->db->where('pic_id',$this->session->userdata('pic_id'));
		$this->db->delete('temppic');
		
		$this->db->where('pic_id',$this->session->userdata('pic_id'));
		$this->db->delete('tempimages');
		
		
		 require_once(realpath(APPPATH."helpers/dompdf")."/dompdf_config.inc.php");
		 $this->load->helper(array('dompdf', 'file'));
		 
		 
		$pictureInfo =  $this->finishedPictureInfo($this->session->userdata('finpic_id'));
		
		 $pdf_content = '<div id="privacy" style="  color: #464646;font-size: 14px;line-height: 22px;padding: 10px 0;"><div id="new_pictures" class="picture clearfix" style="display: table;line-height:0;clear:both;">';
		 
			$count = 0;
			
			$counter = count($pictureInfo)-1;
			$value = $pictureInfo;
			$j=0;
		 
		 for($i=$counter;$i>0;$i--)
		 {
			
			if($count==0)
			{
				$pdf_content = $pdf_content.'<div style="width:100%;margin:auto;">';
				$j++;
			}	
			
			$pdf_content .= '<div class="add_pic" style="position: relative;float:left;margin-right: 16px;margin-top: 14px;"><img style="float:left;border: 5px solid #FFFFFF;box-shadow: 0 0 4px 0 #B2B2B2;height:141px"  src="'.base_url().'/media/pics/'.$value[$i]['image_name'].'"/></div>';
			
			$count++;
			if($count==4)
			{
				$count=0;$pdf_content = $pdf_content."</div><div style=\"clear:both\"></div>";
				
			}
		}	
		 
		 if($count!=4)
			$pdf_content = $pdf_content."</div><div style=\"clear:both\"></div>";
		 
		 $pdf_content .= '</div></div>'; 
		 
		 $pdf_content .= '<div style="clear:both;" ></div><div class="picrea" style="color: #464646;font-size: 14px;line-height: 22px;position:relative;top:'. 175*$j. 'px"><div id="addText" class="txtarea" style=" border: 1px solid #C4C4C4;border-radius: 8px;box-shadow: 0 3px 4px rgba(0, 0, 0, 0.1) inset;color: #7B7B7B;font-family: \'DroidSans\';font-size: 16px;min-height: 100px;padding: 10px 12px;width: 90%;" >'.$value[0]['text'].'</div><br/><br/>
		 <div style="margin:auto;text-align:center;" id="marker"><div style="margin:auto;" id="logo"><a><img border="0" alt="" src="'.$this->config->item('base_url').'/themes/frontend/images/logo.png"></a></div><div style="margin:auto;" id="link"><a>www.cardsleaf.com</a></div></div>
		 </div>';
		 
		 $pdf_content .= '';
		
		 
		 

		  
		$data_allpage = pdf_create($pdf_content, '', false);
	    write_file('./media/pics/pdf/'.$this->session->userdata('finpic_id').'.pdf', $data_allpage);

		return;
	}
	
	
	function finishedPictureInfo($finpicInfo)
	{
		$this->db->select('cards_pic.*,cards_picimg.*,c.*,s.name as sname,c.country_name as cname');
		$this->db->from('cards_pic');
		$this->db->join('cards_picimg','cards_pic.pic_id = cards_picimg.pic_id');
		$this->db->join('country as c','c.country_id = cards_pic.country');
		$this->db->join('state` as s','s.state_id = cards_pic.state');
		$this->db->where('cards_pic.pic_id',$finpicInfo);
		return $this->db->get()->result_array();
		

	
	
	}
	
	
	function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}	
	
	
	
	
	
	

}

?>