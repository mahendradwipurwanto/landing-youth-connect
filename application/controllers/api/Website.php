<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_website']);
    }

    public function ubahGeneral()
    {
        $logo = null;
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $path = "assets/images/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path, 'logo');
            if ($upload == true) {
                $logo = $upload['filename'];
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        }
        
        if ($this->M_website->ubahGeneral($logo) == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes general information');
            redirect(site_url('admin/settings?p=general'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes general information');
            redirect($this->agent->referrer());
        }
    }

    public function ubahMailer()
    {
        if ($this->M_website->ubahMailer() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes mailer');
            redirect(site_url('admin/settings?p=mailer'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes mailer');
            redirect($this->agent->referrer());
        }
    }

    public function ubahPasswordMaster()
    {
        if ($this->M_website->ubahPasswordMaster() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes credentials information');
            redirect(site_url('admin/settings?p=credentials'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes credentials information');
            redirect($this->agent->referrer());
        }
    }

    public function resetDatabase()
    {
        if ($this->M_website->resetDatabase() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully reset databases');
            redirect(site_url('admin/settings?p=database'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to reset data databases');
            redirect($this->agent->referrer());
        }
    }
}
