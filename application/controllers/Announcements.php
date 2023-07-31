<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Announcements extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_announcements']);
    }

    public function index()
    {
        $data['navbar_style']   = "navbar-dark bg-dark shadow-sm";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $data['announcements']  = $this->M_announcements->getPublicAnnouncements();

        $this->templatefront->view('home/announcements', $data);
    }

    public function detail($permalink = null)
    {
        $data['navbar_style']   = "navbar-dark bg-dark shadow-sm";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $announcements = $this->M_announcements->getDetailAnnouncement($permalink);

        if(empty($announcements)){
            $this->session->set_flashdata('notif_success', 'Can`t get announcements data');
            redirect(site_url('announcements'));
            return false;
        }

        $data['announcements']  = $announcements;
        $this->templatefront->view('home/announcements_detail', $data);
    }
}
