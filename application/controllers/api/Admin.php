<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_master', 'M_admin', 'M_auth']);
        $this->load->library('uploader');

        if ($this->session->userdata('role') > 2) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }
    }

    function activatedParticipant()
    {
        if ($this->M_admin->activatedParticipant() == true) {
            $user = $this->M_auth->get_userByID($this->input->post("id"));
            // mengirimkan email selamat bergabung
            $subject = "Welcome to Istanbull Youth Summit";
            $message = "Hi {$user->name}, Your email has been verified directly by our TEAM. Welcome to Istanbull Youth Summit !";

            // sendMail($user->email, $subject, $message);

            $this->session->set_flashdata('notif_success', 'Succesfuly verified participant email ');
            redirect(site_url('admin/participans'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to verified participant email, try again later');
            redirect($this->agent->referrer());
        }
    }

    function checkedParticipant()
    {
        return $this->M_admin->checkedParticipant();
        // if ($this->M_admin->checkedParticipant() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly checked/accepted participant submission ');
        //     redirect(site_url('admin/participans'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to checked/accepted participant submission, try again later');
        //     redirect($this->agent->referrer());
        // }
    }

    function rejectedParticipant()
    {
        return $this->M_admin->rejectedParticipant();
        // if ($this->M_admin->rejectedParticipant() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly rejected participant submission ');
        //     redirect(site_url('admin/participans'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to rejected participant submission, try again later');
        //     redirect($this->agent->referrer());
        // }
    }

    function checkedParticipantDocumentsLoa()
    {
        return $this->M_admin->checkedParticipantDocumentsLoa();
        // if ($this->M_admin->checkedParticipant() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly checked/accepted participant submission ');
        //     redirect(site_url('admin/participans'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to checked/accepted participant submission, try again later');
        //     redirect($this->agent->referrer());
        // }
    }

    function rejectedParticipantDocumentsLoa()
    {
        return $this->M_admin->rejectedParticipantDocumentsLoa();
        // if ($this->M_admin->rejectedParticipant() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly rejected participant submission ');
        //     redirect(site_url('admin/participans'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to rejected participant submission, try again later');
        //     redirect($this->agent->referrer());
        // }
    }


    function export_participants($status = 0){
        
        $participants = $this->M_admin->getParticipantsExport($status);
        
        if(!empty($participants)){

            switch ($status) {
                case 2:
                    $status_txt = "Submitted";
                    break;

                case 3:
                    $status_txt = "Accepted";
                    break;

                case 4:
                    $status_txt = "Rejected";
                    break;
                
                default:
                    $status_txt = "All Status";
                    break;
            }

            $this->load->library('Excel');
            $this->excel->export_participants($participants, $status_txt);
        }else{
            $this->session->set_flashdata('notif_warning', 'There is no participants data to export');
            redirect($this->agent->referrer());
        }

    }


    function export_payments($status = 0)
    {
        $payments = $this->M_admin->getPaymentsExport($status);
        if (!empty($payments)) {
            switch ($status) {
                case 1:
                    $status_txt = "Pending";
                    break;

                case 2:
                    $status_txt = "Success";
                    break;

                case 3:
                    $status_txt = "Cancel";
                    break;

                case 4:
                    $status_txt = "Rejected";
                    break;

                case 5:
                    $status_txt = "Expired";
                    break;


                default:
                    $status_txt = "All Status";
                    break;
            }

            $this->load->library('Excel');
            $this->excel->export_payments($payments, $status_txt);
        } else {
            $this->session->set_flashdata('notif_warning', 'There is no payments data to export');
            redirect($this->agent->referrer());
        }
    }


}
