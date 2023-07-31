<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
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

    public function updateOnlineStatus()
    {
        $users = $this->M_auth->getUsersOnline();
        $arr = "";
        if (!empty($users)) {
            foreach ($users as $key => $val) {
                if (strtotime("+6 minutes", $val->log_time) < time()) {
                    $this->M_auth->makeOffline($val->user_id);
                    $arr .= "- {$val->user_id} - {$val->email}: {$val->device} \n";
                }
            }
        }

        $webhook = "https://discord.com/api/webhooks/1082140370009325659/1OwsXjS4Yz6MukJPgiY30K37XBf-cJ_WpruzP4rD4FZUv5wvWrNwG--Avfjqs13E0a0D";
        $timestamp = date("c", strtotime("now"));
        $msg = json_encode([
            "username" => "MEYS ".date("Y"),

            "tts" => false,

            "embeds" => [
                [
                    // Title
                    "title" => "Cronjob updated online users",

                    // Embed Type, do not change.
                    "type" => "rich",

                    // Description
                    "description" => $arr != "" ? "``` {$arr} ```" : 'No online users',

                    // Timestamp, only ISO8601
                    "timestamp" => $timestamp,

                    // Left border color, in HEX
                    "color" => hexdec("3366ff"),
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        discordmsg($msg, $webhook);
        ej($arr);
    }

    public function backupDb()
    {
        #RUN EVERY HOURS

        // load database utility CI
        $this->load->dbutil();

        // set var name
        $date = date('ymd_H-i-s');

        // set prefix backup name
        $backup_name = "backup-db-{$date}.sql";

        // config backup
        $conf = [
            'format' => 'txt',
            'filename' => $backup_name,
            'add_insert' => true,
            'foreign_key_checks' => false
        ];

        // prepare backup
        $backup = $this->dbutil->backup($conf);

        // set location
        $path = "./berkas/backup_db/";

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // remove backup more than a days
        $files = glob("{$path}*");
        $now   = time();

        $list_file = "";
        foreach ($files as $file) {
            if (is_file($file)) {
                $list_file .= "{$file} \n";
                if ($now - filemtime($file) >= 60 * 60 * 24) { // 1 days delete
                    unlink($file);
                }
            }
        }

        // params discord
        $webhook = "https://discord.com/api/webhooks/1082140370009325659/1OwsXjS4Yz6MukJPgiY30K37XBf-cJ_WpruzP4rD4FZUv5wvWrNwG--Avfjqs13E0a0D";
        $timestamp = date("c", strtotime("now"));

        // create backup file
        file_put_contents("{$path}{$backup_name}", $backup);

        $msg = json_encode([
            "username" => "MEYS ".date("Y")." - Backup DB",

            "tts" => false,

            "embeds" => [
                [
                    // Title
                    "title" => "Cronjob backup DB",

                    // Embed Type, do not change.
                    "type" => "rich",

                    // Description
                    "description" => "``` Backup DB on {$date} \n\n LIST CURRENT FILE: \n{$list_file}```",

                    // Timestamp, only ISO8601
                    "timestamp" => $timestamp,

                    // Left border color, in HEX
                    "color" => hexdec("3366ff"),
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


        discordmsg($msg, $webhook);

        ej($backup);
    }

    public function sendAnnouncementsUsers()
    {
        $users = $this->M_auth->getUsersAnnouncements();
        $arr = [];
        if (!empty($users)) {
            foreach ($users as $key => $val) {
                if (strtotime("+6 minutes", $val->log_time) < time()) {
                    $this->M_auth->makeOffline($val->user_id);
                    $arr[$key] = $val;
                }
            }
        }

        ej($arr);
    }

    public function checkPaymentsUpdate(){
        $this->db->select('a.user_id, b.name, d.email, a.is_payment, e.summit as batch')
        ->from('tb_participants a')
        ->join('access_user b', 'a.user_id = b.user_id')
        ->join('tb_payments c', 'a.user_id = c.user_id')
        ->join('access_auth d', 'a.user_id = d.user_id')
        ->join('m_payments_batch e', 'c.payment_batch = e.id')
        ->where(['a.is_payment' => 0, 'c.status' => 2, 'e.is_registration' => 1]);

        $query = $this->db->get()->result();

        $string = "";
        if(!empty($query)){
            foreach ($query as $key => $val) {
                $this->db->where('user_id', $val->user_id);
                $this->db->update('tb_participants', ['is_payment' => 1]);

                $string .= "> #{$val->user_id} - {$val->name} {$val->email} \n";
            }
        }else{
            $string = "No pending regristration payment";
        }

        // params discord
        $webhook = "https://discord.com/api/webhooks/1082140370009325659/1OwsXjS4Yz6MukJPgiY30K37XBf-cJ_WpruzP4rD4FZUv5wvWrNwG--Avfjqs13E0a0D";
        $timestamp = date("c", strtotime("now"));

        $msg = json_encode([
            "username" => "MEYS ".date("Y")." - Update payments",

            "tts" => false,

            "embeds" => [
                [
                    // Title
                    "title" => "Cronjob update Payments",

                    // Embed Type, do not change.
                    "type" => "rich",

                    // Description
                    "description" => "``` {$string} ```",

                    // Timestamp, only ISO8601
                    "timestamp" => $timestamp,

                    // Left border color, in HEX
                    "color" => hexdec("3366ff"),
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


        discordmsg($msg, $webhook);


        ej($string);
    }

    public function checkPaymentsPending(){
        $this->db->select('a.id, a.user_id, a.order_id, a.transaction_id, b.name, c.email, a.status, a.status_code')
        ->from('tb_payments a')
        ->join('access_user b', 'a.user_id = b.user_id')
        ->join('access_auth c', 'a.user_id = c.user_id')
        ->join('m_payments_settings d', 'a.payment_setting = d.id')
        ->where(['a.deleted_at' => null, 'a.status' => 1, 'd.type_method' => 'gateway_midtrans']);

        $query = $this->db->get()->result();
        
        $string = "";
        if(!empty($query)){
            foreach ($query as $key => $val) {
                $detail_payment = $this->M_payment->getUserPaymentDetailByOrderId($val->order_id);

                $result = $this->veritrans->status($val->order_id);

                $data = [
                    'status'        => $this->midtranspayments->cvtStatusToInt($result->transaction_status),
                    'modified_at'   => time(),
                    'modified_by'   => 0
                ];

                $where = [
                    'id'  => $val->id,
                    'order_id'  => $val->order_id,
                    'transaction_id'  => $val->transaction_id,
                ];

                $this->M_payment->saveLogHistoryPayments($detail_payment);

                $this->M_payment->updatePaymentG($data, $where);

                $string .= "> #{$val->order_id} - {$val->name} {$val->email} \n";
            }
        }else{
            $string = "No pending midtrans payment";
        }

        // params discord
        $webhook = "https://discord.com/api/webhooks/1082140370009325659/1OwsXjS4Yz6MukJPgiY30K37XBf-cJ_WpruzP4rD4FZUv5wvWrNwG--Avfjqs13E0a0D";
        $timestamp = date("c", strtotime("now"));

        $msg = json_encode([
            "username" => "MEYS ".date("Y")." - Update midtrans pending payments",

            "tts" => false,

            "embeds" => [
                [
                    // Title
                    "title" => "Cronjob update mpdtrans pending Payments",

                    // Embed Type, do not change.
                    "type" => "rich",

                    // Description
                    "description" => "``` {$string} ```",

                    // Timestamp, only ISO8601
                    "timestamp" => $timestamp,

                    // Left border color, in HEX
                    "color" => hexdec("3366ff"),
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


        discordmsg($msg, $webhook);


        ej($string);
    }
}
