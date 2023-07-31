<?php
class TemplateUser
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    public function getWebSettingsValue()
    {
        $query = $this->_ci->db->get_where('m_programs', ['id' => 1]);
        return $query->row();
    }

    public function getSettingsValue($key)
    {
        $query = $this->_ci->db->get_where('m_settings', ['key' => $key]);
        return $query->row()->value;
    }

    public function countAnnouncements()
    {
        $query = $this->_ci->db->get_where('m_programs_announcements', ['is_member' => 1 , 'deleted_at' => null]);
        return $query->num_rows();
    }

    public function countDocuments()
    {
        $query = $this->_ci->db->get_where('m_programs_document', ['deleted_at' => null]);
        return $query->num_rows();
    }

    function getUserParticipans($user_id){
        $this->_ci->db->select('a.*, b.*, c.*')
        ->from('tb_participants a')
        ->join('access_user b', 'a.user_id = b.user_id')
        ->join('access_auth c', 'a.user_id = c.user_id')
        // ->join('tb_ambassador d', 'a.referral_code = d.referral_code', 'left')
        ->where(['a.deleted_at' => null, 'c.status' => 1, 'a.user_id' => $user_id])
        ;

        $models = $this->_ci->db->get()->row();

        return $models;
    }

    public function view($content, $data = null)
    {
        $web_data = $this->getWebSettingsValue();

        $data['web_title'] = $web_data->title;
        $data['web_desc'] = $web_data->description;
        $data['web_icon'] = $web_data->icon;
        $data['web_logo'] = $web_data->logo;
        $data['web_logo_white'] = $web_data->logo_white;
        $data['web_alamat'] = $web_data->address;
        $data['web_telepon'] = $web_data->phone;
        $data['web_email'] = $web_data->email;
        $data['web_guidelines'] = '';
        $data['submission_deadline'] = '';

        $data['countAnnouncements'] = $this->countAnnouncements();
        $data['countDocuments'] = $this->countDocuments();

        $data['sosmed_ig'] = $web_data->instagram;
        $data['sosmed_twitter'] = $web_data->twitter;
        $data['sosmed_facebook'] = $web_data->facebook;
        $data['sosmed_yt'] = $web_data->youtube;

        $data['user_profil']   = $this->getUserParticipans($this->_ci->session->userdata('user_id'));

        $this->_ci->load->view('template/user/header', $data);
        $this->_ci->load->view('template/alert', $data);
        $this->_ci->load->view('template/user/navbar', $data);
        $this->_ci->load->view('template/user/sidebar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('template/user/footer', $data);
    }
}
