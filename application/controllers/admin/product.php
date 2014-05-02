<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mproduct');
		$this->load->model('mcategory');
		$this->load->model('member');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->library('image_lib');
		$this->load->model('mcolor');
		$this->load->model('msize');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["products"] = $this->mproduct->getAllProduct();
			

		$data["site_title"] = 'Product manager';
		$data["menu_title"] = 'Product Manager: Add Product';
		$this->load->view('product', $data);
	}
	
	# Add product #
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$category = $this->input->post('parents');
			foreach($category as $key => $value)
			{
				if($value=='')
				{
					unset($category[$key]);	
				}
			}
			
			$_POST["cat_id"] = $category[count($category)-1];
			
			$product_id = $this->mproduct->addProduct();
			
			$product_image = $this->do_upload('imgfile');
			$this->mproduct->addProductImages($product_image, $product_id);
			
			$this->session->set_userdata('success_msg', 'Product added successfully.');
			
			if($this->input->post('action')=='save')
			redirect("admin/product/add".'/'.$this->input->post('parent_id'));
			
			if($this->input->post('action')=='save_new')
			redirect("admin/product/index".'/'.$this->input->post('parent_id'));
		}
		
		
		$data["parent"] = $this->mcategory->getAllParentCategory();
		$data["merchants"] = $this->member->getAllMerchants();
		
		$data["color"] = $this->mcolor->getAllColor();
		$data["size"] = $this->msize->getAllSize();
		
		$data["site_title"] = 'Add product';
		$this->load->view('product_add', $data);
	}
	
	# Image upload function #
	function do_upload($field_name)
	{
		$name_array = array();
		$count = count($_FILES[$field_name]['size']);
		
		foreach($_FILES as $key=>$value) 
		for($s=0; $s<=$count-1; $s++) 
		{			
			$_FILES['image']['name']= $value['name'][$s];
			$_FILES['image']['type']    = $value['type'][$s];
			$_FILES['image']['tmp_name'] = $value['tmp_name'][$s];
			$_FILES['image']['error']       = $value['error'][$s];
			$_FILES['image']['size']    = $value['size'][$s];   			
			
			$config['upload_path'] = './media/products/large/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '500';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->load->library('upload', $config);
			
			
			if ( ! $this->upload->do_upload('image'))
			{
				$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				$data = array('upload_data' => $this->upload->data('image'));
				$unique_file_name = uniqid();
				$new_imgname = $unique_file_name.$data["upload_data"]['file_ext'];
				$new_imgpath = $data["upload_data"]['file_path'].$new_imgname;
				rename($data["upload_data"]['full_path'], $new_imgpath);
				$product_image[$s] = $new_imgname;				
				
				$config['width'] = 124;
				$config['height'] = 124;
				$config['maintain_ratio'] = FALSE;
				$config['source_image'] = './media/products/large/'.$unique_file_name.$data["upload_data"]["file_ext"];
				$config['new_image'] = './media/products/thumb/thumb_'.$unique_file_name.$data["upload_data"]["file_ext"];
				
				$this->image_lib->initialize($config); 
				$this->image_lib->resize();
	
				if ( ! $this->image_lib->resize())
				{
					echo $this->image_lib->display_errors();
				}
			}			
		}		
		
		return $product_image;		
	}
	
	public function edit()
	{		
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$category = $this->input->post('parents');
			foreach($category as $key => $value)
			{
				if($value=='')
				{
					unset($category[$key]);	
				}
			}
			
			$_POST["cat_id"] = $category[count($category)-1];
			
			$product_id = $this->mproduct->addProduct();
			
			$product_image = $this->do_upload('imgfile');
			$this->mproduct->addProductImages($product_image, $product_id);
			
			$this->session->set_userdata('success_msg', 'Product updated successfully.');
			
			if($this->input->post('action')=='save')
				redirect("admin/product/edit".$this->input->post('parent_id'));
			
			if($this->input->post('action')=='save_new')
				redirect("admin/product/index".'/'.$this->input->post('parent_id'));					
		}
		
		
		
		$pro_id = $this->uri->segment(4);
		
		$data["pro_id"] = $pro_id;
		$data["site_title"] = 'Edit Product';
		$data["product"] = $this->mproduct->getProductById($pro_id);
		$data["parent"] = $this->mcategory->getAllParentCategory();
	
		$data["merchants"] = $this->member->getAllMerchants();		
		$data["brands"] = $this->member->getAllMerchantsBrand($data["product"]['merchant_id']);
		
		$data["color"] = $this->mcolor->getAllColor();
		$data["size"] = $this->msize->getAllSize();
		
		$cat_id = $data["product"]["cat_id"];
		
		$str = $this->mcategory->getCatgeoryByLevel($cat_id);
		$cat_str = substr($str,0,-1);
		
		//echo $cat_str;
		//exit;
		
		
		$cat_arr = explode('|',$cat_str);
		
		$data["parents"] = $cat_arr;
		//echo '<pre>'.print_r($data["parents"],true).'</pre>';
		//exit;
		
		
		$this->load->view('product_edit', $data);								
	}
}

?>