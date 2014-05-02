<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcategory');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$cat_id = $this->uri->segment(4);
		if($cat_id=='')
		{
			$data["cat_id"] = 0;
			$data["category"] = $this->mcategory->getAllParentCategoryList();
			$data["site_title"] = 'Category manager';
			$data["menu_title"] = 'Category Manager: Add new Category';
		}
		else
		{
			$data["cat_id"] = $cat_id;
			$data["category"] = $this->mcategory->getSubcategoryById($cat_id);
			$data["site_title"] = 'Category manager';
			$data["menu_title"] = 'Category Manager: Add sub Category';
		}
		
		
		
		$this->load->view('category', $data);
	}
	
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$cat_id = $this->mcategory->addCategory();
			$this->session->set_userdata('success_msg', 'Category added successfully.');
			
			if($this->input->post('action')=='save')
			redirect("admin/category/add".'/'.$this->input->post('parent_id'));
			
			if($this->input->post('action')=='save_new')
			redirect("admin/category/index".'/'.$this->input->post('parent_id'));
		}
		
		$cat_id = $this->uri->segment(4);
		if($cat_id=='')
		{
			$data["cat_id"] = 0;
		}
		else
		{
			$data["cat_id"] = $cat_id;
		}
		
		
		$data["site_title"] = 'Add category';
		$this->load->view('category_add', $data);
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
			
			$parent_id = $category[count($category)-1];
			$this->mcategory->editCategory($parent_id);
			$this->session->set_userdata('success_msg', 'Category edited successfully.');
			
			if($this->input->post('action')=='save')
			redirect("admin/category/add".'/'.$this->input->post('parent_id'));
			
			if($this->input->post('action')=='save_new')
			redirect("admin/category/index".'/'.$this->input->post('parent_id'));
			
		}
		
		
		
		$cat_id = $this->uri->segment(4);
		
		$data["cat_id"] = $cat_id;
		$data["site_title"] = 'Edit category';
		$data["category"] = $this->mcategory->getCategoryById($cat_id);
		$data["parent"] = $this->mcategory->getAllParentCategory();
		
		
		$this->load->view('category_edit', $data);
		
	}
	
	
	public function changeStatus()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$category = $this->input->post('category');
			$this->mcategory->changeStatusByLevel($category);
			
			$this->session->set_userdata('success_msg', 'Category status changed successfully.');
			
			if($this->input->post('cat_id')!=0)
				redirect("admin/category/index".'/'.$this->input->post('cat_id'));
			else
				redirect("admin/category/index");
		}
	}
	
	/*
	public function action()
	{
		$func = $this->input->post('func');
		$this->$func();
	}
	*/
	
}

?>