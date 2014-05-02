<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcategory');
		$this->load->model('mstate');
		$this->load->model('mcity');
		$this->load->model('mbrand');
		$this->load->helper('auth');
	}
	
	function getSubCat()
	{
		
		
		$cat_id = $this->uri->segment(4);
		
		
		$data = $this->mcategory->getSubcategoryById($cat_id);
		//echo '<pre>'.print_r($data,true).'</pre>';
		//exit;
		
		$str = '';
		for($i=0; $i<count($data); $i++)
		{
			$str .= $data[$i]["id"].'#'.$data[$i]["cat_name"];
			$str .= '|';
		}
		echo substr($str,0,-1);
		exit;
		
		
	}
	
	function getSubCatFEnd()
	{
		$cat_id = $this->uri->segment(4);
		
		$data = $this->mcategory->getSubcategoryById($cat_id);
		//echo '<pre>'.print_r($data,true).'</pre>';
		//exit;
		
		$str = '';
		for($i=0; $i<count($data); $i++)
		{
			$str .= $data[$i]["id"].'#'.$data[$i]["cat_name"];
			$str .= '|';
		}
		echo substr($str,0,-1);
		exit;				
	}
	
	function getStateList()
	{
		$country_id = $this->uri->segment(4);
		$data = $this->mstate->getStateByCountry($country_id);
		
		$str = '';
		for($i=0; $i<count($data); $i++)
		{
			$str .= $data[$i]["id"].'#'.$data[$i]["name"];
			$str .= '|';
		}
		echo substr($str,0,-1);
		exit;
	}
	
	function getCityList()
	{
		$state_id = $this->uri->segment(4);
		$data = $this->mcity->getCityByState($state_id);
		
		
		$str = '';
		for($i=0; $i<count($data); $i++)
		{
			$str .= $data[$i]["id"].'#'.$data[$i]["name"];
			$str .= '|';
		}
		echo substr($str,0,-1);
		exit;
	}
	
	function getBrandList()
	{
		$merchant_id = $this->uri->segment(4);
		$data = $this->mbrand->getBrandByMerchant($merchant_id);
		
		
		$str = '';
		for($i=0; $i<count($data); $i++)
		{
			$str .= $data[$i]["id"].'#'.$data[$i]["brand_name"];
			$str .= '|';
		}
		echo substr($str,0,-1);
		exit;
	}

}

?>