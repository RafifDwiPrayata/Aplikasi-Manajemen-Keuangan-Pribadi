<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['result'] = $this->ion_auth->users()->result();
        $this->load->view("api/users/users", $data);
    }

    public function users_tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('level_users', 'Level Pengguna', 'required');

        if ($this->form_validation->run() === TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');

            $additional_data = array(
                'username' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'level_users' => $this->input->post('level_users'),
                'ip_address' => '127.0.0.1',
                'active' => $this->input->post('active') ? 1 : 0
            );

            $group = array($this->input->post('level_users'));

            $user_id = $this->ion_auth->create_user($username, $password, $email, $additional_data, $group);

            if ($user_id == TRUE) {
                $this->session->set_flashdata('action_status', '<div class="alert alert-success">User Berhasil ditambahkan</div>');
                redirect('users');
            }
        } else {
            $this->load->view("api/users/users_tambah");
        }
    }
}
