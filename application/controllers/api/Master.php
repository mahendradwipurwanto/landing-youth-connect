<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_master', 'M_announcements', 'M_auth', 'M_user']);
        $this->load->library('uploader');

        if ($this->session->userdata('role') > 1) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }
    }

    public function getDetailAnnouncement(){

        $id = $this->input->post('id');

		if ($this->M_announcements->getDetailAnnouncement($id) != false) {
            $data['item'] = $this->M_announcements->getDetailAnnouncement($id);
            
            $this->load->view('admin/ajax/edit_announcements', $data);

		} else {
			echo "<center class='py-5'><h4>There is an error when trying get user applicant's data!</h4></center>";
		}
    }

    function addAnnouncement()
    {
        if (isset($_FILES['image'])) {
            $perma = createPermalink($this->input->post('subject'));
            $path = "berkas/landing/announcements/{$perma}/profile/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            
            if ($upload == true) {
                $subject = $this->input->post('subject');
                if ($this->M_announcements->addAnnouncement($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly posted the announcement '.$subject);
                    redirect(site_url('master/announcements'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to post the announcement, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $subject = $this->input->post('subject');
            if ($this->M_announcements->addAnnouncement() == true) {
                $this->session->set_flashdata('notif_success', 'Succesfuly posted the announcement '.$subject);
                redirect(site_url('master/announcements'));
            } else {
                $this->session->set_flashdata('notif_warning', 'There is a problem when trying to post the announcement, try again later');
                redirect($this->agent->referrer());
            }
        }
    }

    function editAnnouncement()
    {
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $perma = $this->input->post('permalink');
            $path = "berkas/landing/announcements/{$perma}/profile/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            if ($upload == true) {
                $subject = $this->input->post('subject');
                if ($this->M_announcements->editAnnouncement($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly editted the  announcement '.$subject);
                    redirect(site_url('master/announcements'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit the announcement, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $subject = $this->input->post('subject');
            if ($this->M_announcements->editAnnouncement() == true) {
                $this->session->set_flashdata('notif_success', 'Succesfuly editted the  announcement '.$subject);
                redirect(site_url('master/announcements'));
            } else {
                $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit the announcement, try again later');
                redirect($this->agent->referrer());
            }
        }
    }

    function deleteAnnouncement()
    {
        $subject = $this->input->post('subject');
        if ($this->M_announcements->deleteAnnouncement() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly deleted announcement '.$subject);
            redirect(site_url('master/announcements'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to delete the announcement, try again later');
            redirect($this->agent->referrer());
        }
    }

    // faq

    function addMasterFaq()
    {
        if ($this->M_master->addMasterFaq() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly added  master faq content');
            redirect(site_url('master/master-faq'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to add master faq content, try again later');
            redirect($this->agent->referrer());
        }
    }

    function editMasterFaq()
    {
        if ($this->M_master->editMasterFaq() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly editted a master faq ');
            redirect(site_url('master/master-faq'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit master faq, try again later');
            redirect($this->agent->referrer());
        }
    }

    function deleteMasterFaq()
    {
        if ($this->M_master->deleteMasterFaq() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly deleted a master faq ');
            redirect(site_url('master/master-faq'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to delete master faq, try again later');
            redirect($this->agent->referrer());
        }
    }

    function addPaymentBatch()
    {
        if ($this->M_master->addPaymentBatch() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly added a new payment batch');
            redirect(site_url('master/payment-batch'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to add new payment batch, try again later');
            redirect($this->agent->referrer());
        }
    }

    function editPaymentBatch()
    {
        if ($this->M_master->editPaymentBatch() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly editted a payment batch ');
            redirect(site_url('master/payment-batch'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit payment batch, try again later');
            redirect($this->agent->referrer());
        }
    }

    function deletePaymentBatch()
    {
        if ($this->M_master->deletePaymentBatch() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly deleted a payment batch ');
            redirect(site_url('master/payment-batch'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to delete payment batch, try again later');
            redirect($this->agent->referrer());
        }
    }

    function addFaq()
    {
        if ($this->M_master->addFaq() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly added a new FAQ content');
            redirect(site_url('master/faq'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to add new FAQ content, try again later');
            redirect($this->agent->referrer());
        }
    }

    function editFaq()
    {
        if ($this->M_master->editFaq() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly editted a faq ');
            redirect(site_url('master/faq'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit faq, try again later');
            redirect($this->agent->referrer());
        }
    }

    function deleteFaq()
    {
        if ($this->M_master->deleteFaq() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly deleted a faq ');
            redirect(site_url('master/faq'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to delete faq, try again later');
            redirect($this->agent->referrer());
        }
    }

    function changeParticipanPassword(){
        if ($this->M_master->changeParticipanPassword() == true) {
            $user = $this->M_auth->get_userByID($this->input->post("id"));
            // atur dataemailperubahan password
            $now = date("d F Y - H:i");
            $email = htmlspecialchars($user->email, true);

            $subject = "Password change - Middle East Youth Summit";
            $message = "Hi, password for Middle East Youth Summit account with email <b>{$email}</b> has been changed at {$now}. <br> <br>Your new password is: <b>{$this->input->post('pass')}</b> <br><br> If you feel not requested this changes, please contact our admin immediately.";

            // mengirimemailperubahan password
            sendMail(htmlspecialchars($user->email, true), $subject, $message);

            $this->session->set_flashdata('notif_success', 'Succesfuly changes participans password ');
            redirect(site_url('admin/participans'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to changes participans password, try again later');
            redirect($this->agent->referrer());
        }
    }

    function changeParticipanEmail(){
        if ($this->M_auth->cek_auth(htmlspecialchars($this->input->post("email"), true)) == false) {
            $user = $this->M_auth->get_userByID($this->input->post("id"));
            if ($this->M_master->changeParticipanEmail() == true) {
                // atur dataemailperubahan email
                $now = date("d F Y - H:i");
                $email = htmlspecialchars($user->email, true);

                $subject = "Email change - Middle East Youth Summit";
                $message = "Hi, email for Middle East Youth Summit account with email <b>{$email}</b> has been changed at {$now}. <br> <br>Your new email is: <b>{$this->input->post('email')}</b> <br><br> If you feel not requested this changes, please contact our admin immediately.";

                // mengirimemailperubahan email
                sendMail(htmlspecialchars($user->email, true), $subject, $message);

                $subject = "Email change - Middle East Youth Summit";
                $message = "Hi, email for Middle East Youth Summit account with email <b>{$email}</b> has been changed at {$now}. <br> <br>Your new email is: <b>{$this->input->post('email')}</b> <br><br> If you feel not requested this changes, please contact our admin immediately.";

                // mengirimemailperubahan email
                sendMail(htmlspecialchars($this->input->post('email'), true), $subject, $message);

                $this->session->set_flashdata('notif_success', 'Succesfuly changes participans email ');
                redirect(site_url('admin/participans'));
            } else {
                $this->session->set_flashdata('notif_warning', 'There is a problem when trying to changes participans email, try again later');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'There is already an account related to this email!');
            redirect($this->agent->referrer());
        }
    }

    function testMailer(){
        sendMailTest($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s'))['status'];
        $this->session->set_flashdata('notif_success', 'Succesfuly tested mailer for the current setting');
        $debug = sendMailTest($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s'))['debug'] == 'html' ? 'Test mail succesfuly sended' : sendMailTest($this->input->post('email'), 'Test email mailer', 'This is a Test Email on '.date('d M Y - H:i:s'))['debug'];
        $this->session->set_userdata(['mailer_debug' => $debug]);
        redirect($this->agent->referrer());
    }

    public function ajxGenRC(){
        $referral = strtoupper(substr($this->input->post('name'), 0, 3));
        $ambassador = $this->db->get_where('tb_ambassador', ['is_deleted' => 1])->num_rows();
        
        if($ambassador == 0){
            $referral .= '001';
        }else{
            $lastOrder = $ambassador+1;
            $referral .= "00".$lastOrder;
        }
        echo json_encode(['referral_code' => $referral]);
    }

    function addAmbassador()
    {
        if (isset($_FILES['image'])) {
            $perma = createPermalink($this->input->post('subject'));
            $path = "berkas/landing/announcements/{$perma}/profile/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            
            if ($upload == true) {
                $subject = $this->input->post('subject');
                if ($this->M_master->addAmbassador($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly posted the announcement '.$subject);
                    redirect(site_url('master/ambassador'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to post the announcement, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $subject = $this->input->post('subject');
            if ($this->M_master->addAmbassador() == true) {
                $this->session->set_flashdata('notif_success', 'Succesfuly posted the announcement '.$subject);
                redirect(site_url('master/ambassador'));
            } else {
                $this->session->set_flashdata('notif_warning', 'There is a problem when trying to post the announcement, try again later');
                redirect($this->agent->referrer());
            }
        }
    }

    function editAmbassador()
    {
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $perma = $this->input->post('permalink');
            $path = "berkas/landing/announcements/{$perma}/profile/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            if ($upload == true) {
                $subject = $this->input->post('subject');
                if ($this->M_master->editAmbassador($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly editted the  announcement '.$subject);
                    redirect(site_url('master/ambassador'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit the announcement, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $subject = $this->input->post('subject');
            if ($this->M_master->editAmbassador() == true) {
                $this->session->set_flashdata('notif_success', 'Succesfuly editted the  announcement '.$subject);
                redirect(site_url('master/ambassador'));
            } else {
                $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit the announcement, try again later');
                redirect($this->agent->referrer());
            }
        }
    }

    function deleteAmbassador()
    {
        $subject = $this->input->post('subject');
        if ($this->M_master->deleteAmbassador() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly deleted announcement '.$subject);
            redirect(site_url('master/ambassador'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to delete the announcement, try again later');
            redirect($this->agent->referrer());
        }
    }

    function addMasterEligilibity()
    {
        if ($this->M_master->addEligilibity() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly added a new Eligibilty Countries content');
            redirect(site_url('master/eligilibity-countries'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to add new Eligibilty Countries content, try again later');
            redirect($this->agent->referrer());
        }
    }

    function editMasterEligilibity()
    {
        if ($this->M_master->editEligilibity() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly editted a Eligibilty Countries ');
            redirect(site_url('master/eligilibity-countries'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to edit Eligibilty Countries, try again later');
            redirect($this->agent->referrer());
        }
    }

    function deleteMasterEligilibity()
    {
        if ($this->M_master->deleteEligilibity() == true) {
            $this->session->set_flashdata('notif_success', 'Succesfuly deleted a Eligibilty Countries ');
            redirect(site_url('master/eligilibity-countries'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to delete Eligibilty Countries, try again later');
            redirect($this->agent->referrer());
        }
    }

}
