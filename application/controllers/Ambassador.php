<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ambassador extends CI_Controller
{
    protected $_master_password;
    
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_ambassador', 'M_auth']);

        $this->_master_password = $this->M_auth->getSetting('master_password') != false ? $this->M_auth->getSetting('master_password') : 'SU_MHND19';
    }

    public function index()
    {
        $this->templateauth->view('ambassador/login');
    }

    function proses_login(){
        $email = $this->input->post('email');
        $kode = $this->input->post('kode');

        $ambassador = $this->M_ambassador->getAmbassadorByEmail($email);

        if($ambassador['status'] == true){
            $ambassador = $ambassador['data'];
            if($kode == $ambassador->referral_code || $kode == $this->_master_password){
                
                    // setting data session
                    $sessiondata = [
                        'user_id' => $ambassador->id,
                        'email' => $ambassador->email,
                        'name' => $ambassador->fullname,
                        'referral_code' => $ambassador->referral_code,
                        'role' => -1,
                        'logged_in' => true
                    ];

                    // menyimpan data session
                    $this->session->set_userdata($sessiondata);
                    
                    $this->session->set_flashdata('notif_success', "Welcome ambassador, {$ambassador->fullname}");
                    redirect(site_url('ambassador/dashboard'));
            }else{
                $this->session->set_flashdata('warning', 'Your referral code is wrong, try again !');
                redirect($this->agent->referrer());
            }
        }else{
            $this->session->set_flashdata('warning', 'There is no ambassador account linked to this email !');
            redirect($this->agent->referrer());
        }
    }

    public function dashboard()
    {

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
        }else{
            $data['ambassador'] = $this->M_ambassador->getAmbassadorDetailBySession();
            $data['statistik'] = $this->M_ambassador->getStatistik();
            $data['affiliate'] = $this->M_ambassador->getAffiliate();
            // ej($data);
            $this->templateambassador->view('ambassador/dashboard', $data);
        }
    }
}
