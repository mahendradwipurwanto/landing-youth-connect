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
        ->from('m_programs_faq_categories')
        ->where(['deleted_at' => null])
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

    function getFaqLists($m_programs_faq_categories_id = null){
        $this->db->select('id, faq, content, order, created_at')
        ->from('m_programs_faq')
        ->where(['m_programs_faq_categories_id' => $m_programs_faq_categories_id, 'deleted_at' => null])
        ->order_by('order ASC')
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    // HOME SWIPER
    function getHomeSwiper(){
        $this->db->select('*')
        ->from('tb_swiper')
        ->where(['page_code' => 'home', 'deleted_at' => null])
        ->order_by('order ASC')
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    function getHomeComponents($key){
        $this->db->select('*')
        ->from('m_home')
        ->where(['deleted_at' => null, 'key' => $key])
        ;

        return $this->db->get()->row()->value;
    }
}
