<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    protected $_program_id = 1;
    
    function __construct()
    {
        parent::__construct();
    }

    function setLogTime($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->update('access_auth', ['log_time' => time(), 'device_id' => $this->agent->agent_string()]);
    }

    public function getSetting($key){
        $data = $this->db->get_where('m_settings', ['key' => $key])->row()->value;
        if(isset($data)){
            return $data;
        }else{
            return false;
        }
    }

    // main
    public function get_auth($email)
    {
        $this->db->select('*');
        $this->db->from('access_auth a');
        $this->db->join('access_user b', 'a.user_id = b.user_id');
        $this->db->where('a.email', $email);
        $query = $this->db->get();

        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function cek_auth($email)
    {
        $query = $this->db->get_where('access_auth', ['email' => $email]);

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_userByID($user_id)
    {
        $this->db->select('*');
        $this->db->from('access_auth a');
        $this->db->join('access_user b', 'a.user_id = b.user_id', 'left');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();

        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function cek_userId($user_id)
    {
        $user_id = $this->db->escape($user_id);
        $query = $this->db->query("SELECT * FROM access_auth WHERE user_id = $user_id");
        return $query->num_rows();
    }

    // pendaftaran
    public function register_user()
    {

        // TB AUTH

        $email = htmlspecialchars($this->input->post('email'), true);
        $password = htmlspecialchars($this->input->post('password'), true);
        $referral_code = $this->input->post('referral_code');

        // TB USER
        $name = htmlspecialchars($this->input->post('name'), true);
        $phone = htmlspecialchars($this->input->post('phone'), true);

        // CREATE UNIQ NAME KODE USER

        $string = preg_replace('/[^a-z]/i', '', $name);

        $vocal = ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " "];
        $scrap = str_replace($vocal, "", $string);
        $begin = substr($scrap, 0, 5);
        $uniqid = strtoupper($begin);

        // CREATE KODE USER
        do {
            $user_id = "USR-" . $uniqid . "-" . substr(md5(time()), 0, 6);
        } while ($this->cek_userId($user_id) > 0);

        // TB AUTH
        $auth = [
            'user_id' => $user_id,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'referral_code' => $referral_code,
            'active' => 1, #change to 1 -> auto verif
            'status' => 1, #change to 1 -> auto verif
            'created_at' => time(),
        ];

        $this->db->insert('access_auth', $auth);

        if ($this->db->affected_rows() == true) {

            $user = [
                'user_id' => $user_id,
                'name' => $name,
                'phone' => $phone
            ];

            $this->db->insert('access_user', $user);

            if ($this->db->affected_rows() == true) {

                $chiper = $this->create_aktivasi();

                $aktivasi = [
                    'user_id' => $user_id,
                    'key' => $chiper,
                    'type_id' => 1, #VERIFIKASI email / AKTIVASI AKUN 
                    'status' => 1, #change to 1 -> auto verif
                    'date_created' => time()
                ];

                $this->db->insert('access_token', $aktivasi);
                return ($this->db->affected_rows() != 1) ? false : true;
            } else {
                $this->del_token($user_id, 1); #VERIFIKASI email / AKTIVASI AKUN 
                $this->del_user($user_id);
                return false;
            }
        } else {
            $this->del_user($user_id);
            return false;
        }
    }

    // AKTIVASI / VERIFIKASI

    public function cek_aktivasi($user_id)
    {
        $user_id = $this->db->escape($user_id);
        $query = $this->db->query("SELECT * FROM access_token WHERE user_id = $user_id AND type_id = 1");
        return $query->num_rows();
    }

    public function create_aktivasi()
    {

        // CREATE KODE AKTIVASI
        $this->encryption->initialize(['driver' => 'openssl']);
        do {
            $activation_code = random_int(100000, 999999);
            // ENCRYPT KODE AKTIVASI
            $ciphercode = $this->encryption->encrypt($activation_code);
        } while ($this->cek_aktivasi($activation_code) > 0);

        return $ciphercode;
    }

    public function get_aktivasi($user_id)
    {
        $user_id = $this->db->escape($user_id);
        $query = $this->db->query("SELECT * FROM access_auth WHERE user_id = $user_id AND status = 1");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function aktivasi_kode($kode_aktivasi, $user_id)
    {

        $db_code = $this->encryption->decrypt($this->get_aktivasi($user_id)->key);

        if ($kode_aktivasi == $db_code) {
            return true;
        } else {
            return false;
        }
    }

    public function aktivasi_akun($user_id)
    {

        $this->db->where(['user_id' => $user_id, 'type_id' => 1]);
        $this->db->update('access_token', ['status' => 1]);

        $this->db->where('user_id', $user_id);
        $this->db->update('access_auth', ['active' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    // LUPA password

    public function cek_tokenRecovery($token)
    {
        $token = $this->db->escape($token);
        $query = $this->db->query("SELECT * FROM access_token a WHERE a.key = $token AND a.type_id = 2");

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_tokenRecovery($token)
    {
        $token = $this->db->escape($token);
        $query = $this->db->query("SELECT * FROM access_token a WHERE a.key = $token AND a.type_id = 2");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function insert_token($data)
    {
        $this->db->insert('access_token', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function update_passwordUser($user_id)
    {
        $password = htmlspecialchars($this->input->post("password"), true);
        $email = htmlspecialchars($this->input->post("email"), true);

        $this->db->where(['user_id' => $user_id, 'email' => $email]);
        $this->db->update('access_auth', ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }


    // DELETE

    public function del_token($user_id, $type)
    {
        $this->db->where(['user_id' => $user_id, 'type_id' => $type]);
        $this->db->delete('access_token');
    }

    public function del_user($user_id)
    {
        $user_id = $this->db->escape($user_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('access_auth');
    }

    public function makeOnline($user_id = null){
        $this->db->where('user_id', $user_id);
        $this->db->update('access_auth', ['online' => 1]);
    }

    public function makeOffline($user_id = null){
        $this->db->where('user_id', $user_id);
        $this->db->update('access_auth', ['online' => 0]);
    }

    public function getUsersOnline(){
        return $this->db->get_where('access_auth', ['status !=' => 2, 'online' => 1])->result();
    }
}
