<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ambassador extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getAmbassadorByEmail($email = null){
        $this->db->select('*')
        ->from('tb_ambassador')
        ->where(['email' => $email])
        ;

        $ambassador = $this->db->get();
        
        if ($ambassador->num_rows() > 0) {
            return [
                'status' => true,
                'data' => $ambassador->row()
            ];
        } else {
            return [
                'status' => false,
                'data' => null
            ];
        }
    }

    function getAmbassadorDetailBySession(){
        $this->db->select('*')
        ->from('tb_ambassador')
        ->where(['id' => $this->session->userdata('user_id')])
        ;

        $ambassador = $this->db->get()->row();

        return $ambassador;
    }

    function getStatistik(){
        $this->db->select('a.*, b.referral_code as affiliate_code')
        ->from('tb_participants a')
        ->join('tb_auth b', 'a.user_id = b.user_id')
        ->where('a.is_deleted', 0)
        ->where('a.referral_code', $this->session->userdata('referral_code'))
        ->or_where('b.referral_code', $this->session->userdata('referral_code'))
        ;

        $affiliate = $this->db->get()->result();

        $total = 0;
        $submission = 0;
        foreach($affiliate as $key => $val){
            $total += 1;

            if($val->status > 1){
                $submission += 1;
            }
        }

        return [
            'total' => $total,
            'submission' => $submission
        ];
    }

    function getAffiliate(){
        $this->db->select('a.*, b.email, b.referral_code as affiliate_code, c.*')
        ->from('tb_participants a')
        ->join('tb_auth b', 'a.user_id = b.user_id')
        ->join('tb_user c', 'a.user_id = c.user_id')
        ->where('a.is_deleted', 0)
        ->where('a.referral_code', $this->session->userdata('referral_code'))
        ->or_where('b.referral_code', $this->session->userdata('referral_code'))
        ;

        $affiliate = $this->db->get()->result();

        return $affiliate;
    }

}
