<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function index()
    {
        $this->db->select('menu.*, kategori_makanan.kategori_nama');
        $this->db->from('menu');
        $this->db->join('kategori_makanan', 'menu.kategori_nama = kategori_makanan.kategori_nama', 'left');
        $data['result'] = $this->db->get()->result();

        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view('menu/menu', $data);
        $this->load->view('inc/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('menu_nama', 'Nama Menu', 'required');
        $this->form_validation->set_rules('kategori_nama', 'Kategori Nama', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Ambil data kategori untuk dropdown
            $data['kategori'] = $this->db->get('kategori_makanan')->result();

            $this->load->view('inc/header');
            $this->load->view('inc/sidebar');
            $this->load->view('menu/menu_tambah', $data);
            $this->load->view('inc/footer');
        } else {
            $insert_array = array(
                'nama_menu' => $this->input->post('menu_nama'),
                'kategori_nama' => $this->input->post('kategori_nama')
            );

            if ($this->db->insert('menu', $insert_array)) {
                $this->session->set_flashdata('action_status', '<div class="alert alert-success">Berhasil menambah menu</div>');
                redirect('menu/index');
            } else {
                $this->session->set_flashdata('action_status', '<div class="alert alert-danger">Gagal menambah menu</div>');
                redirect('menu/tambah');
            }
        }
    }

    public function edit($id)
    {
        $query = $this->db->get_where('menu', array('id' => $id));
        if ($query->num_rows() == 1) {
            $data['row'] = $query->row();
            // Ambil data kategori untuk dropdown
            $data['kategori'] = $this->db->get('kategori_makanan')->result();

            $this->load->view('inc/header');
            $this->load->view('inc/sidebar');
            $this->load->view('menu/menu_edit', $data);
            $this->load->view('inc/footer');
        } else {
            $this->session->set_flashdata('action_status', '<div class="alert alert-danger">ID menu tidak ditemukan</div>');
            redirect('menu/index');
        }
    }

    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('menu_nama', 'Nama Menu', 'required');
        $this->form_validation->set_rules('kategori_nama', 'Kategori Nama', 'required');

        $update_array = array(
            'nama_menu' => $this->input->post('menu_nama'),
            'kategori_nama' => $this->input->post('kategori_nama')
        );

        $this->db->where('id', $id);
        if ($this->db->update('menu', $update_array)) {
            $this->session->set_flashdata('action_status', '<div class="alert alert-success">Berhasil mengubah menu</div>');
            redirect('menu/index');
        } else {
            $this->session->set_flashdata('action_status', '<div class="alert alert-danger">Gagal mengubah menu</div>');
            redirect('menu/edit/' . $id);
        }
    }

    public function hapus($id)
    {
        $query = $this->db->get_where('menu', array('id' => $id));
        if ($query->num_rows() == 1) {
            $this->db->where('id', $id)->delete('menu');
            $this->session->set_flashdata('action_status', '<div class="alert alert-success">Berhasil menghapus kategori menu</div>');
            redirect('menu/index');
        } else {
            $this->session->set_flashdata('action_status', '<div class="alert alert-danger">ID menu tidak ditemukan</div>');
            redirect('menu/index');
        }
    }
}

