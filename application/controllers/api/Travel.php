<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Travel extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_travel', 'M_master']);
        $this->load->library('uploader');
    }

    public function passport(){
        if (isset($_FILES['image'])) {
            $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);

            if ($upload == true) {
                if ($this->M_travel->savePassport($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly save your data');
                    redirect(site_url('user/travel_documents'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to save your data, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a no file choosen, try again later');
            redirect($this->agent->referrer());
        }
    }

    public function flight(){
        if ($this->M_travel->saveFlight() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly save your data');
            redirect(site_url('user/travel_documents'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to save your data, try again later');
            redirect($this->agent->referrer());
        }
    }

    public function residence(){
        if ($this->M_travel->saveResidance() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly save your data');
            redirect(site_url('user/travel_documents'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to save your data, try again later');
            redirect($this->agent->referrer());
        }
    }

    public function visa(){
        if (isset($_FILES['image'])) {
            $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);

            if ($upload == true) {
                if ($this->M_travel->saveVisa($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly save your data');
                    redirect(site_url('user/travel_documents'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to save your data, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a no file choosen, try again later');
            redirect($this->agent->referrer());
        }
    }

    public function vaccine(){
        if (isset($_FILES['image'])) {
            $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);

            if ($upload == true) {
                if ($this->M_travel->saveVaccine($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly save your data');
                    redirect(site_url('user/travel_documents'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to save your data, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a no file choosen, try again later');
            redirect($this->agent->referrer());
        }
    }
}
