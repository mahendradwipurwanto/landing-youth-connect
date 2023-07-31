<?php

class TemplateAmbassador
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

    public function view($content, $data = null)
    {
        $web_data = $this->getWebSettingsValue();

        $data['web_title'] = $web_data->title;
        $data['web_desc'] = $web_data->description;
        $data['web_icon'] = $web_data->icon;
        $data['web_logo'] = $web_data->logo;
        $data['web_logo_white'] = $web_data->logo;
        $data['web_alamat'] = $web_data->address;
        $data['web_telepon'] = $web_data->phone;
        $data['web_email'] = $web_data->email;
        $data['web_guidelines'] = '';
        $data['submission_deadline'] = '';

        $data['sosmed_ig'] = $web_data->instagram;
        $data['sosmed_twitter'] = $web_data->twitter;
        $data['sosmed_facebook'] = $web_data->facebook;
        $data['sosmed_yt'] = $web_data->youtube;

        $this->_ci->load->view('template/ambassador/header', $data);
        $this->_ci->load->view('template/alert', $data);
        $this->_ci->load->view('template/ambassador/navbar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('template/ambassador/footer', $data);
    }
}
