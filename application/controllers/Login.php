<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view("auth_kevin/login");
    }

    public function register()
    {
        if ($this->input->method() === 'post') {
            // Ambil data dari form
            $data = [
                'username' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'active' => 1,
                'created_on' => date('Y-m-d H:i:s')
            ];

            // Validasi data
            if (empty($data['username']) || empty($data['email']) || empty($this->input->post('password'))) {
                $this->session->set_flashdata('error', 'Semua field wajib diisi');
                redirect('login/register');
                return;
            }

            // Cek apakah username sudah ada
            $existing_user = $this->db->get_where('users', ['username' => $data['username']])->row();
            if ($existing_user) {
                $this->session->set_flashdata('error', 'Username sudah digunakan');
                redirect('login/register');
                return;
            }

            // Cek apakah email sudah ada
            $existing_email = $this->db->get_where('users', ['email' => $data['email']])->row();
            if ($existing_email) {
                $this->session->set_flashdata('error', 'Email sudah digunakan');
                redirect('login/register');
                return;
            }

            // Simpan ke database
            $this->db->insert('users', $data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login untuk mengakses aplikasi BukuSaldo 🔥.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mendaftar');
                redirect('login/register');
            }
        } else {
            $this->load->view("auth_kevin/register");
        }
    }
}
