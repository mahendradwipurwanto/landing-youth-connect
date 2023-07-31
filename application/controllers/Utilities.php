<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utilities extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_home']);
    }

    public function not_found()
    {
        $this->templatefront->view('utilities/not_found');
    }
}
