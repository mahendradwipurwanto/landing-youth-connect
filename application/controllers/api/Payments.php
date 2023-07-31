<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');

defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
{
    // config
    protected $_midtrans_prod = false;
    protected $_server_key_production = 'Mid-server-gXaK3X0M-oZhY4RPL0g2Mt_z';
    protected $_server_key_sandbox = 'SB-Mid-server-qC8YfWnkcF_fjPrZmuNEwb8P';
    protected $_client_key_production = 'SB-Mid-client-LAEwpi34CdNrwLgt';
    protected $_client_key_sandbox = 'SB-Mid-client-LAEwpi34CdNrwLgt';
    protected $_user_testflight = ['USER-ADM-01', 'USR-MHNDR-b6331'];

    // construct
    public function __construct()
    {
        parent::__construct();

        $this->load->model(['M_master', 'M_payment', 'M_auth']);

        // get master midtrans setting
        $this->_midtrans_prod = $this->M_payment->getMidtransConfig('_midtrans_prod') == 1 ? true : false;
        $this->_server_key_production = $this->M_payment->getMidtransConfig('_server_key_production');
        $this->_server_key_sandbox = $this->M_payment->getMidtransConfig('_server_key_sandbox');
        $this->_client_key_production = $this->M_payment->getMidtransConfig('_client_key_production');
        $this->_client_key_sandbox = $this->M_payment->getMidtransConfig('_client_key_sandbox');

        if (!is_null($this->M_payment->getMidtransConfig('_user_testflight'))) {
            $this->_user_testflight = explode(',', $this->M_payment->getMidtransConfig('_user_testflight')) ;
        }

        $params = [
            'server_key' => $this->_midtrans_prod == true ? $this->_server_key_production : $this->_server_key_sandbox,
            'production' => $this->_midtrans_prod
        ];

        $this->load->library(['Uploader', 'Midtrans', 'Veritrans', 'MidtransPayments']);
        $this->midtrans->config($params);
        $this->veritrans->config($params);
    }

    public function webhook()
    {
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        $detail_payment = $this->M_payment->getUserPaymentDetailByOrderId($result->order_id);

        $webhook = "https://discord.com/api/webhooks/1046973518002257981/dWoW5mA8WQXEG8eHQSx7rl8i2hcc5ykVgkjYozpdC7kLN9pfYhC5wuuQzZqlHFweWYrk";
        $timestamp = date("c", strtotime("now"));

        if (!is_null($detail_payment)) {
            $data = [
                'status'        => $this->midtranspayments->cvtStatusToInt($result->transaction_status),
                'modified_at'   => time(),
                'modified_by'   => 0
            ];

            $where = [
                'id'  => $detail_payment->id,
                'order_id'  => $result->order_id,
                'transaction_id'  => $result->transaction_id,
            ];

            $this->M_payment->saveLogHistoryPayments($detail_payment);

            if ($result->status_code == 200) {
                $this->M_payment->updatePaymentG($data, $where);
            } elseif ($result->status_code == 202) {
                $this->M_payment->updatePaymentG($data, $where);
            } elseif ($result->status_code == 201) {
                // todo
            } else {
                $this->M_payment->updatePaymentG($data, $where);
            }

            $msg = json_encode([
                "username" => "MEYS ".date("Y")." - Webhook Payments",

                "tts" => false,

                "embeds" => [
                    [
                        // Title
                        "title" => "Webhook succesful trigger",

                        // Embed Type, do not change.
                        "type" => "rich",

                        // Description
                        "description" => !empty($result) ? "```".json_encode($result)."```" : 'No data yet',

                        // Timestamp, only ISO8601
                        "timestamp" => $timestamp,

                        // Left border color, in HEX
                        "color" => hexdec("3366ff"),
                    ]
                ]

            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            discordmsg($msg, $webhook);
        } else {
            $msg = json_encode([
                "username" => "MEYS ".date("Y")." - Webhook Payments",

                "tts" => false,

                "embeds" => [
                    [
                        // Title
                        "title" => "Webhook succesful trigger",

                        // Embed Type, do not change.
                        "type" => "rich",

                        // Description
                        "description" => "Can't find payment refer to order id #{$result->order_id}",

                        // Timestamp, only ISO8601
                        "timestamp" => $timestamp,

                        // Left border color, in HEX
                        "color" => hexdec("3366ff"),
                    ]
                ]

            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            discordmsg($msg, $webhook);
        }
    }

    public function pay()
    {
        // check session
        if (checkSession()['status'] == false) {
            $this->session->set_userdata('redirect', checkSession()['uri']);
            $this->session->set_flashdata('notif_warning', "Please login to continue");
            redirect('sign-in');
        }

        if ($this->_midtrans_prod == false) {
            $is_allow_gateway = checkAllowGateway($this->session->userdata('user_id'), $this->_user_testflight);

            if ($is_allow_gateway == false) {
                $this->session->set_flashdata('warning', 'Your account is not allowed for this payment method !');
                redirect(site_url('user'));
                return false;
            }
        }

        // get all pending payment from this account and set it to canceled, for new payment
        $this->M_payment->bulkCancelPayments();

        // because payment data not saved when init payment and not yet use continued payment. it must temp delete previous uncomplete payment
        $this->M_payment->bulkDeletePayments();

        // init var
        $order_id =  rand();

        $user_id = $this->session->userdata('user_id');

        // init post
        $payment_batch_id = $this->input->post('payment_batch');
        $amount = $this->input->post('amount');
        $amount_usd = $this->input->post('amount_usd');

        // get user detail
        $user = $this->M_auth->get_userByID($user_id);

        // get payment item / batch
        $batch = $this->M_master->get_paymentsBatchByID($payment_batch_id);

        // bracket fullname
        $name = explode(' ', $user->name);
        $user->first_name = $name[0];
        $user->last_name = end($name);

        // init based post table
        $data_load = [
            'user_id' => $user_id,
            'order_id' => $order_id,
            'payment_batch' => $payment_batch_id,
            'amount' => $amount,
            'amount_usd' => $amount_usd,
            'status' => 1,
            'created_at' => time(),
            'created_by' => $user_id
        ];

        $save = $this->M_payment->savePaymentG($data_load);
        if ($save['status'] == true) {
            // Required
            $transaction_details = [
                'order_id' => $order_id,
                'gross_amount' => $amount, // no decimal allowed for creditcard
            ];

            // Optional

            $item_details = [
                'id' => $payment_batch_id,
                'price' => $amount,
                'quantity' => 1,
                'name' => $batch->summit
            ];

            $address = [
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'phone'         => $user->phone,
                'country_code'  => 'IDN'
            ];

            // Optional
            $customer_details = [
                'first_name'        => $user->first_name,
                'last_name'         => $user->last_name,
                'email'             => $user->email,
                'phone'             => $user->phone,
                'billing_address'   => $address,
                'shipping_address'  => $address
            ];

            // Data yang akan dikirim untuk request redirect_url.
            $credit_card['secure'] = true;
            //set save_card true to enable oneclick or 2click
            //$credit_card['save_card'] = true;

            $custom_expiry = [
                'start_time' => date("Y-m-d H:i:s O", time()),
                'unit' => 'day',
                'duration'  => 1
            ];

            $transaction_data = [
                'transaction_details'   => $transaction_details,
                'item_details'          => $item_details,
                'customer_details'      => $customer_details,
                'credit_card'           => $credit_card,
                'expiry'                => $custom_expiry
            ];

            error_log(json_encode($transaction_data));

            // init log
            $log = [
                'method_type' => 1,
                'log' => json_encode($transaction_data),
                'order_id' => $order_id,
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];

            $this->M_payment->saveLogPayment($log);

            $snapToken = $this->midtrans->getSnapToken($transaction_data);

            // snap log
            $log = [
                'method_type' => 1,
                'log' => $snapToken,
                'order_id' => $order_id,
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];

            $this->M_payment->saveLogPayment($log);

            echo $snapToken;
        } else {
            $this->session->set_flashdata('warning', 'There is something wrong, when trying to make payment data. Contact our TEAM and say you got code 422#3');
            redirect($this->agent->referrer());
        }
    }

    public function finish()
    {
        // check session
        if (checkSession()['status'] == false) {
            $this->session->set_userdata('redirect', checkSession()['uri']);
            $this->session->set_flashdata('notif_warning', "Please login to continue");
            redirect('sign-in');
        }

        $result = json_decode($this->input->post('result_data'));
        $response = $this->midtranspayments->cvtPaymentMethodMidtrans($result);

        // update data payment
        $data = $response;

        $update = [
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $data = array_merge($data, $update);

        $where = [
            'order_id' => $response['order_id'],
            'user_id' => $this->session->userdata('user_id'),
        ];

        $this->M_payment->updatePaymentG($data, $where);

        // snap log
        $log = [
            'method_type' => 1,
            'log' => "Success make payments, waiting payment from user if still pending",
            'order_id' => $response['order_id'],
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->M_payment->saveLogPayment($log);

        $this->session->set_flashdata('notif_success', 'Your payments has been saved ! Please pay acording your payment method !');
        redirect(site_url('user/payments-transaction/'.$response['order_id'].'?method=gateway'));
        // redirect to detail payments
    }

    public function status($order_id = null)
    {
        if ($this->input->post('order_id')) {
            $order_id = $this->input->post('order_id');
        }

        $data = $this->veritrans->status($order_id);

        $data = [
            'status'        => $this->midtranspayments->cvtStatusToInt($data->transaction_status),
            'modified_at'   => time(),
            'modified_by'   => $this->session->userdata('user_id')
        ];

        $where = [
            'order_id'  => $order_id,
            'user_id'   => $this->session->userdata('user_id')
        ];

        $this->M_payment->updatePaymentG($data, $where);
    }

    public function cancel($order_id = null)
    {
        // $payment_detail  = $this->M_payment->getUserPaymentDetailByOrderId($order_id);

        if ($this->input->post('order_id')) {
            $order_id = $this->input->post('order_id');
        }

        $this->veritrans->cancel($order_id);
        $data = [
            'status'        => 3,
            'modified_at'   => time(),
            'modified_by'   => $this->session->userdata('user_id')
        ];

        $where = [
            'order_id'  => $order_id,
            'user_id'   => $this->session->userdata('user_id')
        ];

        if ($this->M_payment->updatePaymentG($data, $where)['status'] == true) {
            $this->session->set_flashdata('notif_success', 'Your payment has been canceled !');
            redirect(site_url('user/payment'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong when try to cancel your payment, please contact us !');
            redirect($this->agent->referrer());
        }
    }

    public function savePaymentSettings()
    {
        if ($this->M_payment->savePaymentSettings() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes payments settings');
            redirect(site_url('admin/payment-settings'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes payments settings');
            redirect($this->agent->referrer());
        }
    }

    public function manualPayment()
    {
        // check session
        if (checkSession()['status'] == false) {
            $this->session->set_userdata('redirect', checkSession()['uri']);
            $this->session->set_flashdata('notif_warning', "Please login to continue");
            redirect('sign-in');
        }

        if (isset($_FILES['image'])) {
            $path = "berkas/user/{$this->session->userdata('user_id')}/payments/{$this->input->post('payment_batch')}/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);

            if ($upload['status'] == true) {
                if ($this->M_payment->manualPayment($upload['filename']) == true) {
                    $subject = "Payment send - Istanbull Youth Summit";
                    $message = "Hi, your manual transfer payment for Middle East Yout Summit has been send to our system. Please wait for further notice until our Team verifed your payment proof";

                    // mengirimemail
                    sendMail(htmlspecialchars($this->session->userdata("email"), true), $subject, $message);

                    $this->session->set_flashdata('notif_success', 'Succesfuly send your payment ');
                    redirect(site_url('user/payment'));
                } else {
                    $this->session->set_flashdata('notif_warning', 'There is a problem when trying to send your payment, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('notif_warning', 'Please provide evidance that you already send payment !');
            redirect($this->agent->referrer());
        }
    }

    public function manualPaymentCancel()
    {
        // check session
        if (checkSession()['status'] == false) {
            $this->session->set_userdata('redirect', checkSession()['uri']);
            $this->session->set_flashdata('notif_warning', "Please login to continue");
            redirect('sign-in');
        }

        if ($this->M_payment->manualPaymentCancel() == true) {
            $subject = "Payment cancel - Istanbull Youth Summit";
            $message = "Hi, you has been canceled your payment for Istanbull Youth Summit. Please make payment as requested if you still not yet make payment";

            // mengirimemail
            sendMail(htmlspecialchars($this->session->userdata("email"), true), $subject, $message);

            $this->session->set_flashdata('notif_success', 'Succesfuly cancel your current payment ');
            redirect(site_url('user/payment'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is a problem when trying to cancel your current payment, try again later');
            redirect($this->agent->referrer());
        }
    }

    public function verificationPayment()
    {
        return $this->M_payment->verificationPayment();
        // if ($this->M_payment->verificationPayment() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly verification payment ');
        //     redirect(site_url('admin/payments'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to verification payment, try again later');
        //     redirect($this->agent->referrer());
        // }
    }

    public function rejectedPayment()
    {
        return $this->M_payment->rejectedPayment();
        // if ($this->M_payment->rejectedPayment() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly rejected payment ');
        //     redirect(site_url('admin/payments'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to rejected payment, try again later');
        //     redirect($this->agent->referrer());
        // }
    }

    public function pendingPayment()
    {
        return $this->M_payment->pendingPayment();
        // if ($this->M_payment->pendingPayment() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly pending payment ');
        //     redirect(site_url('admin/payments'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to pending payment, try again later');
        //     redirect($this->agent->referrer());
        // }
    }

    public function cancelPayment()
    {
        return $this->M_payment->cancelPayment();
        // if ($this->M_payment->cancelPayment() == true) {
        //     $this->session->set_flashdata('notif_success', 'Succesfuly cancel payment ');
        //     redirect(site_url('admin/payments'));
        // } else {
        //     $this->session->set_flashdata('notif_warning', 'There is a problem when trying to cancel payment, try again later');
        //     redirect($this->agent->referrer());
        // }
    }
    
    public function invoice(){
        // GET DATA 
        $file   = ($this->input->post('file'));
        $no     = ($this->input->post('no'));
        $name   = ($this->input->post('name'));

        $gambar = base_url().$file;

        // CREATE GAMBAR
        $image  = imagecreatefrompng($gambar);
        $black  = imageColorAllocate($image, 0, 0, 0);

        // ==== NO
        $font_size = 20;
        $y = 258;
        $font = realpath('assets/font/Poppins_Bold.TTF');
        $this->add_text($image, $no, $font_size, $black, $font, $y, 60);

        // ==== NAME
        $font_size = 18;
        $y = 403;
        $font = realpath('assets/font/Poppins_Bold.TTF');
        $this->add_text($image, strtoupper($name), $font_size, $black, $font, $y, 28);

        ob_clean();

        header("Content-type: image/png");

        imagepng($image);

        // Clear Memory
        imagedestroy($image);
    }
    
    public function add_text($image, $text, $size, $color, $font, $y, $_x)
    {
        //definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
        $image_width = imagesx($image);
        //membuat textbox agar text centered
        $text_box = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_box[2] - $text_box[0]; // lower right corner - lower left corner
        $text_height = $text_box[3] - $text_box[1];

        // center
        $x = ($image_width / 2) - ($text_width / 2) - 110;

        //generate sertifikat beserta namanya
        imagettftext($image, $size, 0, $x + $_x, $y, $color, $font, $text);
    }

    public function ubahProviders()
    {
        if ($this->M_payment->ubahProviders() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes payments settings');
            redirect(site_url('admin/payments-gateway-settings'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes payments settings');
            redirect($this->agent->referrer());
        }
    }

    public function ubahMidtrans()
    {
        if ($this->M_payment->ubahMidtrans() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes midtrans config');
            redirect(site_url('admin/payments-gateway-settings?tab=midtrans'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes midtrans config');
            redirect(site_url('admin/payments-gateway-settings?tab=midtrans'));
        }
    }

    public function ubahXendit()
    {
        if ($this->M_payment->ubahXendit() == true) {
            $this->session->set_flashdata('notif_success', 'Successfully changes xendit config');
            redirect(site_url('admin/payments-gateway-settings?tab=xendit'));
        } else {
            $this->session->set_flashdata('notif_warning', 'There is something wrong, when trying to changes xendit config');
            redirect(site_url('admin/payments-gateway-settings?tab=xendit'));
        }
    }
}
