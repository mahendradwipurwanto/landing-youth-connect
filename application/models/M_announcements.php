<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_announcements extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPublicAnnouncements(){
        $this->db->select('*');
        $this->db->from('tb_announcements');
        $this->db->where(['is_public' => 1, 'is_deleted' => 0]);
        return $this->db->get()->result();
    }

    public function getParticipansAnnouncements(){
        $this->db->select('*');
        $this->db->from('tb_announcements');
        $this->db->where(['is_member' => 1, 'is_deleted' => 0]);
        return $this->db->get()->result();
    }

    public function getAnnouncementlist(){
        $this->db->select('*');
        $this->db->from('tb_announcements');
        $this->db->where(['is_deleted' => 0]);
        $models = $this->db->get()->result();

        $arr = [];
        if (!empty($models)) {
            foreach($models as $key => $val){
                $arr[$key] = $val;
                $val->content = str_replace('&lt;', '<', $val->content);
                $val->content = str_replace('&quot;', '"', $val->content);
                $val->content = str_replace('&gt;', '>', $val->content);
                $arr[$key]->content = $val->content;
            }
        }

        return $arr;
    }

    public function getDetailAnnouncement($id){
        $this->db->select('*');
        $this->db->from('tb_announcements');
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
            'title' => $subject,
            'content' => $content,
            'poster' => $poster,
            'permalink' => createPermalink($subject),
            'is_public' => $is_public,
            'is_member' => $is_member,
            'created_by' => $this->session->userdata('user_id'),
            'created_at' => time()
        ];

        $this->db->insert('tb_announcements', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function editAnnouncement($poster = null)
    {
        $id = $this->input->post('id');
        $subject = $this->input->post('subject');
        $content = $this->input->post('content');
        $is_public = $this->input->post('is_public');
        $is_member = $this->input->post('is_member');

        if($poster == null){
            $data = [
                'title' => $subject,
                'content' => $content,
                'is_public' => $is_public,
                'is_member' => $is_member,
                'modified_by' => $this->session->userdata('user_id'),
                'modified_at' => time()
            ];
        }else{
            $data = [
                'title' => $subject,
                'content' => $content,
                'poster' => $poster,
                'is_public' => $is_public,
                'is_member' => $is_member,
                'modified_by' => $this->session->userdata('user_id'),
                'modified_at' => time()
            ];
        }

        $this->db->where('id', $id);
        $this->db->update('tb_announcements', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteAnnouncement()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_announcements', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

}
