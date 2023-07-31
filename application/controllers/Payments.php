<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_payment', 'M_master']);

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
        }

        if ($this->session->userdata('role') > 1) {
            $this->session->set_flashdata('warning', "You don`t have access to this page");
            redirect(base_url());
        }
    }

    public function getDetailPaymentSetting(){

        $id = $this->input->post('id');

		if ($this->M_payment->getDetailPaymentSetting($id) != false) {
            $data['item'] = $this->M_payment->getDetailPaymentSetting($id);
            
            $this->load->view('payments/ajax/edit_payment', $data);

		} else {
			echo "<center class='py-5'><h4>There is an error when trying get payment setting data!</h4></center>";
		}
    }

    public function index()
    {
        $data['payments']       = $this->M_payment->getAllPayments();
        $data['payments_batch'] = $this->M_master->get_paymentsBatch();
        $this->templateback->view('payments/list-ajax', $data);
    }

    public function settings()
    {
        $data['payments'] = $this->M_payment->getPaymentSettings();
        $this->templateback->view('payments/settings', $data);
    }
    
    public function paymentsGatewaySettings(){
        $data['_gateway_providers']         = $this->M_payment->getGeneralPaymentsSettings('_gateway_providers');
        $data['_midtrans_prod']             = $this->M_payment->getMidtransPaymentsSettings('_midtrans_prod');
        $data['_server_key_sandbox']        = $this->M_payment->getMidtransPaymentsSettings('_server_key_sandbox');
        $data['_client_key_sandbox']        = $this->M_payment->getMidtransPaymentsSettings('_client_key_sandbox');
        $data['_server_key_production']     = $this->M_payment->getMidtransPaymentsSettings('_server_key_production');
        $data['_client_key_production']     = $this->M_payment->getMidtransPaymentsSettings('_client_key_production');
        $data['_xendit_prod']               = $this->M_payment->getXenditPaymentsSettings('_xendit_prod');
        $data['_secret_key_production']     = $this->M_payment->getXenditPaymentsSettings('_secret_key_production');
        $data['_secret_key_sandbox']        = $this->M_payment->getXenditPaymentsSettings('_secret_key_sandbox');

        $this->templateback->view('payments/gateway', $data);
    }
}
