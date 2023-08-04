<?php

use GuzzleHttp\Exception\RequestException;

defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    protected $_master_password;

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_auth', 'M_master']);
        // $this->load->library('apirequests');

        $this->_master_password = $this->M_auth->getSetting('master_password') != false ? $this->M_auth->getSetting('master_password') : 'SU_MHND19';
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_info', "Successfuly sign in, welcome back!");
            redirect(base_url());
        } else {

            if ($this->input->get('reff')) {
                $this->session->set_userdata('redirect', $this->input->get('reff'));
            }

            $data['act']    = $this->input->get('act');

            $this->templateauth->view('authentication/login', $data);
        }
    }

    public function signUp()
    {
        if ($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_info', "You already sign in, please sign out first to register new account");
            redirect(base_url());
        } else {

            $referral_code = null;
            $ambassador = null;

            if ($this->input->get('affiliate_code')) {
                $this->session->unset_userdata('referral_code');

                $referral_code = $this->input->get('affiliate_code');
                $ambassador = $this->M_master->getAmbasadorByReferral($referral_code);

                $this->session->set_userdata(['referral_code' => $referral_code]);
            } elseif ($this->session->has_userdata('referral_code')) {
                $referral_code = $this->session->userdata('referral_code');
                $ambassador = $this->M_master->getAmbasadorByReferral($referral_code);
            }

            $data['referral_code'] = $referral_code;
            $data['referral'] = $ambassador;

            // ej($data);
            $this->templateauth->view('authentication/register', $data);
        }
    }

    public function suspend()
    {
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Successfuly sign in, you can continue your activites");
            redirect(site_url('sign-in'));
        } else {
            $this->templateauth->view('authentication/suspend');
        }
    }

    public function verificationEmail()
    {

        // cek apakah user sudah sign in
        if ($this->session->userdata('logged_in') == true) {
            $email = htmlspecialchars($this->session->userdata('email'), true);

            // cek apakah terdapat data verifikasi
            if ($this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('user_id'), true)) != false) {
                // mengambil data verifikasi
                $aktivasi = $this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('user_id'), true));

                // cek apakah status masih belum verifikasi
                if ($aktivasi->status == 0) {

                    // cek apakah mengirim permintaan pengiriman email verifikasi
                    if ($this->input->get('act') == "send-email") {
                        $subject = "Verification code - Istanbull Youth Summit";
                        $message = "Your verification code : <br><br><center><h1 style='font-size: 62px;'>{$this->encryption->decrypt($aktivasi->key)}</h1></center><br><br><small class='text-muted'>This code only valid for 24 hours. <span class='text-danger'>If code expired please redo verification process</b>.</span></small>";

                        // mengirim email
                        if (sendMail($email, $subject, $message) == true) {
                            $this->session->set_flashdata('success', 'Registration is successful, please enter the activation code that we have sent to your email !');
                        } else {
                            $this->session->set_flashdata('notif_error', 'We had a problem when try to send verification to your email. Please contact our team with code 422-1 !');
                            redirect(site_url('verification-email'));
                        }
                    } elseif ($this->input->get('act') == "resend-email") {
                        $subject = "Verification code - Istanbull Youth Summit";
                        $message = "Your verification code : <br><br><center><h1 style='font-size: 62px;'>{$this->encryption->decrypt($aktivasi->key)}</h1></center><br><br><small class='text-muted'>This code only valid for 24 hours. <span class='text-danger'>If code expired please redo verification process.</span></small>";

                        // mengirim email
                        if (sendMail($email, $subject, $message) == true) {
                            $this->session->set_flashdata('success', 'Successfuly send an email to ' . $email . ' !');
                        } else {
                            $this->session->set_flashdata('notif_error', 'We had a problem when try to send verification to your email. Please contact our team with code 422-1 !');
                            redirect(site_url('verification-email'));
                        }
                    }

                    $data['mail'] = $email;
                    $data['activation_code'] = $this->encryption->decrypt($aktivasi->key);
                    $this->templateauth->view('authentication/verification_code', $data);
                } else {
                    $this->session->set_flashdata('notif_warning', 'You already verified your account !');
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('notif_error', 'There is something wrong. when try to get your account information !');
                redirect(site_url('sign-in'));
            }
        } else {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->unset_userdata('redirect');
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Please sign in to continue");
            redirect('sign-in');
        }
    }

    public function forgotPassword()
    {
        $this->templateauth->view('authentication/forgot');
    }

    // proses sign in
    function proses_login()
    {
        // menerima inputan, dan memparse spesial karakter
        $email = htmlspecialchars($this->input->post('email', true));
        $pass = htmlspecialchars($this->input->post('password'), true);

        $url = 'auth/login';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $data = [
            'email' => $email,
            'password' => $pass
        ];

        try {
            $response = $this->apirequests->post($url, $data, $headers);

            if ($response['status_code'] == 200) {

                // mengambil data user dengan param email
                $user = $response['data']['user'];

                if ($user['weight'] == 0 || $user['weight'] == 1 || $user['weight'] == 2) {
                    $this->session->set_flashdata('notif_warning', "You not allowed to sign from this website");
                    // SESS DESTROY
                    redirect('sign-in');
                }

                $this->M_auth->makeOnline($user['id']);

                // setting data session
                $sessiondata = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'role' => $user['weight'],
                    'program_id' => $user['program_id'],
                    'token' => $response['data']['access_token'],
                    'logged_in' => true
                ];

                // menyimpan data session
                $this->session->set_userdata($sessiondata);

                $this->M_auth->setLogTime($user['id']);
                // CEK HAK AKSES
                if ($user['weight'] == 3) {
                    $this->session->set_flashdata('notif_success', "Hi {$user['name']}, welcome ambassador");
                    redirect(site_url('ambassador'));
                } elseif ($user['weight'] == 4) {
                    $this->session->set_flashdata('notif_success', "Hi {$user['name']}, welcome partner");
                    redirect(site_url('partner'));
                } elseif ($user['weight'] == 5) {
                    // cek status dari user yang lagin - 0: BELUM AKTIF - 1: AKTIF - 2: SUSPEND;
                    if ($user['status'] == 0) {
                        $this->session->set_flashdata('error', "Hi {$user['name']}, please verified your email first");
                        redirect(site_url('verification-email'));
                    } elseif ($user['status'] == 2) {
                        $this->session->set_flashdata('error', "Hi {$user['name']}, your account has been suspended. Please contact admin for more information");
                        redirect(site_url('suspend'));
                    } else {
                        if ($this->session->userdata('redirect')) {
                            $this->session->set_flashdata('notif_success', 'Hi, sign in berhasil, anda dapat melanjutkan aktivitas anda !');
                            redirect($this->session->userdata('redirect'));
                        } else {
                            $this->session->set_flashdata('notif_success', "Welcome, {$user['name']}");
                            redirect(site_url('user'));
                        }
                    }
                } else {
                    $this->session->set_flashdata('notif_success', "Welcome, {$user['name']}");
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('notif_error', $response['errors']);
                redirect('sign-in');
            }
        } catch (RequestException $e) {
            // Handle Guzzle RequestException here
            $message = $e->getMessage();

            $this->session->set_flashdata('notif_error', $message);
            redirect('sign-in');
        }
    }

    // proses pendaftaran
    public function proses_daftar()
    {

        // menerimaemaildan password serta memparse karakter spesial
        $name = htmlspecialchars($this->input->post('name'), true);
        $email = htmlspecialchars($this->input->post('email'), true);
        $password = htmlspecialchars($this->input->post('password'), true);
        $password_ver = htmlspecialchars($this->input->post('confirmPassword'), true);

        $url = 'auth/register';
        $headers = [
            'Content-Type' => 'application/json',
            'Program_id' => 1,
        ];

        $data = [
            "fullname" => $name,
            "email" => $email,
            "password" => $password,
            "is_participant" => true,
            "referral_code" => null,
            "partner_code" => null,
            "is_google" => false
        ];

        // cek apakahemailvalid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // cek apakah password sama dengan konfirmasi password
            if ($password == $password_ver) {
                try {
                    $response = $this->apirequests->post($url, $data, $headers);

                    if ($response['status_code'] == 201) {
                        $user = $response['data']['user'];

                        $this->session->unset_userdata('referral_code');

                        // setting data session
                        $sessiondata = [
                            'user_id' => $user['id'],
                            'email' => $user['email'],
                            'name' => $user['name'],
                            'role' => $user['weight'],
                            'program_id' => $user['program_id'],
                            'token' => $response['data']['access_token'],
                            'logged_in' => true
                        ];
                        // menyimpan data session
                        $this->session->set_userdata($sessiondata);

                        // mengirimkan email selamat bergabung
                        $subject = "Welcome to Istanbull Youth Summit";
                        $message = "Hi {$user->name}, Congratulations on joining us at the Istanbull Youth Summit. Please activate your account with the activation code that we have sent to your email";

                        // sendMail($email, $subject, $message);

                        // $this->session->set_flashdata('error', 'Registration is successful, we have sent an activation code to your email. Please enter the code to activate your account!');
                        // mengirimkan user untuk verifikasi email
                        // mengambil data user dengan param email
                        $user = $this->M_auth->get_auth($email);
                        redirect(site_url('verification-email?act=send-email'));
                    } else {
                        $this->session->set_flashdata('notif_error', $response['errors']);
                        redirect('sign-up');
                    }
                } catch (RequestException $e) {
                    // Handle Guzzle RequestException here
                    $message = $e->getMessage();

                    $this->session->set_flashdata('notif_error', $message);
                    redirect('sign-up');
                }
            } else {
                $this->session->set_flashdata('warning', 'Password not match!');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('warning', 'Please enter a valid email address!');
            redirect($this->agent->referrer());
        }
    }

    function proses_verifikasiEmail()
    {
        // cek apakah user sudah sign in ke sistem
        if ($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')) {

            // menerima kode verifikasi
            $activation_code = htmlspecialchars($this->input->post('activation_code'), true);
            // mengambil data verifikasi
            $aktivasi = $this->M_auth->get_aktivasi(htmlspecialchars($this->session->userdata('user_id'), true), true);

            // cek apakah waktu verifikasi telah melebihi 1x24 jam
            if (time() - ($aktivasi->date_created < (60 * 60 * 24))) {

                // cek apakah kode verifikasi benar
                if ($this->M_auth->aktivasi_kode(str_replace('-', '', $activation_code), $this->session->userdata('user_id')) == true) {

                    // memverivikasi email
                    if ($this->M_auth->aktivasi_akun($this->session->userdata('user_id')) == true) {

                        $this->session->set_flashdata('success', "Successfuly verified your email, welcome to Istanbull Youth Summit!");
                        redirect(site_url('user'));
                    } else {
                        $this->session->set_flashdata('notif_error', 'There is something wrong, try again later !');
                        redirect($this->agent->referrer());
                    }
                } else {
                    $this->session->set_flashdata('notif_warning', 'Verification code wrong, try again !');
                    redirect($this->agent->referrer());
                }
            } else {

                $this->M_auth->del_user($this->session->userdata('user_id'));
                $this->session->set_flashdata('error', 'Verification code already expired, please re do verification process. ');
                redirect(site_url('logout'));
            }
        } else {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->unset_userdata('redirect');
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Please sign in to continue");
            redirect('sign-in');
        }
    }

    public function proses_lupaPassword()
    {
        // cek apakahemailada
        if ($this->M_auth->cek_auth(htmlspecialchars($this->input->post("email"), true)) == true) {

            // mengambil data user, param email
            $user = $this->M_auth->get_auth(htmlspecialchars($this->input->post("email"), true));

            // menghapus token permintaan lupa password sebelumnya
            $this->M_auth->del_token($user->user_id, 2);

            // create token for recovery
            do {
                $token = bin2hex(random_bytes(32));
            } while ($this->M_auth->cek_tokenRecovery($token) == true);

            $token = $token;
            // atur data untuk menyimpan token recovery password
            $data = [
                'user_id' => $user->user_id,
                'key' => $token,
                'type' => 2, //2. CHANGE PASSWORD
                'date_created' => time()
            ];

            // simpan data token recovery password
            $this->M_auth->insert_token($data);

            // memparse email yang diinputkan
            $email = htmlspecialchars($this->input->post("email"), true);

            // setting data untuk dikirim ke email
            $subject = "Recovery password request - Istanbull Youth Summit";
            $message = 'Hi, we received a recovery password request for email <b>' . $email . '</b>.<br>Please click the button below to reset your password! <br><hr><br><center><a href="' . base_url() . 'reset-password/' . $token . '" style="background-color: #f8c259;border:none;color:#fff;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;">Reset Password</a></center><br><br>atau click this link: <br>' . base_url() . 'reset-password/' . $token . '<br><br><small class="text-muted">The link will only be valid for 24 hours, if the link has expired, please repeat the password reset process</small>';

            // mengirim ke email
            if (sendMail($email, $subject, $message) == true) {
                $this->session->set_flashdata('success', 'Successfully sent an email, check your inbox or spam folder in your email');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', 'An error occurred while trying to send a password reset link to your email!');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('error', 'Can`t find account by email ' . $this->input->post("email") . ' !');
            redirect($this->agent->referrer());
        }
    }

    public function ubah_password($token)
    {

        // cek apakah token valid
        if ($this->M_auth->get_tokenRecovery($token) == false) {
            $this->session->set_flashdata('error', 'Link unknown, please repeat the Recovery password request if this still happens');
            redirect(site_url('sign-in'));
        } else {

            // mengambil data token
            $data_token = $this->M_auth->get_tokenRecovery($token);

            // mengambil data user berdasarkan kode user
            $user = $this->M_auth->get_userByID($data_token->user_id);

            // cek apakah waktu token valid kurang dari 24 jam
            if (time() - $data_token->date_created < (60 * 60 * 24)) {

                $data['email'] = $user->email;
                $data['token'] = $token;
                $this->templateauth->view('authentication/reset', $data);
            } else {

                // menghapus token recovery, meminta mengulangi proses
                $this->M_auth->del_token($user->user_id, 2);

                $this->session->set_flashdata('error', 'The reset password link has expired, please do the password reset process again.');
                redirect(site_url('forgot-password'));
            }
        }
    }

    public function proses_resetPassword()
    {

        // cek apakah akun user ada
        if ($this->M_auth->cek_auth(htmlspecialchars($this->input->post("email"), true)) == true) {

            // cek apakah password sama

            if ($this->input->post('password') == $this->input->post('confirmPassword')) {

                // mengambil data user
                $user = $this->M_auth->get_auth(htmlspecialchars($this->input->post("email"), true));
                // update password user
                if ($this->M_auth->update_passwordUser($user->user_id) == true) {

                    // menghapus token permintaan lupa password
                    $this->M_auth->del_token($user->user_id, 2);

                    // atur dataemailperubahan password
                    $now = date("d F Y - H:i");
                    $email = htmlspecialchars($this->input->post("email"), true);

                    $subject = "Password change - Istanbull Youth Summit";
                    $message = "Hi, password for Istanbull Youth Summit account with email <b>{$email}</b> has been changed at {$now}. <br> If you feel you did not make these changes, please contact our admin immediately.";

                    // mengirimemailperubahan password
                    sendMail(htmlspecialchars($this->input->post("email"), true), $subject, $message);

                    // menghapus session
                    $this->session->set_flashdata('success', 'Successfully changed your account password, please sign in with your new password');
                    redirect(site_url('sign-in'));
                } else {
                    $this->session->set_flashdata('notif_error', 'There is something wrong. when try to change your password, try again later');
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('notif_warning', 'Confirm password is not the same');
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('error', 'Email unknown, contact admin if this still happens.');
            redirect($this->agent->referrer());
        }
    }

    // LOGOUT
    public function logout()
    {
        $this->M_auth->makeOffline($this->session->userdata('user_id'));
        // SESS DESTROY

        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function offline()
    {
        $this->M_auth->makeOffline($this->session->userdata('user_id'));
        // SESS DESTROY

        $this->session->sess_destroy();
        return true;
    }


    // FUNCTION PRIVATE
    // MAILER SENDER
    function send_email($email, $subject, $message)
    {

        $mail = [
            'to' => $email,
            'subject' => $subject,
            'message' => $message
        ];

        if ($this->mailer->send($mail) == true) {
            return true;
        } else {
            return false;
        }
    }

    // MAILER SENDER Attach
    function send_emailAttach($email, $subject, $message, $dir, $file)
    {

        $mail = [
            'to' => $email,
            'subject' => $subject,
            'message' => $message,
            'dir' => $dir,
            'file' => $file
        ];

        if ($this->mailer->sendAttach($mail) == true) {
            return true;
        } else {
            return false;
        }
    }

    function penalty_remaining($datetime, $full = false)
    {
        // $datetime = date(" Y - m - d H : i : s ", time()+120);
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'i' => 'Menit ',
            's' => 'Detik ',
        ];
        $a = null;
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
                $a .= $v;
            } else {
                unset($string[$k]);
            }
        }
        return $a;
    }
}
