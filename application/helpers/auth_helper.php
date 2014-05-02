<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function isAdminLoggedIn()
{
	$CI =& get_instance();
	$admin_id = $CI->session->userdata('admin_id');
	if($admin_id == '')
	{
		return false;
	}
	else
	{
		return true;	
	}
}

function isMemberLoggedIn()
{
	$CI =& get_instance();
	$member_id = $CI->session->userdata('user_id');
	if($member_id == '') return 0; else return 1;
}

?>