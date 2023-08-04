<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_master extends CI_Model
{
    protected $_program_id = 1;
    
    public function __construct()
    {
        parent::__construct();
    }

    function getNationalitySearch($word = null){
        $this->db->select('*')
        ->from('m_countries')
        ->like('en_short_name', $word)
        ;

        $models = $this->db->get()->result();

        $arr = [];
        if(!empty($models)){
            foreach($models as $key => $val){
                $arr[$key]['id'] = $val->num_code;
                $arr[$key]['text'] = $val->en_short_name;
            }
        }
        // $option = [
        //     'id' => -1,
        //     'text' => 'Can`find? Add new nationality'
        // ];
        // array_unshift($arr, $option);
        return json_encode($arr);
    }

    // faq
    function get_masterFaqContent()
    {
        $this->db->select('a.*, b.name')
        ->from('m_programs_faq_categories a')
        ->join('access_user b', 'a.created_by = b.user_id', 'left')
        ->where(['a.deleted_at' => null])
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    // faq

    public function addMasterFaq()
    {
        $title = $this->input->post('title');

        $data = [
            'title' => $title,
            'order' => $this->db->get_where('m_programs_faq_categories', ['deleted_at' => null])->num_rows(),
            'created_at' => time(),
            // 'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('m_programs_faq_categories', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editMasterFaq()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');

        $data = [
            'title' => $title,
            'updated_at' => time(),
            // 'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('m_programs_faq_categories', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteMasterFaq()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('m_programs_faq_categories', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function addFaq()
    {
        $faq = $this->input->post('faq');
        $m_programs_faq_categories_id = $this->input->post('m_programs_faq_categories_id');
        $answer = $this->input->post('answer');

        $data = [
            'faq' => $faq,
            'm_programs_faq_categories_id' => $m_programs_faq_categories_id,
            'content' => $answer,
            'order' => $this->db->get_where('m_programs_faq', ['m_programs_faq_categories_id' => $m_programs_faq_categories_id, 'deleted_at' => null])->num_rows(),
            'created_at' => time(),
            // 'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('m_programs_faq', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editFaq()
    {
        $id = $this->input->post('id');
        $faq = $this->input->post('faq');
        $answer = $this->input->post('answer');

        $data = [
            'faq' => $faq,
            'content' => $answer,
            'updated_at' => time(),
            // 'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('m_programs_faq', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteFaq()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('m_programs_faq', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function get_paymentsBatch(){
        $this->db->select('*')
        ->from('m_payments_batch')
        ->where(['deleted_at' => null])
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    function get_paymentsBatchByID($id = null){
        $this->db->select('*')
        ->from('m_payments_batch')
        ->where(['id' => $id])
        ;

        $models = $this->db->get()->row();

        return $models;
    }

    public function addPaymentBatch()
    {
        $summit = $this->input->post('summit');
        $active = $this->input->post('active');
        $description = $this->input->post('desc');
        $amount = $this->input->post('amount');
        $amount_usd = $this->input->post('amount_usd');

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data = [
            'summit' => $summit,
            'active' => $active == 'on' ? 1 : 0,
            'description' => $description,
            'amount' => $amount,
            'amount_usd' => $amount_usd,
            'start_date' => strtotime($start_date),
            'end_date' => strtotime($end_date),
            'created_at' => time(),
            // 'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('m_payments_batch', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editPaymentBatch()
    {
        $id = $this->input->post('id');
        $summit = $this->input->post('summit');
        $active = $this->input->post('active');
        $description = $this->input->post('desc');
        $amount = $this->input->post('amount');
        $amount_usd = $this->input->post('amount_usd');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data = [
            'summit' => $summit,
            'active' => $active == 'on' ? 1 : 0,
            'description' => $description,
            'amount' => $amount,
            'amount_usd' => $amount_usd,
            'start_date' => strtotime($start_date),
            'end_date' => strtotime($end_date),
            'updated_at' => time(),
            // 'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('m_payments_batch', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deletePaymentBatch()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('m_payments_batch', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function changeParticipanPassword(){
        $user_id = $this->input->post('id');
        $password = $this->input->post('pass');

        $this->db->where(['user_id' => $user_id]);
        $this->db->update('access_auth', ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function changeParticipanEmail(){
        $user_id = $this->input->post('id');
        $email = $this->input->post('email');

        $this->db->where(['user_id' => $user_id]);
        $this->db->update('access_auth', ['email' => $email]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function getDocuments(){
        $this->db->select('*')
        ->from('m_documents')
        ->where(['deleted_at' => null])
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    function getParticipansEssay(){
        $this->db->select('a.*')
        ->from('m_programs_essay a')
        ->where(['a.deleted_at' => null])
        ;

        $models = $this->db->get()->result();

        return $models;
    }

    function getAmbasadorByReferral($referral_code = null){
        return $this->db->get_where('tb_ambassador', ['referral_code' => $referral_code, 'status' => 1, 'deleted_at' => null])->row();
    }

    function getAllAmbassador(){
        $models = $this->db->get_where('tb_ambassador', ['deleted_at' => null])->result();

        foreach($models as $key => $val){
            $val->affiliate = $this->countAffiliateAmbassador($val->referral_code);
        }

        usort($models, function ($data1, $data2) {
            return $data2->affiliate <=> $data1->affiliate;
        });

        return $models;
    }

    function countAffiliateAmbassador($referral_code){
        return $this->db->get_where('tb_participants', ['referral_code' => $referral_code, 'deleted_at' => null])->num_rows();
    }

    public function addAmbassador($poster = null)
    {
        $fullname           = $this->input->post('fullname');
        $referral_code      = $this->input->post('referral_code');
        $email              = $this->input->post('email');
        $address            = $this->input->post('address');
        $whatsapp    = $this->input->post('whatsapp');
        $nationality        = $this->input->post('nationality');
        $instagram          = $this->input->post('instagram');
        $tiktok             = $this->input->post('tiktok');
        $institution        = $this->input->post('institution');
        $occupation         = $this->input->post('occupation');

        $data = [
            'fullname' => $fullname,
            'referral_code' => $referral_code,
            'email' => $email,
            'address' => $address,
            'whatsapp' => $whatsapp,
            'nationality' => $nationality,
            'instagram' => $instagram,
            'tiktok' => $tiktok,
            'institution' => $institution,
            'occupation' => $occupation,
            // 'created_by' => $this->session->userdata('user_id'),
            'created_at' => time()
        ];

        $this->db->insert('tb_ambassador', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editAmbassador($photo = null)
    {
        $id                 = $this->input->post('id');
        $fullname           = $this->input->post('fullname');
        $referral_code      = $this->input->post('referral_code');
        $email              = $this->input->post('email');
        $address            = $this->input->post('address');
        $whatsapp    = $this->input->post('whatsapp');
        $nationality        = $this->input->post('nationality');
        $instagram          = $this->input->post('instagram');
        $tiktok             = $this->input->post('tiktok');
        $institution        = $this->input->post('institution');
        $occupation         = $this->input->post('occupation');

        if($photo == null){
            $data = [
                'fullname' => $fullname,
                'referral_code' => $referral_code,
                'email' => $email,
                'address' => $address,
                'whatsapp' => $whatsapp,
                'nationality' => $nationality,
                'instagram' => $instagram,
                'tiktok' => $tiktok,
                'institution' => $institution,
                'occupation' => $occupation,
                // 'modified_by' => $this->session->userdata('user_id'),
                'updated_at' => time()
            ];
        }else{
            $data = [
                'fullname' => $fullname,
                'referral_code' => $referral_code,
                'email' => $email,
                'address' => $address,
                'whatsapp' => $whatsapp,
                'nationality' => $nationality,
                'instagram' => $instagram,
                'tiktok' => $tiktok,
                'institution' => $institution,
                'occupation' => $occupation,
                // 'modified_by' => $this->session->userdata('user_id'),
                'updated_at' => time()
            ];
        }

        $this->db->where('id', $id);
        $this->db->update('tb_ambassador', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteAmbassador()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_ambassador', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function get_masterEligilibity(){
        return $this->db->get_where('m_eligilibity_countries', ['deleted_at' => null])->result();
    }

    public function addEligilibity()
    {
        $nationality            = $this->input->post('nationality');
        $continent              = $this->input->post('continent');
        $type_visa              = $this->input->post('type_visa');
        $issued_from            = $this->input->post('issued_from');

        $data = [
            'nationality' => $nationality,
            'continent' => $continent,
            'type_visa' => $type_visa,
            'issued_from' => $issued_from,
            // 'created_by' => $this->session->userdata('user_id'),
            'created_at' => time()
        ];

        $this->db->insert('m_eligilibity_countries', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editEligilibity()
    {
        $id                     = $this->input->post('id');
        $nationality            = $this->input->post('nationality');
        $continent              = $this->input->post('continent');
        $type_visa              = $this->input->post('type_visa');
        $issued_from            = $this->input->post('issued_from');

        $data = [
            'nationality' => $nationality,
            'continent' => $continent,
            'type_visa' => $type_visa,
            'issued_from' => $issued_from,
            // 'modified_by' => $this->session->userdata('user_id'),
            'updated_at' => time()
        ];


        $this->db->where('id', $id);
        $this->db->update('m_eligilibity_countries', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteEligilibity()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('m_eligilibity_countries', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
