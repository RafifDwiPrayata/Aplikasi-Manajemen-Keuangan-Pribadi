<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function index()
    {
        $query = $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC");
        $data['kategori'] = $query->result();
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view("kategori/kategori", $data);
        $this->load->view('inc/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $nama = $this->input->post('nama_kategori');
            $tipe = $this->input->post('tipe_kategori');
            
            $query = $this->db->query("INSERT INTO kategori (nama_kategori, tipe_kategori) VALUES (?, ?)", 
                array($nama, $tipe));
                
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data');
            }
            redirect('kategori');
        }
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view("kategori/form_kategori");
        $this->load->view('inc/footer');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $nama = $this->input->post('nama_kategori');
            $tipe = $this->input->post('tipe_kategori');
            
            $query = $this->db->query("UPDATE kategori SET nama_kategori = ?, tipe_kategori = ? WHERE id = ?", 
                array($nama, $tipe, $id));
                
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal update data');
            }
            redirect('kategori');
        }
        
        $query = $this->db->query("SELECT * FROM kategori WHERE id = ?", array($id));
        $data['kategori'] = $query->row();
        
        if(!$data['kategori']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('kategori');
        }
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view("kategori/form_kategori", $data);
        $this->load->view('inc/footer');
    }

    public function hapus($id)
    {
        // Langsung hapus data kategori
        $query = $this->db->query("DELETE FROM kategori WHERE id = ?", array($id));
        
        if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data');
        }
        redirect('kategori');
    }
}