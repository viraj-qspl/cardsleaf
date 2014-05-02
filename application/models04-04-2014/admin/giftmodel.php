<?php

/**
 * Description of giftmodel
 *
 * @author sanjib
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giftmodel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    function getGifts($id=NULL,$is_active = 1)
    {
        $this->db->from('gifts');
        if($is_active ==1)
        {
            $this->db->where('is_active',$is_active);
        }
        if($id != NULL)
        {
            $this->db->where('id',$id);
            $q = $this->db->get();
            return $q->row_array();
        }
        else
        {
            
            $q = $this->db->get();
            return $q->result_array();
        }
    }
    function changeStatus($id,$status)
    {
        $data['is_active'] = !$status;
        $this->db->where('id',$id);
        $this->db->update('gifts',$data);
    }
    
    function saveGift($img_info)
    {
        $data = array(
            'gift_title' => $this->input->post('gift_name'),
            'gift_coins' => $this->input->post('gift_coins'),
            
        );
        if(!empty($img_info))
        {
            $data = array_merge($data,array('gift_image' => $img_info['file_name']));
        }
        
        $id = $this->input->post('id');
        if(!empty($id))
        {
            $this->db->where('id',$id);
            $this->db->update('gifts',$data);
        }
        else
        {
            $this->db->insert('gifts',$data);
        }
    }
    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('gifts');
    }
    function delete_plan($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('gifts_plans');
    }
    
    function saveUserGifts()
    {
        $g_ids = explode(',', $this->input->post('gift_ids'));
        for ($i=0;$i<count($g_ids);$i++)
        {
            $data = array(
                'to_id' => $this->input->post('to_id'),
                'from_id' => $this->input->post('from_id'),
                'gift_id' => $g_ids[$i],
            );     
            
            $this->db->insert('user_gifts',$data);
        }
        
        $q = 'update '.$this->db->dbprefix('user').' set rem_gift_coins = rem_gift_coins - '.  $this->input->post('total_value') .' where user_id='.$this->input->post('from_id');
        $this->db->query($q);
    }
    
    function getGiftPlans($id = NULL)
    {
        $this->db->from('gifts_plans');
        
        if($id != NULL)
        {
            $this->db->where('id',$id);
            $q = $this->db->get();
            return $q->row_array();
        }
        else
        {
            $q = $this->db->get();
            return $q->result_array();
        }
        
    }
    function addPlan()
    {
        $data = array(
            'plan_name' => $this->input->post('gift_plan_name'),
            'tot_coins' => $this->input->post('tot_coins'),
            'rel_price' => $this->input->post('rel_price'),
           );
        
        $id = $this->input->post('id');
        if(!empty($id))
        {
            $this->db->where('id',$id);
            $this->db->update('gifts_plans',$data);
        }
        else
        {
            $this->db->insert('gifts_plans',$data);
        }
    }
    
    function getUserGifts($user_id)
    {
        $this->db->from('user_gifts as ug');
        
        $this->db->where('ug.to_id', $user_id );
        
        $this->db->join('gifts as g','g.id=ug.gift_id');
        
        $this->db->join('user as u','ug.from_id = u.user_id');
        
        $this->db->select('u.fname,u.lname,g.gift_image');
        
        $q = $this->db->get();
        
        return $q->result_array();
    }
    
    public function creditCoins($user_id,$plan_id)
    {
        $plan_info = $this->getGiftPlans($plan_id);
        
        $q = 'update '.$this->db->dbprefix('user').' set rem_gift_coins = rem_gift_coins + '.  $plan_info['tot_coins'] .' where user_id='.$user_id;
        $this->db->query($q);
    }
}

/* end of file giftmodel.php */