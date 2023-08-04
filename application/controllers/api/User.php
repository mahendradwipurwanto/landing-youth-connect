<?php

defined('BASEPATH') or exit('No direct script access allowed');

use setasign\Fpdi\Fpdi;

class User extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_user', 'M_master']);
        $this->load->library('uploader');
        $this->load->helper('download');

    }

    public function getNationality(){
        $word = $this->input->get('search');
        $result = $this->M_master->getNationalitySearch($word);
        
        if(!empty($result)){
            echo $result;
        }else{
            echo "Not found";
        }
    }

    public function ajxPostBasic(){

        if($this->M_user->formStepBasic() == true){
            echo json_encode([
                'status' => true,
                'message' => 'success saved step basic'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error saved step basic'
            ]);
        }
    }

    public function ajxPostOther(){

        if($this->M_user->formStepOthers() == true){
            echo json_encode([
                'status' => true,
                'message' => 'success saved step others'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error saved step others'
            ]);
        }
    }

    public function ajxPostEssay(){
        $m_essay        = $this->M_master->getParticipansEssay();
        if($this->M_user->formStepEssays($m_essay) == true){
            echo json_encode([
                'status' => true,
                'message' => 'success saved step others'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error saved step others'
            ]);
        }
    }

    public function ajxPostProgram(){
        if($this->M_user->formStepProgram() == true){
            echo json_encode([
                'status' => true,
                'message' => 'success saved step others'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error saved step others'
            ]);
        }
    }

    public function ajxCheckRC(){
        $ambassador = $this->M_master->getAmbasadorByReferral($this->input->post('referral'));
        if(!empty($ambassador)){
            echo json_encode([
                'status' => true,
                'data' => $ambassador
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error'
            ]);
        }
    }

    public function ajxPostSelf(){
        $path   = "./berkas/user/participans/";
        $photo  = null;
        if($this->input->post('image') !== ""){
            $upload = base64ToImage($path, $this->input->post('image'));
            $photo  = explode("./", $upload['url'])[1];
        }
        if($this->M_user->formStepSelf($photo) == true){
            echo json_encode([
                'status' => true,
                'message' => 'success saved step Self Photo'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error saved step Self Photo'
            ]);
        }
    }

    public function ajxPostSubmission(){
        if($this->M_user->ajxPostSubmission() == true){

            $subject = "Submission submitted - Istanbull Youth Summit";
            $message = "Hi, your submission has been submitted to our system. You will receive further notice regarding your submission, or contact us if you had any question";

            // mengirimemail
            sendMail(htmlspecialchars($this->session->userdata("email"), true), $subject, $message);

            echo json_encode([
                'status' => true,
                'message' => 'success saved submission'
            ]);
        }else{
            echo json_encode([
                'status' => false,
                'error' => 'error saved step submission'
            ]);
        }
    }

    public function uploadDocuments(){
        if (isset($_FILES['file'])) {
            $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";
            $upload = $this->uploader->uploadFile($_FILES['file'], $path);

            if ($upload == true) {
                if ($this->M_user->uploadDocuments($upload['filename']) == true) {
                    $this->session->set_flashdata('notif_success', 'Succesfuly save your data');
                    redirect(site_url('user/documents'));
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

    function generate_loa()
    {

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
            $user       = $this->M_user->getUserParticipans($this->session->userdata('user_id'));
            
            if(!empty($user)){
                $pdf = new Fpdi();
                $pdf->AddPage();
                // set the source file
                $pdf->setSourceFile('berkas/docs/Fixed LoA IYS 2023.pdf');
                // import page 1
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0, 220);
        
                // now write some text above the imported page
                $pdf->SetFont('Times');
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFontSize(12);
                // $pdf->SetXY(51, 55);
                // $pdf->Write(0, strtoupper(explode(' ', $user->name)[0]));
                $pdf->SetXY(42, 108);
                $pdf->Write(0, strtoupper($user->name));
                // $pdf->SetXY(67, 102);
                // $pdf->Write(0, strtoupper($user->institution_workplace));

                $user->name = strtoupper($user->name);

                $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $pdf->Output("{$path}LoA - {$user->name}.pdf", 'F');
                force_download("{$path}LoA - {$user->name}.pdf", NULL);
            }else{
                $this->session->set_flashdata('notif_warning', 'You need to complete at least first step of submission !');
                redirect($this->agent->referrer());
            }
        }

    }

    function generate_aggreement()
    {

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
            $user       = $this->M_user->getUserParticipans($this->session->userdata('user_id'));
            
            if(!empty($user)){

                $pdf = new Fpdi();
                $pdf->AddPage();
                // set the source file
                $pdf->setSourceFile('berkas/docs/AGREEMENT LETTER IYS 2023.docx.pdf');
                // import page 1
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0, 220);
        
                // now write some text above the imported page
                $pdf->SetFont('Times');
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFontSize(11);

                // name
                $pdf->SetXY(81, 125.4);
                $pdf->Write(0, strtoupper($user->name));

                // address
                $pdf->SetXY(81, 132.3);
                $pdf->Write(0, strtoupper($user->address)." - ".strtoupper($user->city)." - ".strtoupper($user->province));

                // // gender
                $pdf->SetXY(81, 139.2);
                $pdf->Write(0, strtoupper($user->gender));

                // // birth
                $pdf->SetXY(81, 146.1);
                $pdf->Write(0, date("d F Y", $user->birthdate));

                // // education
                $pdf->SetXY(81, 153.1);
                $pdf->Write(0, strtoupper($user->institution_workplace));

                // // phone
                $pdf->SetXY(81, 160.1);
                $pdf->Write(0, $user->whatsapp);

                // // email
                $pdf->SetXY(81, 166.8);
                $pdf->Write(0, strtoupper($user->email));

                $user->name = strtoupper($user->name);

                $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $pdf->Output("{$path}LoA - {$user->name}.pdf", 'F');
                force_download("{$path}LoA - {$user->name}.pdf", NULL);
            }else{
                $this->session->set_flashdata('notif_warning', 'You need to complete at least first step of submission !');
                redirect($this->agent->referrer());
            }
        }

    }
    // public function uploadDocuments(){
    //     if (isset($_FILES['proposal']['name']) && $_FILES['proposal']['name'] !== "") {
    //         $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";
    //         $upload = $this->uploader->uploadFileMulti($_FILES['proposal'], 'proposal', $path);

    //         if ($upload['status'] == true) {
    //             if ($this->M_user->upload_dokumen('proposal', $upload['filename']) == true) {
    //                 $this->session->set_flashdata('notif_success', 'Succesfuly upload your document ');
    //                 redirect(site_url('user/submission'));
    //             } else {
    //                 $this->session->set_flashdata('notif_warning', 'There is a problem when trying to send your payment, try again later');
    //                 redirect($this->agent->referrer());
    //             }
    //         } else {
    //             $this->session->set_flashdata('notif_warning', $upload['message']['error']);
    //             redirect($this->agent->referrer());
    //         }
    //     }

    //     if (isset($_FILES['travel']['name']) && $_FILES['travel']['name'] !== "") {
    //         $path = "berkas/user/{$this->session->userdata('user_id')}/documents/";
    //         $upload = $this->uploader->uploadFileMulti($_FILES['travel'], 'travel', $path);

    //         if ($upload['status'] == true) {
    //             if ($this->M_user->upload_dokumen('travel', $upload['filename']) == true) {
    //                 $this->session->set_flashdata('notif_success', 'Succesfuly upload your document ');
    //                 redirect(site_url('user/submission'));
    //             } else {
    //                 $this->session->set_flashdata('notif_warning', 'There is a problem when trying to send your payment, try again later');
    //                 redirect($this->agent->referrer());
    //             }
    //         } else {
    //             $this->session->set_flashdata('notif_warning', $upload['message']);
    //             redirect($this->agent->referrer());
    //         }
    //     }


    // }
}
