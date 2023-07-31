<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_travel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserPassport($user_id = null){
        return $this->db->get_where('travel_passport', ['user_id' => $user_id])->row();
    }

    public function getUserFlight($user_id = null){
        return $this->db->get_where('travel_flight', ['user_id' => $user_id])->row();
    }

    public function getUserResidance($user_id = null){
        return $this->db->get_where('travel_residance', ['user_id' => $user_id])->row();
    }

    public function getUserVisa($user_id = null){
        return $this->db->get_where('travel_visa', ['user_id' => $user_id])->row();
    }

    public function getUserVaccine($user_id = null){
        return $this->db->get_where('travel_vaccine', ['user_id' => $user_id])->row();
    }

    public function savePassport($file = null){

        $data = [
            'user_id'           => $this->session->userdata('user_id'),
            'passport_number'   => $this->input->post('passport_number'),
            'fullname'          => $this->input->post('fullname'),
            'file'              => $file,
        ];
        
        if (is_null($this->input->post('id')) || $this->input->post('id') == '') {

            $log = [
                'created_at'        => time(),
                'created_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->insert('travel_passport', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {

            $log = [
                'modified_at'        => time(),
                'modified_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('travel_passport', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

    public function saveFlight(){

        $data = [
            'user_id'              => $this->session->userdata('user_id'),
            'departure_airport'    => $this->input->post('departure_airport'),
            'departure_date'       => $this->input->post('departure_date'),
            'departure_time'       => $this->input->post('departure_time'),
            'departure_airline'    => $this->input->post('departure_airline'),
            'departure_flightcode' => $this->input->post('departure_flightcode'),
            'return_airport'       => $this->input->post('return_airport'),
            'return_date'          => $this->input->post('return_date'),
            'return_time'          => $this->input->post('return_time'),
            'return_airline'       => $this->input->post('return_airline'),
            'return_flightcode'    => $this->input->post('return_flightcode')
        ];
        
        if (is_null($this->input->post('id')) || $this->input->post('id') == '') {

            $log = [
                'created_at'        => time(),
                'created_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->insert('travel_flight', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {

            $log = [
                'modified_at'        => time(),
                'modified_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('travel_flight', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

    public function saveResidance(){

        $data = [
            'user_id'               => $this->session->userdata('user_id'),
            'type'                  => $this->input->post('type'),
            'address'               => $this->input->post('address'),
        ];
        
        if (is_null($this->input->post('id')) || $this->input->post('id') == '') {

            $log = [
                'created_at'        => time(),
                'created_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->insert('travel_residance', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {

            $log = [
                'modified_at'        => time(),
                'modified_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('travel_residance', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

    public function saveVisa($file = null){
        $data = [
            'user_id'           => $this->session->userdata('user_id'),
            'file'              => $file,
        ];
        
        if (is_null($this->input->post('id')) || $this->input->post('id') == '') {

            $log = [
                'created_at'        => time(),
                'created_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->insert('travel_visa', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {

            $log = [
                'modified_at'        => time(),
                'modified_by'        => $this->session->userdata('user_id'),
            ];


            $this->db->where('id', $this->input->post('id'));
            $this->db->update('travel_visa', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

    public function saveVaccine($file = null){

        $data = [
            'user_id'           => $this->session->userdata('user_id'),
            'file'              => $file,
        ];
        
        if (is_null($this->input->post('id')) || $this->input->post('id') == '') {

            $log = [
                'created_at'        => time(),
                'created_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->insert('travel_vaccine', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {

            $log = [
                'modified_at'        => time(),
                'modified_by'        => $this->session->userdata('user_id'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('travel_vaccine', array_merge($data, $log));

            return ($this->db->affected_rows() != 1) ? false : true;
        }
    }

}
