<?php

/**
 * Description of gifts
 *
 * @author sanjib
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gifts  extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->theme('admintheme');
        $this->load->helper('auth');
        $this->load->model('admin/giftmodel');
        if(!isAdminLoggedIn())
        {
                redirect("admin/home/login");
        }        
        
        $this->data['site_title'] = 'Manage Gifts And Plans';
    }
    
    public function index()
    {
        $this->data['gift_info'] = $this->giftmodel->getGifts(NULL,NULL);
        $this->load->view('list_gifts',  $this->data);
    }
    public function change_status($id,$status)
    {
        $this->giftmodel->changeStatus($id,$status);
        redirect('admin/gifts');
    }
    public function add_gifts($id=NULL)
    {
        if($this->input->post())
        {
            $img_info = array();
            $fl = 1;
            if(!empty($_FILES['gift_image']['name']))
            {
                $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['min_width']  = '124';
		$config['min_height']  = '97';
                                    

                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);
                if($this->upload->do_upload('gift_image'))
                {
                    $img_info = $this->upload->data();
                    $img_config['image_library'] = 'gd2';
                    $img_config['source_image'] = './uploads/'.$img_info['file_name'];
                    $img_config['thumb_marker'] = '';
                    $img_config['create_thumb'] = TRUE;
                    $img_config['maintain_ratio'] = TRUE;
                    
                    $img_config['width'] = 124;
                    $img_config['height'] = 97;
                    
                    $this->load->library('image_lib', $img_config);

                    if ( ! $this->image_lib->resize())
                    {
                        echo $this->image_lib->display_errors();
                        $fl = 0;
                    }
                    
                }
                else
                {
                    $err = $this->upload->display_errors('<p>', '</p>');
                    $fl = 0;
                    $this->session->set_flashdata('msg',$err);
                }
            }
            if($fl)
            {
                $this->giftmodel->saveGift($img_info);
                redirect('admin/gifts/');
            }
        }
        
        if($id != NULL)
        {
            //edit
            $this->data['gift_info'] = $this->giftmodel->getGifts($id);
        }
       
        $this->load->view('create_gift',  $this->data);
    }
    public function delete($id) 
    {
        $gift_info = $this->giftmodel->getGifts($id);
        $config['upload_path'] = './uploads/';
        unlink($config['upload_path'].'/'.$gift_info['gift_image']);
        $this->giftmodel->delete($id);
        redirect('admin/gifts/');
    }
    
    public function gift_plans()
    {
        $this->data['gift_plans'] = $this->giftmodel->getGiftPlans();
        
        $this->load->view('gift_plans',  $this->data);
        
    }
    
    public function add_gifts_plan($id = NULL) {
        
        if($this->input->post())
        {
            $this->giftmodel->addPlan();
            redirect('admin/gifts/gift_plans');
        }
        if($id != NULL)
        {
            $this->data['plan_info'] = $this->giftmodel->getGiftPlans($id);
        }
        $this->load->view('add_gift_plan',  $this->data);
    }
    
    public function delete_plan($id)
    {
        $this->giftmodel->delete_plan($id);
        redirect('admin/gifts/gift_plans');
    }
}

/* end of file gists.php */