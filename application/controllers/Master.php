<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_master', 'M_announcements', 'M_home', 'M_user']);

        if ($this->session->userdata('role') > 2) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }
    }

    public function ambassador()
    {
        $data['countries']      = $this->M_user->getAllCountries();
        $data['ambassador'] = $this->M_master->getAllAmbassador();
        $data['faq'] = $this->M_home->getFaqAll();

        $this->templateback->view('admin/master/ambassador', $data);
    }

    public function eligilibity_countries()
    {
        $data['eligilibity'] = $this->M_master->get_masterEligilibity();

        $this->templateback->view('admin/master/eligilibity', $data);
    }

    public function faq()
    {
        $data['master_faq'] = $this->M_master->get_masterFaqContent();
        $data['faq'] = $this->M_home->getFaqAll();

        $this->templateback->view('admin/master/faq', $data);
    }

    public function masterFaq()
    {
        $data['master_faq'] = $this->M_master->get_masterFaqContent();

        $this->templateback->view('admin/master/master_faq', $data);
    }

    public function paymentBatch()
    {
        $data['payments_batch'] = $this->M_master->get_paymentsBatch();

        $this->templateback->view('admin/master/payment_batch', $data);
    }

    public function entrantForm()
    {
        $this->templateback->view('admin/master/entrant_form');
    }

    public function manageList()
    {
        $data['announcement'] = $this->M_announcements->getAnnouncementlist();

        $this->templateback->view('admin/announcements', $data);
    }
}
