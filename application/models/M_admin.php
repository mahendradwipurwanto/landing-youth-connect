<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    protected $_program_id = 1;
    
    public function __construct()
    {
        parent::__construct();
    }

    // global
    function get_settingsValue($key){
        return $this->db->get_where('m_settings', ['key' => $key])->row()->value;
    }

    function countDashboard(){

        $proyek = $this->db->get_where('tb_proyek', ['deleted_at' => null])->num_rows();
        $leader = $this->db->get_where('access_auth', ['role' => 2, 'status' => 1])->num_rows();
        $staff = $this->db->get_where('access_auth', ['role' => 3, 'status' => 1])->num_rows();
        $tasks = $this->db->get_where('tb_proyek_task', ['deleted_at' => null])->num_rows();

        return ['proyek' => $proyek, 'leader' => $leader, 'staff' => $staff, 'tasks' => $tasks];
    }

    function get_allAccount(){
        $this->db->select('a.email, a.role, a.status, a.online, a.is_deleted, a.log_time, a.device, b.*')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id', 'inner')
        ->order_by('a.log_time DESC')
        ;

        return $this->db->get()->result();
    }

    function get_superAccount(){
        $this->db->select('a.email, a.role, a.status, a.online, a.is_deleted, a.log_time, a.device, b.*')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 0])
        ;

        return $this->db->get()->row();
    }

    function get_adminAccount(){
        $this->db->select('a.email, a.role, a.status, a.online, a.is_deleted, a.log_time, a.device, b.*')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 1])
        ;

        return $this->db->get()->row();
    }

    function getParticipans(){
        $this->db->select('*')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 2])
        ;

        return $this->db->get()->result();
    }

    public function getParticipansAll(){

        $offset = $this->input->post('start');
        $limit  = $this->input->post('length'); // Rows display per page
        
        $filter = [];
        $filter_other['submit'] = null;
        $filter_other['check']  = null;
        $filter_other['step']   = null;
        $summary            = [
            'totalChecked' => 0,
            'totalSubmitted' => 0,
            'totalVerif' => 0,
            'totalUser' => 0,

        ];

        if($this->input->post('filterEmail') != null || $this->input->post('filterEmail') != '') $filter[] = "a.email like '%".$this->input->post('filterEmail')."%'";
        if($this->input->post('filterName') != null || $this->input->post('filterName') != '') $filter[] = "b.name like '%".$this->input->post('filterName')."%'";
        if($this->input->post('filterNumber') != null || $this->input->post('filterNumber') != '') $filter[] = "b.phone like '%".$this->input->post('filterNumber')."%'";
        if($this->input->post('filterVerified') != null && $this->input->post('filterVerified') > 0) $filter[] = ($this->input->post('filterVerified') == 2 ? "a.status like '%".$this->input->post('filterVerified')."%'" : ($this->input->post('filterVerified') == 3 ? "a.active = 0" : "a.active like '%".$this->input->post('filterVerified')."%'"));

        
        if($this->input->post('filterSubmited') != null && $this->input->post('filterSubmited') > 0) $filter_other['submit'] = $this->input->post('filterSubmited');
        if($this->input->post('filterChecked') != null && $this->input->post('filterChecked') > 0) $filter_other['check'] = $this->input->post('filterChecked');
        if($this->input->post('filterStep') != null && $this->input->post('filterStep') > 0) $filter_other['step'] = $this->input->post('filterStep');

        if($filter != null){
            $filter = implode(' AND ', $filter);
        }  

        $this->db->select('*')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id', 'inner')
        ->where(['a.role' => 2])
        ;

        $this->db->where($filter);
        $this->db->order_by('b.name ASC');

        // $this->db->limit($limit)->offset($offset);

        $models = $this->db->get()->result();

        foreach($models as $key => $val){
            $strip_email                    = explode("@", $val->email);
            $models[$key]->name             = is_null($val->name) || $val->name == "" ? $strip_email[0] : $val->name;
            $models[$key]->status_account   = $val->active == 0 ? 0 : $val->status;
            $payment                        = $this->checkPaymentUserAll($val->user_id);
            $models[$key]->status_payment   = $payment['status'];
            $models[$key]->payment_data     = $payment['data'];
            $submit                         = $this->checkSubmitUserStatus($val->user_id);
            $models[$key]->status_submit    = $submit['status'];
            $models[$key]->submit_data      = $submit['data'];
        
            if($val->status_submit == true){
                if($val->submit_data->submission_step == 1){
                    $models[$key]->step_status = 1;
                }elseif($val->submit_data->submission_step == 2){
                    $models[$key]->step_status = 2;
                }elseif($val->submit_data->submission_step == 3){
                    $models[$key]->step_status = 3;
                }elseif($val->submit_data->submission_step == 4){
                    $models[$key]->step_status = 4;
                }elseif($val->submit_data->submission_step == 5){
                    $models[$key]->step_status = 5;
                }elseif($val->submit_data->submission_step == 6 && $val->submit_data->status < 2){
                    $models[$key]->step_status = 6;
                }elseif($val->submit_data->submission_step == 6 && $val->submit_data->status >= 2){
                    $models[$key]->step_status = 7;
                }else{
                    $models[$key]->step_status = 0;
                }
            }else{
                $models[$key]->step_status = 0;
            }
        }
        
        if(!is_null($filter_other['submit'])){
            foreach($models as $key => $val){
                if($filter_other['submit'] == 2){
                    if($val->step_status != 7){
                        unset($models[$key]);
                    }
                }else{
                    if($val->step_status == 7){
                        unset($models[$key]);
                    }
                }
            }
        }
        
        if (!is_null($filter_other['check'])) {
            // accepted/checked
            if ($filter_other['check'] == 3) {
                foreach ($models as $key => $val) {
                    if ($val->status_submit == false) {
                        unset($models[$key]);
                    }
                }

                foreach ($models as $key => $val) {
                    if ($val->submit_data->status != 3) {
                        unset($models[$key]);
                    }
                }
            }

            // not checked
            if($filter_other['check'] == 2){
                foreach ($models as $key => $val) {
                    if ($val->status_payment == true) {
                        unset($models[$key]);
                    }
                }
            }

            // rejected
            if($filter_other['check'] == 4){
                foreach ($models as $key => $val) {
                    if ($val->status_submit == false) {
                        unset($models[$key]);
                    }
                }

                foreach ($models as $key => $val) {
                    if ($val->submit_data->status != 4) {
                        unset($models[$key]);
                    }
                }
            }
        }

        if(!is_null($filter_other['step'])){
            foreach($models as $key => $val){
                if($val->step_status != $filter_other['step']){
                    unset($models[$key]);
                }
            }
        }

        $totalRecords = count($models);

        foreach($models as $key => $val){
            if($val->status_payment == true){
                
                $val->submit_data->status = (int) $val->submit_data->status;

                if($val->submit_data->status == 2){
                    $summary['totalSubmitted'] += 1;
                }
                if($val->submit_data->status == 3){
                    $summary['totalChecked'] += 1;
                }
            }

            if($val->status_account == 1){
                $summary['totalVerif'] += 1;
            }
            
            $summary['totalUser'] += 1;
            
        }
        
        $summary = [
            'totalChecked' => number_format($summary['totalChecked']),
            'totalSubmitted' => number_format($summary['totalSubmitted']),
            'totalVerif' => number_format($summary['totalVerif']),
            'totalUser' => number_format($summary['totalUser']),
        ];

        $models = array_slice($models, $offset, $limit);

        return ['records' => array_values($models), 'totalDisplayRecords' => count($models), 'totalRecords' => $totalRecords, 'summary' => $summary];
    }

    public function getParticipansAll_v2(){

        $offset = $this->input->post('start');
        $limit  = $this->input->post('length'); // Rows display per page
        
        $filter = [];
        $filter_other['check']  = null;
        $summary            = [
            'totalChecked' => 0,
            'totalSubmitted' => 0,
            'totalVerif' => 0,
            'totalUser' => 0,

        ];

        $filterEmail = $this->input->post('filterEmail');  
        $filterName = $this->input->post('filterName');  
        $filterNumber = $this->input->post('filterNumber');  
        $filterVerified = $this->input->post('filterVerified');  
        $filterSubmited = $this->input->post('filterSubmited');  
        $filterChecked = $this->input->post('filterChecked');  
        $filterStep = $this->input->post('filterStep');  

        if($filterEmail != null || $filterEmail != '') $filter[] = "a.email like '%{$filterEmail}%'";
        if($filterName != null || $filterName != '') $filter[] = "b.name like '%{$filterName}%'";
        if($filterNumber != null || $filterNumber != '') $filter[] = "b.phone like '%{$filterNumber}%'";
        if($filterVerified != null && $filterVerified > 0) $filter[] = ($filterVerified == 2 ? "a.status like '%{$filterVerified}%'" : ($filterVerified == 3 ? "a.active = 0" : "a.active like '%{$filterVerified}%'"));
        $null = NULL;
        if($filterSubmited != null && $filterSubmited > 0) $filter[] = $filterSubmited == 2 ? "c.status >= {$filterSubmited}" : "c.status <= {$filterSubmited} or c.status = {$null}";
        if($filterChecked != null && $filterChecked > 0) $filter[] = $filterChecked == 2 ? "c.status <= 2" : "c.status = {$filterChecked}";
        if($filterStep != null && $filterStep > 0) $filter[] = $filterStep == 1 ? "c.step = 0 or c.step = 1" : ($filterStep == 7 ? "c.step >= 6 AND c.status < 3" : ($filterStep == 8 ? "c.step >= 6 AND c.status = 3" : "c.step = {$filterStep}"));

        if($filter != null){
            $filter = implode(' AND ', $filter);
        }  

        $this->db->select('a.active, a.status as auth_status, a.email, b.*, c.step as status_step, c.status, c.id as participant_id')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id', 'inner')
        ->join('tb_participants c', 'a.user_id = c.user_id', 'inner')
        ->join('access_token d', 'a.role_id = d.id', 'inner')
        ->where(['d.weight' => 5, 'a.status !=' => 2])
        ;

        $this->db->where($filter);
        $this->db->order_by('b.name ASC');

        // $this->db->limit($limit)->offset($offset);

        $models = $this->db->get()->result();
        foreach($models as $key => $val){

            $models[$key]->submission_step                 = '<span class="badge bg-soft-secondary">Not yet fill submission</span>';
            $models[$key]->statusAccount        = '<span class="badge bg-soft-danger">Unverified</span>';
            $models[$key]->statusSubmit         = '<span class="badge bg-soft-danger">Not Submitted</span>';
            $models[$key]->statusCheck          = '<span class="badge bg-soft-danger">Not Checked</span>';
            $models[$key]->submissionState      = 1;
            
            $btnDetail      = '<button onclick="showMdlParticipantDetail(\''.$val->user_id.'\')" class="btn btn-soft-info btn-icon btn-sm me-2"><i class="bi-eye"></i></button>';
            $btnPass        = '<button onclick="showMdlChangePassword(\''.$val->user_id.'\')" class="btn btn-soft-primary btn-icon btn-sm me-2"><i class="bi-key"></i></button>';
            $btnEmail       = '<button onclick="showMdlChangeEmail(\''.$val->user_id.'\')" class="btn btn-soft-danger btn-icon btn-sm me-2"><i class="bi-envelope"></i></button>';
            $btnVerified    = '<button onclick="showMdlVerified(\''.$val->user_id.'\')" class="btn btn-soft-info btn-icon btn-sm me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-envelope-check" viewBox="0 0 16 16">
									<path
										d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
									<path
										d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
								</svg></button>';
            $btnCheck       = '<button onclick="showMdlChecked(\''.$val->user_id.'\')" class="btn btn-soft-success btn-icon btn-sm me-2"><i class="bi-check"></i></button>';
            $btnDocuments   = '<button onclick="showMdlDocuments(\''.$val->user_id.'\')" class="btn btn-soft-success btn-icon btn-sm me-2"><i class="bi-files"></i></button>';
            $btnLoa         = '<button onclick="showMdlLoa(\''.$val->user_id.'\')" class="btn btn-soft-info btn-icon btn-sm me-2"><i class="bi-file-pdf"></i></button>';

            $strip_email                    = explode("@", $val->email);
            $models[$key]->name             = is_null($val->name) || $val->name == "" ? $strip_email[0] : $val->name;
            $models[$key]->status_account   = $val->active == 0 ? 0 : $val->auth_status;
        
            if(!is_null($val->participant_id)){
                if($val->status_step == 1){
                    $models[$key]->submission_step = '<span class="badge bg-soft-info">(1) Personal Data</span>';
                    // $models[$key]->step_status = 1;
                }elseif($val->status_step == 2){
                    $models[$key]->submission_step = '<span class="badge bg-soft-warning">(2) Others</span>';
                    // $models[$key]->step_status = 2;
                }elseif($val->status_step == 3){
                    $models[$key]->submission_step = '<span class="badge bg-soft-danger">(3) Question</span>';
                    // $models[$key]->step_status = 3;
                }elseif($val->status_step == 4){
                    $models[$key]->submission_step = '<span class="badge bg-soft-primary">(4) Programs</span>';
                    // $models[$key]->step_status = 4;
                }elseif($val->status_step == 5){
                    $models[$key]->submission_step = '<span class="badge bg-blue-dark">(5) Self Photo</span>';
                    // $models[$key]->step_status = 5;
                }elseif($val->status_step == 6 && $val->status < 2){
                    $models[$key]->submission_step = '<span class="badge bg-soft-success">(6) Payment & Agreement</span>';
                    // $models[$key]->step_status = 6;
                }elseif($val->status_step == 6 && $val->status >= 2){
                    $models[$key]->submission_step = '<span class="badge bg-soft-success">Waiting for review</span>';
                    // $models[$key]->step_status = 7;
                }
            }

            if(!is_null($val->participant_id)){
                if($val->status == 0 || $val->status == 1){
                    $models[$key]->statusSubmit       = '<span class="badge bg-soft-danger">Not Submitted</span>';
                    $models[$key]->submissionState    = 1;

                }elseif($val->status == 2){
                    $models[$key]->statusSubmit       = '<span class="badge bg-soft-info">Submitted</span>';
                    $models[$key]->submissionState    = 2;

                    $summary['totalSubmitted']  += 1;
                }elseif($val->status == 3){
                    $models[$key]->submission_step               = '<span class="badge bg-soft-success">Reviewed</span>';
                    $models[$key]->statusSubmit       = '<span class="badge bg-soft-info">Submitted</span>';
                    $models[$key]->statusCheck        = '<span class="badge bg-soft-success">Accepted</span>';
                    $models[$key]->submissionState    = 3;

                    $summary['totalSubmitted']  += 1;
                    $summary['totalChecked']    += 1;
                }elseif($val->status == 4){
                    $models[$key]->submission_step               = '<span class="badge bg-soft-success">Reviewed</span>';
                    $models[$key]->statusSubmit       = '<span class="badge bg-soft-info">Submitted</span>';
                    $models[$key]->statusCheck        = '<span class="badge bg-soft-warning">Rejected</span>';
                    $models[$key]->submissionState    = 4;

                    $summary['totalChecked']    += 1;
                    $summary['totalSubmitted']  += 1;
                }
            }
    
            if($models[$key]->status_account == 1){
                $summary['totalVerif'] += 1;
                $models[$key]->statusAccount  = '<span class="badge bg-soft-success">Verified</span>';
            }elseif($models[$key]->status_account == 2){
                $models[$key]->statusAccount  = '<span class="badge bg-soft-warning">Suspended</span>';
            }
            
            $models[$key]->action = (($models[$key]->submissionState == 2 || $models[$key]->submissionState == 4) && $val->status !== 3 ? $btnCheck : '').$btnDetail.$btnPass.($models[$key]->status_account > 0 ? $btnEmail : '').($val->status_account == 0 ? $btnVerified : '').($models[$key]->submissionState == 3 ? $btnDocuments.$btnLoa : '');
            
            $summary['totalUser']           += 1;
        }

        $totalRecords = count($models);
        
        $summary = [
            'totalChecked' => number_format($summary['totalChecked']),
            'totalSubmitted' => number_format($summary['totalSubmitted']),
            'totalVerif' => number_format($summary['totalVerif']),
            'totalUser' => number_format($summary['totalUser']),
        ];

        $models = array_slice($models, $offset, $limit);

        return ['records' => array_values($models), 'totalDisplayRecords' => count($models), 'totalRecords' => $totalRecords, 'summary' => $summary];
    }

    function get_statistik(){
        $total_pendaftar = $this->db->get_where('access_auth', ['role_id' => 6])->num_rows();
        $new_register = $this->db->get_where('access_auth', ['role_id' => 6, 'joined_at <=' => time(), 'joined_at >=' => strtotime("-1 day", time())])->num_rows();
        $total_participants = $this->db->get_where('tb_participants', ['status' => 2, 'status' => 3, 'deleted_at' => null])->num_rows();

        $arr = [
            'total' => $total_pendaftar,
            'participants' => $total_participants,
            'register_today' => $new_register,
        ];

        return $arr;
    }

    function getChartGender()
    {
        $this->db->select('a.gender, COUNT(a.user_id) as count');
        $this->db->from('access_user a');
        $this->db->join('access_auth b', 'a.user_id = b.user_id');
        $this->db->where('b.role', 2);
        $this->db->group_by('gender');
        return $this->db->get()->result();
    }

    function getChartDaily()
    {
        $this->db->select("id, FROM_UNIXTIME(joined_at, '%Y-%m-%d') AS created_at, COUNT(FROM_UNIXTIME(joined_at, '%Y-%m-%d')) AS count");
        $this->db->from('tb_participants');
        $this->db->where(['status' => 2, 'joined_at >' => 0]);
        $this->db->group_by("FROM_UNIXTIME(joined_at, '%Y-%m-%d')");
        return $this->db->get()->result();
    }

    function getChartDailyAccount()
    {
        $this->db->select("FROM_UNIXTIME(joined_at, '%Y-%m-%d') AS created_at, COUNT(FROM_UNIXTIME(joined_at, '%Y-%m-%d')) AS count");
        $this->db->from('access_auth');
        $this->db->where(['role' => 2, 'status !=' => 2]);
        $this->db->where(['joined_at >' => 0]);
        $this->db->group_by("FROM_UNIXTIME(joined_at, '%Y-%m-%d')");
        return $this->db->get()->result();
    }

    function checkPaymentUserAll($user_id = null){
        $this->db->select('a.*, b.summit, c.payment_method, c.img_method')
        ->from('tb_payments a')
        ->join('m_payments_batch b', 'a.payment_batch = b.id')
        ->join('m_payments_method c', 'a.payment_setting = c.id')
        ->where(['a.user_id' => $user_id, 'a.status !=' => 3, 'b.active' => 1, 'a.deleted_at' => null])
        ;

        $models = $this->db->get()->row();

        if(!empty($models)){
            return [
                'status' => true,
                'data' => $models
            ];
        }else{
            return [
                'status' => false,
                'data' => null
            ];
        }
        
    }

    function checkSubmitUserStatus($user_id = null){
        $this->db->select('a.*, b.*, c.email')
        ->from('tb_participants a')
        ->join('access_user b', 'a.user_id = b.user_id')
        ->join('access_auth c', 'a.user_id = c.user_id')
        // ->join('tb_ambassador d', 'a.referral_code = d.referral_code', 'left')
        ->where(['a.deleted_at' => null, 'c.status' => 1, 'a.user_id' => $user_id])
        ;

        $models = $this->db->get()->row();
        
        if(!empty($models)){
            return [
                'status' => true,
                'data' => $models
            ];
        }else{
            return [
                'status' => false,
                'data' => null
            ];
        }
    }

    function getEssayUser($user_id = null){
        $this->db->select('a.*, b.question, b.type')
        ->from('tb_participants_essay a')
        ->join('m_essay b', 'a.m_essay_id = b.id')
        ->where(['a.user_id' => $user_id]);

        $models = $this->db->get()->result();

        return $models;
    }

    function checkedParticipant(){
        $this->db->where('user_id', $this->input->post('id'));
        $this->db->update('tb_participants', ['status' => 3]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function rejectedParticipant(){
        $this->db->where('user_id', $this->input->post('id'));
        $this->db->update('tb_participants', ['status' => 4]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function activatedParticipant(){
        $this->db->where('user_id', $this->input->post('id'));
        $this->db->update('access_auth', ['active' => 1, 'status' => 1]);
        
        $this->db->where('user_id', $this->input->post('id'));
        $this->db->update('tb_token', ['status' => 1]);
        return true;
    }

    public function getOnlineUsers()
    {
        $this->db->select('a.*, b.name')
        ->from('access_auth a')
        ->join('access_user b', 'a.user_id = b.user_id')
        ->where(['a.online' => 1, 'a.status !=' => 2])
        ;
        return $this->db->get()->result();

    }

    public function getParticipantsExport($status = 0){
        $status = (int) $status;
        $this->db->select('a.user_id, c.name, c.phone, a.whatsapp, b.email, a.institution_workplace, e.en_short_name, a.tshirt_size')
        ->from('tb_participants a')
        ->join('access_auth b', 'a.user_id = b.user_id')
        ->join('access_user c', 'a.user_id = c.user_id')
        ->join('m_countries e', 'a.nationality = e.num_code', 'left')
        ->where(['a.deleted_at' => null])
        ;

        if($status == 2){
            $this->db->where('a.status >=', $status);
        }else{
            $this->db->where('a.status', $status);
        }

        $arr = [];
        $models = $this->db->get()->result();

        if(!empty($models)){
            foreach($models as $key => $val){
                $val->phone = is_null($val->whatsapp) ? $val->phone : $val->whatsapp;
                $arr[$key] = $val;
            }
        }

        return $arr;
    }

    public function getPaymentsExport($status = 0){
        $status = (int) $status;
        $this->db->select('a.*, b.summit, c.payment_method, c.img_method, c.type_method, c.code_method, d.email, e.name, e.phone, f.whatsapp')
        ->from('tb_payments a')
        ->join('m_payments_batch b', 'a.payment_batch = b.id', 'left')
        ->join('m_payments_method c', 'a.payment_setting = c.id', 'left')
        ->join('access_auth d', 'a.user_id = d.user_id', 'left')
        ->join('access_user e', 'a.user_id = e.user_id', 'left')
        ->join('tb_participants f', 'a.user_id = f.user_id', 'left')
        ->where(['a.deleted_at' => null])
        ;

        if($status > 0){
            $this->db->where('a.status', $status);
        }

        $this->db->order_by('e.name ASC');

        $arr = [];
        $models = $this->db->get()->result();

        if(!empty($models)){
            foreach($models as $key => $val){
                $val->phone = is_null($val->whatsapp) ? $val->phone : $val->whatsapp;
                $arr[$key] = $val;
            }
        }

        return $arr;
    }

    function checkedParticipantDocumentsLoa(){
        $this->db->where(['participant_id' => $this->input->post('id'), 'm_document_id' => 4]);
        $this->db->update('tb_participants_document', ['status' => 2]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function rejectedParticipantDocumentsLoa(){
        $this->db->where(['participant_id' => $this->input->post('id'), 'm_document_id' => 4]);
        $this->db->update('tb_participants_document', ['status' => 3]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function getDatabaseResetSchema(){
        $schema = $this->db->get('m_table_reset')->result();

        $this->load->helper('url');
        $url_parts = parse_url(current_url());
        $domain = str_replace('www.', '', $url_parts['host']);

        if($domain == 'localhost'){
            $dbName = 'db_meysv2';
        }else{
            $dbName = 'u1437096_meys_db';
        }

        $rows = $this->db->query("SELECT TABLE_NAME, TABLE_ROWS FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '{$dbName}';")->result();

        $arr = [];
        $arrRows = [];
        if(!empty($schema)){

            foreach($rows as $key => $val){
                $arrRows[strtolower($val->TABLE_NAME)] = $val->TABLE_ROWS;
            }

            foreach($schema as $key => $val){
                if(isset($arrRows[$val->table])){
                    $arr[$val->group]["data"][$key]["key"] = $val->key;
                    $arr[$val->group]["data"][$key]["table"] = $val->table;
                    $arr[$val->group]["data"][$key]["group"] = $val->group;
                    $arr[$val->group]["data"][$key]["join"] = $val->join;
                    $arr[$val->group]["data"][$key]["fk"] = $val->fk;
                    $arr[$val->group]["data"][$key]["condition"] = $val->condition;
                    $arr[$val->group]["data"][$key]["data"] = $arrRows[$val->table];
                    $arr[$val->group]["data"] = array_values($arr[$val->group]["data"]);
                }
            }
            
            foreach($arr as $key => $val){
                $arr[$key]["rows"] = count($val["data"]);
            }

        }
        
        return $arr;
    }

}
