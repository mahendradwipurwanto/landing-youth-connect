<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_announcements extends CI_Model
{
    protected $_program_id = 1;

    public function __construct()
    {
        parent::__construct();
    }

    public function getPublicAnnouncements()
    {
        $this->db->select('*');
        $this->db->from('m_programs_announcements');
        $this->db->where(['is_public' => 1, 'deleted_at' => null, 'program_id' => $this->_program_id]);
        return $this->db->get()->result();
    }

    public function getParticipansAnnouncements()
    {
        $this->db->select('*');
        $this->db->from('m_programs_announcements');
        $this->db->where(['is_member' => 1, 'deleted_at' => null, 'program_id' => $this->_program_id]);
        return $this->db->get()->result();
    }

    public function getAnnouncementlist()
    {
        $this->db->select('*');
        $this->db->from('m_programs_announcements');
        $this->db->where(['deleted_at' => null, 'program_id' => $this->_program_id]);
        $models = $this->db->get()->result();

        $arr = [];
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $arr[$key] = $val;
                $val->content = str_replace('&lt;', '<', $val->content);
                $val->content = str_replace('&quot;', '"', $val->content);
                $val->content = str_replace('&gt;', '>', $val->content);
                $arr[$key]->content = $val->content;
            }
        }

        return $arr;
    }

    public function getDetailAnnouncement($id)
    {
        $this->db->select('*');
        $this->db->from('m_programs_announcements');
        $this->db->where('id', $id);
        $this->db->or_where('permalink', $id);
        $model = $this->db->get()->row();

        if (!is_null($model)) {
            $model->content = str_replace('&lt;', '<', $model->content);
            $model->content = str_replace('&quot;', '"', $model->content);
            $model->content = str_replace('&gt;', '>', $model->content);
        }

        return $model;
    }

    public function addAnnouncement($poster = null)
    {
        $subject = $this->input->post('subject');
        $content = $this->input->post('content');
        $is_public = $this->input->post('is_public');
        $is_member = $this->input->post('is_member');

        $data = [
            'program_id' => 1,
            'title' => $subject,
            'content' => $content,
            'poster' => $poster,
            'permalink' => createPermalink($subject),
            'is_public' => $is_public,
            'is_member' => $is_member,
            // 'created_by' => $this->session->userdata('user_id'),
            'created_at' => time()
        ];

        $this->db->insert('m_programs_announcements', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editAnnouncement($poster = null)
    {
        $id = $this->input->post('id');
        $subject = $this->input->post('subject');
        $content = $this->input->post('content');
        $is_public = $this->input->post('is_public');
        $is_member = $this->input->post('is_member');

        if ($poster == null) {
            $data = [
                'program_id' => 1,
                'title' => $subject,
                'content' => $content,
                'is_public' => $is_public,
                'is_member' => $is_member,
                // 'modified_by' => $this->session->userdata('user_id'),
                'updated_at' => time()
            ];
        } else {
            $data = [
                'program_id' => 1,
                'title' => $subject,
                'content' => $content,
                'poster' => $poster,
                'is_public' => $is_public,
                'is_member' => $is_member,
                // 'modified_by' => $this->session->userdata('user_id'),
                'updated_at' => time()
            ];
        }

        $this->db->where('id', $id);
        $this->db->update('m_programs_announcements', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteAnnouncement()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('m_programs_announcements', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
