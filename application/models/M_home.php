<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getFaqAll(){
        $this->db->select('id, title, order, created_at')
        ->from('m_faq')
        ->where(['is_deleted' => 0])
        ->order_by('order asc');
        ;

        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $models[$key]->lists = $this->getFaqLists($val->id);
        }

        foreach($models as $key => $val){
            if($val->lists == null){
                unset($models[$key]);
            }
        }

        return $models;
    }

    function getFaqLists($m_faq_id = null){
        $this->db->select('id, faq, content, order, created_at')
        ->from('tb_faq')
        ->where(['m_faq_id' => $m_faq_id, 'is_deleted' => 0])
        ->order_by('order ASC')
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    // HOME SWIPER
    function getHomeSwiper(){
        $this->db->select('*')
        ->from('tb_swiper')
        ->where(['page_code' => 'home', 'is_deleted' => 0])
        ->order_by('order ASC')
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    function getHomeComponents($key){
        $this->db->select('*')
        ->from('m_home')
        ->where(['is_deleted' => 0, 'key' => $key])
        ;

        return $this->db->get()->row()->value;
    }
}
