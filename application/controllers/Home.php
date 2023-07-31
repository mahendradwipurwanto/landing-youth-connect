<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_home', 'M_master']);
    }

    public function index()
    {
        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $data['swiper'] = $this->M_home->getHomeSwiper();
        $data['home']['hero'] = $this->M_home->getHomeComponents('hero');

        $this->templatefront->view('home/home', $data);
    }

    public function faq()
    {   
        // style
        $data['navbar_style']   = "navbar-dark bg-dark shadow-sm";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $data['faq'] = $this->M_home->getFaqAll();
        // ej($data);
        $this->templatefront->view('home/faq', $data);
    }

    public function about()
    {   
        // style
        $data['navbar_style']   = "navbar-dark bg-dark shadow-sm";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";
        // ej($data);
        $this->templatefront->view('home/about', $data);
    }

    public function partnership_sponshorship()
    {
        $this->templatefront->view('home/sponshorship');
    }

    public function eligible_countries()
    {
        // style
        $data['navbar_style']   = "navbar-dark";
        $data['logo_style']     = 1;
        $data['btn_sign_up']    = "btn-light";
        $data['btn_sign_in']    = "btn-outline-light";

        $data['eligilibity'] = $this->M_master->get_masterEligilibity();

        $this->templatefront->view('home/eligible', $data);
    }

    public function helpCenter()
    {
        $this->templatefront->view('home/help_center');
    }

    public function e_404(){
        $this->templateauth->view('utility/not_found');
    }
}
