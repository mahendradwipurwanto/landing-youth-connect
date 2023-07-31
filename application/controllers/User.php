<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    // config
    protected $_midtrans_prod = false;
    protected $_server_key_production = 'Mid-server-gXaK3X0M-oZhY4RPL0g2Mt_z';
    protected $_server_key_sandbox = 'SB-Mid-server-qC8YfWnkcF_fjPrZmuNEwb8P';
    protected $_client_key_production = 'SB-Mid-client-LAEwpi34CdNrwLgt';
    protected $_client_key_sandbox = 'SB-Mid-client-LAEwpi34CdNrwLgt';
    protected $_user_testflight = ['USER-ADM-01', 'USR-MHNDR-b6331'];

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_user', 'M_auth', 'M_announcements', 'M_master', 'M_payment', 'M_travel', 'M_admin']);

        // cek apakah user sudah login
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Please login to continue");
            redirect('sign-in');
        }

        // cek akun aktif
        $user = $this->M_auth->get_userByID($this->session->userdata('user_id'));
        if ($user != false) {
            if ($user->status == 0) {
                $this->session->set_flashdata('error', "Hi {$user->name}, please verified your email first");
                redirect(site_url('verification-email'));
            }
        }

        // get master midtrans setting
        $this->_midtrans_prod = $this->M_payment->getMidtransConfig('_midtrans_prod') == 1 ? true : false;
        $this->_server_key_production = $this->M_payment->getMidtransConfig('_server_key_production');
        $this->_server_key_sandbox = $this->M_payment->getMidtransConfig('_server_key_sandbox');
        $this->_client_key_production = $this->M_payment->getMidtransConfig('_client_key_production');
        $this->_client_key_sandbox = $this->M_payment->getMidtransConfig('_client_key_sandbox');
        
        if(!is_null($this->M_payment->getMidtransConfig('_user_testflight'))){
           
           $this->_user_testflight = explode(',', $this->M_payment->getMidtransConfig('_user_testflight')) ;
        }

        $params = [
            'server_key' => $this->_midtrans_prod == true ? $this->_server_key_production : $this->_server_key_sandbox,
            'production' => $this->_midtrans_prod
        ];

        $this->load->model(['M_master', 'M_payment', 'M_auth']);
        $this->load->library(['Uploader', 'Midtrans', 'Veritrans', 'MidtransPayments']);
        $this->midtrans->config($params);
        $this->veritrans->config($params);
    }

    public function index()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));
        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";
        $data['participants']   = $this->M_user->getUserParticipans($this->session->userdata('user_id'));
        // ej($data['participants']->address);
        $this->templateuser->view('user/overview', $data);
    }

    public function documents()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        // $data['documents']  = $this->M_master->getDocuments();
        $data['documents']  = $this->M_user->getUserDocuments();
        
        $this->templateuser->view('user/documents', $data);
    }

    public function announcements()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $data['announcements']  = $this->M_announcements->getParticipansAnnouncements();

        $this->templateuser->view('user/announcements', $data);
    }

    public function payment()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";
        
        $data['gateway_provider'] = $this->M_admin->get_settingsValue("_gateway_providers");
        
        if($this->_midtrans_prod == false){
            $data['is_allow_gateway'] = checkAllowGateway($this->session->userdata('user_id'), $this->_user_testflight);
        }else{
            $data['is_allow_gateway'] = true;
        }

        $data['midtrans_prod']  = $this->_midtrans_prod;
        $data['client_key']     = ($this->_midtrans_prod == true ? $this->_client_key_production : $this->_client_key_sandbox);

        $data['payment_settings']   = $this->M_payment->getPaymentSettingsUser();
        $data['payment_batch']      = $this->M_payment->getUserPaymentBatchV2();
        $data['participants']   = $this->M_user->getUserParticipans($this->session->userdata('user_id'));
        $this->templateuser->view('user/payments/payment', $data);
    }

    public function payments_history($batch_id = null)
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";
        $data['payment_history']  = $this->M_payment->getUserPaymentBatchHistory($this->session->userdata('user_id'), $batch_id);

        // urgent > can be improve later
        foreach($data['payment_history'] as $key => $val){
            if($val->type_method == 'gateway_midtrans'){
                $this->status($val->order_id);
            }
        }

        $this->templateuser->view('user/payments/payment_history', $data);
    }

    public function payments_transaction($payment_id = null)
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";
        $data['reff']['type']   = $this->input->get('reff');
        $data['reff']['id']     = $this->input->get('id');

        if ($this->input->get('method') && $this->input->get('method') == 'gateway') {

            $this->status($payment_id);

            $data['payment_detail']  = $this->M_payment->getUserPaymentDetailByOrderId($payment_id);
            
            $this->templatepayment->view('user/payments/payment_midtrans', $data);
        } else {
            $data['payment_detail']  = $this->M_payment->getUserPaymentDetail($payment_id);

            $this->templatepayment->view('user/payments/payment_transaction', $data);
        }
    }

    public function submission()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $data['participants']   = $this->M_user->getUserParticipans($this->session->userdata('user_id'));
        $participant_id         = isset($data['participants']->id) ? $data['participants']->id : null;
        $data['p_essay']        = $this->M_user->getUserParticipansEssay($this->session->userdata('user_id'), $participant_id);
        $data['m_essay']        = $this->M_master->getParticipansEssay();
        $data['countries']      = $this->M_user->getAllCountries();

        $this->templateuser->view('user/submission', $data);
    }

    public function travel_documents()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";
        
        $data['passport']       = $this->M_travel->getUserPassport($this->session->userdata('user_id'));
        $data['flight']         = $this->M_travel->getUserFlight($this->session->userdata('user_id'));
        $data['residence']      = $this->M_travel->getUserResidance($this->session->userdata('user_id'));
        $data['visa']           = $this->M_travel->getUserVisa($this->session->userdata('user_id'));
        $data['vaccine']        = $this->M_travel->getUserVaccine($this->session->userdata('user_id'));

        $this->templateuser->view('user/travel_documents', $data);
    }

    public function settings()
    {
        $data['user'] = $this->M_auth->get_auth($this->session->userdata('email'));

        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $this->templateuser->view('user/settings', $data);
    }

    public function changePassword()
    {
        $cur_password   = $this->input->post('currentPassword');
        $password       = $this->input->post('newPassword');
        $conf_password  = $this->input->post('confirmNewPassword');

        // mengambil data user dengan param email
        $user = $this->M_auth->get_auth($this->session->userdata('email'));
        // ej($user);

        if ($password == $conf_password) {
            //mengecek apakah password benar
            if (password_verify($cur_password, $user->password)) {
                if ($this->M_user->changePassword($password) == true) {
                    // atur dataemailperubahan password
                    $now = date("d F Y - H:i");
                    $email = htmlspecialchars($this->session->userdata("email"), true);

                    $subject = "Password change - Istanbull Youth Summit";
                    $message = "Hi, password for Istanbull Youth Summit account with email <b>{$email}</b> has been changed at {$now}. <br> If you feel you did not make these changes, please contact our admin immediately.";

                    // mengirimemailperubahan password
                    sendMail(htmlspecialchars($this->session->userdata("email"), true), $subject, $message);

                    $this->session->set_flashdata('notif_success', 'Password has been changes');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'There something wrong when try to changes your password');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', 'Password wrong');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'Password doesn`t match');
            redirect($this->agent->referrer());
        }
    }

    public function status($order_id = null){
        
        if($this->input->post('order_id')){
            $order_id = $this->input->post('order_id');
        }

        $data = $this->veritrans->status($order_id);

        $data = [
            'status'        => $this->midtranspayments->cvtStatusToInt($data->transaction_status),
            'updated_at'   => time(),
            // 'modified_by'   => $this->session->userdata('user_id')
        ];

        $where = [
            'order_id'  => $order_id,
            'user_id'   => $this->session->userdata('user_id')
        ];

        $this->M_payment->updatePaymentG($data, $where);
    }
}
