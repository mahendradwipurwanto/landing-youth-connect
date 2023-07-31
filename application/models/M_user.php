<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function changePassword($password)
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('access_auth', ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function getAllCountries()
    {
        return $this->db->get_where('m_countries')->result();
    }

    function getUserParticipans($user_id)
    {
        $this->db->select('a.*, b.*, c.email, e.en_short_name')
            ->from('tb_participants a')
            ->join('access_user b', 'a.user_id = b.user_id')
            ->join('access_auth c', 'a.user_id = c.user_id')
            // ->join('tb_ambassador d', 'a.referral_code = d.referral_code', 'left')
            ->join('m_countries e', 'a.nationality = e.num_code', 'left')
            ->where(['c.status' => 1, 'a.user_id' => $user_id]);

        $models = $this->db->get()->row();
        $user   = $this->get_userByID($user_id);
        if (!is_null($models)) {
            // if($models->referral_code == 0 && $user != false){
            //     $models->referral_code = $user->referral_code;
            //     if(($this->getAmbasadorByReferral($models->referral_code))){
            //         $models->fullname = $this->getAmbasadorByReferral($models->referral_code)->fullname;
            //     }else{
            //         $models->fullname = "unknow";
            //     }
            // }
            $models->fullname = "unknow";
        }

        return $models;
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

    function getAmbasadorByReferral($referral_code = null)
    {
        return $this->db->get_where('tb_ambassador', ['referral_code' => $referral_code, 'status' => 1, 'deleted_at' => null])->row();
    }

    function getUserParticipansEssay($user_id, $participant_id)
    {
        $this->db->select('a.*, b.*, c.*')
            ->from('tb_participants_essay a')
            ->join('tb_participants b', 'a.participant_id = b.id')
            ->join('access_user c', 'b.user_id = c.user_id')
            ->join('access_auth d', 'b.user_id = d.user_id')
            ->where(['a.deleted_at' => null, 'a.participant_id' => $participant_id, 'b.user_id' => $user_id]);

        $models = $this->db->get()->result();

        $arr = [];
        foreach ($models as $key => $val) {
            $arr[$val->m_essay_id] = $val;
        }

        return $arr;
    }

    function formStepBasic()
    {

        if ($this->input->post('is_custom_nationality') == -1) {
            $nationality_custom = $this->input->post('nationality_custom');
            $nationality = -1;
        } else {
            $nationality_custom = null;
            $nationality = $this->input->post('nationality');
        }

        $formData = [
            'user_id'               => $this->session->userdata('user_id'),
            'birthdate'             => strtotime($this->input->post('birthdate')),
            'nationality'           => $nationality,
            'nationality_custom'    => $nationality_custom,
            'occupation'            => $this->input->post('occupation'),
            'field_of_study'        => $this->input->post('fieldofstudy'),
            'institution_workplace' => $this->input->post('institution'),
            'whatsapp'       => $this->input->post('whatsAppNumber'),
            'instagram'             => $this->input->post('instagram'),
            'emergency_contact'     => $this->input->post('emergency'),
            'contact_relation'      => $this->input->post('contactRelation'),
            'disease_history'       => $this->input->post('disease'),
            'tshirt_size'           => $this->input->post('tshirt'),
            'address'               => $this->input->post('address'),
            'postal_code'           => $this->input->post('postal_code'),
            'city'                  => $this->input->post('city'),
            'province'              => $this->input->post('province'),
            // 'created_by'            => $this->session->userdata('user_id'),
            'created_at'            => time(),
        ];

        $participans = $this->getUserParticipans($this->session->userdata('user_id'));

        $userData = [
            'name'                  => $this->input->post('fullname'),
            'gender'                => $this->input->post('gender')
        ];

        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('access_user', $userData);

        if (empty($participans)) {
            $this->db->insert('tb_participants', $formData);
        } else {
            $this->db->where('id', $participans->id);
            $this->db->update('tb_participants', $formData);
        }

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function formStepOthers()
    {

        $participans = $this->getUserParticipans($this->session->userdata('user_id'));

        $formData = [
            'user_id'               => $this->session->userdata('user_id'),
            'submission_step '                 => $participans->submission_step <= 2 ? 2 : $participans->step,
            'achievements'          => $this->input->post('achievements'),
            'experience'            => $this->input->post('experience'),
            'social_projects'       => $this->input->post('socialProjects'),
            'talents'               => $this->input->post('talents'),
            // 'modified_by'           => $this->session->userdata('user_id'),
            'updated_at'           => time(),
        ];

        if (empty($participans)) {
            $this->db->insert('tb_participants', $formData);
        } else {
            $this->db->where('id', $participans->id);
            $this->db->update('tb_participants', $formData);
        }

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function formStepEssays($m_essay = [])
    {

        $participans    = $this->getUserParticipans($this->session->userdata('user_id'));
        $essay          = $this->getUserParticipansEssay($this->session->userdata('user_id'), $participans->id);

        $this->db->where('id', $participans->id);
        $this->db->update('tb_participants', ['submission_step ' => $participans->submission_step <= 3 ? 3 : $participans->step]);

        if (empty($participans)) {
            if (empty($essay)) {
                if (!empty($m_essay)) {
                    foreach ($m_essay as $key => $val) {
                        $formData = [
                            'participant_id' => $participans->id,
                            'm_essay_id' => $val->id,
                            'm_question' => $val->question,
                            'answer' => $this->input->post('essay')[$val->id][0],
                        ];
                        $this->db->insert('tb_participants_essay', $formData);
                    }
                }
            } else {
                if (!empty($m_essay)) {
                    foreach ($essay as $k => $v) {
                        foreach ($m_essay as $key => $val) {
                            if ($this->input->post('essay')[$v->m_essay_id]) {
                                $formData = [
                                    'participant_id' => $participans->id,
                                    'm_essay_id' => $v->m_essay_id,
                                    'm_question' => $val->question,
                                    'answer' => $this->input->post('essay')[$v->m_essay_id][0],
                                ];
                                $this->db->where('id', $v->id);
                                $this->db->update('tb_participants_essay', $formData);
                            } else {
                                $formData = [
                                    'participant_id' => $participans->id,
                                    'm_essay_id' => $val->id,
                                    'm_question' => $val->question,
                                    'answer' => $this->input->post('essay')[$val->id][0],
                                ];
                                $this->db->insert('tb_participants_essay', $formData);
                            }
                        }
                    }
                }
            }
        } else {
            if (empty($essay)) {
                if (!empty($m_essay)) {
                    foreach ($m_essay as $key => $val) {
                        $formData = [
                            'participant_id' => $participans->id,
                            'm_essay_id' => $val->id,
                            'm_question' => $val->question,
                            'answer' => $this->input->post('essay')[$val->id][0],
                        ];
                        $this->db->insert('tb_participants_essay', $formData);
                    }
                }
            } else {
                if (!empty($m_essay)) {
                    foreach ($essay as $k => $v) {
                        foreach ($m_essay as $key => $val) {
                            if (isset($this->input->post('essay')[$v->m_essay_id])) {
                                $formData = [
                                    'participant_id' => $participans->id,
                                    'm_essay_id' => $v->m_essay_id,
                                    'm_question' => $val->question,
                                    'answer' => $this->input->post('essay')[$v->m_essay_id][0],
                                ];
                                $this->db->where('id', $v->id);
                                $this->db->update('tb_participants_essay', $formData);
                            } else {
                                $formData = [
                                    'participant_id' => $participans->id,
                                    'm_essay_id' => $val->id,
                                    'm_question' => $val->question,
                                    'answer' => $this->input->post('essay')[$val->id][0],
                                ];
                                $this->db->insert('tb_participants_essay', $formData);
                            }
                        }
                    }
                }
            }
        }

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function formStepProgram()
    {
        $participans = $this->getUserParticipans($this->session->userdata('user_id'));

        $formData = [
            'submission_step '                 => $participans->submission_step <= 4 ? 4 : $participans->step,
            'source'                => $this->input->post('source'),
            'source'                => $this->input->post('sourceAccount'),
            'twibbon_link'          => $this->input->post('twibbon_link'),
            'share_proof_link'      => $this->input->post('shareRequirement'),
            // 'modified_by'           => $this->session->userdata('user_id'),
            'updated_at'           => time(),
        ];

        if (empty($participans)) {
            $this->db->insert('tb_participants', $formData);
        } else {
            $this->db->where('id', $participans->id);
            $this->db->update('tb_participants', $formData);
        }

        // $this->db->where('user_id', $this->session->userdata('user_id'));
        // $this->db->update('access_auth', ['referral_code' => $this->input->post('referral')]);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function formStepSelf($photo = null)
    {
        $participans = $this->getUserParticipans($this->session->userdata('user_id'));

        if (!is_null($photo)) {
            $formData = [
                'submission_step '                 => $participans->submission_step <= 5 ? 5 : $participans->step,
                'self_photo'            => $photo,
                // 'modified_by'           => $this->session->userdata('user_id'),
                'updated_at'           => time(),
            ];

            if (empty($participans)) {
                $this->db->insert('tb_participants', $formData);
            } else {
                $this->db->where('id', $participans->id);
                $this->db->update('tb_participants', $formData);
            }

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {
            return true;
        }
    }

    function ajxPostSubmission()
    {
        $participans = $this->getUserParticipans($this->session->userdata('user_id'));

        $formData = [
            'submission_step '                 => $participans->submission_step <= 6 ? 6 : $participans->step,
            'terms_condition'       => 1,
            'status'                => 2,
            // 'modified_by'           => $this->session->userdata('user_id'),
            'updated_at'           => time(),
        ];

        if (empty($participans)) {
            $this->db->insert('tb_participants', $formData);
        } else {
            $this->db->where('id', $participans->id);
            $this->db->update('tb_participants', $formData);
        }

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function uploadDocuments($file = null)
    {
        $documents = $this->db->get_where('tb_participants_documents', ['user_id' => $this->session->userdata('user_id'), 'm_document_id' => $this->input->post('m_document_id')])->row();

        $data = [
            'user_id'           => $this->session->userdata('user_id'),
            'm_document_id'     => $this->input->post('m_document_id'),
            'file'              => $file,
        ];
        if (empty($documents)) {
            $log = [
                'created_at'        => time(),
                // 'created_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->insert('tb_participants_documents', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {
            $log = [
                'status'             => 1,
                'updated_at'        => time(),
                // 'modified_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->where('id', $documents->id);
            $this->db->update('tb_participants_documents', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

    function getUserDocuments()
    {
        $this->db->select('*')
            ->from('m_programs_document')
            ->where(['deleted_at' => null]);

        $models = $this->db->get()->result();

        foreach ($models as $key => $val) {

            $documents = $this->db->get_where('tb_participants_documents', ['user_id' => $this->session->userdata('user_id'), 'm_document_id' => $val->id])->row();

            if (!empty($documents)) {
                $val->status    = (int) $documents->status;
                $val->file      = $documents->file;
            } else {
                $val->status    = 0;
                $val->file      = null;
            }
        }

        return $models;
    }

    function getUserDocumentPassport($user_id = null)
    {
        return $this->db->get_where('travel_passport', ['user_id' => $user_id])->row();
    }

    function getUserDocumentFlight($user_id = null)
    {
        return $this->db->get_where('travel_flight', ['user_id' => $user_id])->row();
    }

    function getUserDocumentResidance($user_id = null)
    {
        return $this->db->get_where('travel_residance', ['user_id' => $user_id])->row();
    }

    function getUserDocumentVaccine($user_id = null)
    {
        return $this->db->get_where('travel_vaccine', ['user_id' => $user_id])->row();
    }

    function getUserDocumentVisa($user_id = null)
    {
        return $this->db->get_where('travel_visa', ['user_id' => $user_id])->row();
    }

    function getUserDocumentLoa($user_id = null)
    {
        return $this->db->get_where('access_user_documents', ['user_id' => $user_id, 'm_document_id' => 4])->row();
    }
}
