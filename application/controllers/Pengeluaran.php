<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function index()
    {
        // Get filter parameters
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $kategori = $this->input->get('kategori');
        
        // Base query
        $sql = "SELECT p.*, k.nama_kategori 
                FROM pengeluaran p 
                LEFT JOIN kategori k ON p.id_kategori = k.id";
        
        // Add filter conditions
        $where = [];
        $params = [];
        
        if (!empty($bulan)) {
            $where[] = "MONTH(p.tanggal) = ?";
            $params[] = $bulan;
        }
        
        if (!empty($tahun)) {
            $where[] = "YEAR(p.tanggal) = ?";
            $params[] = $tahun;
        }
        
        if (!empty($kategori)) {
            $where[] = "p.id_kategori = ?";
            $params[] = $kategori;
        }
        
        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }
        
        $sql .= " ORDER BY p.id DESC";
        
        $query = $this->db->query($sql, $params);
        $data['pengeluaran'] = $query->result();
        
        // Prepare month list for dropdown
        $data['daftar_bulan'] = [
            '' => '-- Semua Bulan --',
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        
        // Get categories for dropdown
        $query_kategori = $this->db->query("SELECT * FROM kategori WHERE tipe_kategori = 'pengeluaran' ORDER BY nama_kategori ASC");
        $data['kategori'] = $query_kategori->result();
        
        // Pass selected values to view
        $data['bulan_terpilih'] = $bulan;
        $data['tahun_terpilih'] = $tahun;
        $data['kategori_terpilih'] = $kategori;
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view("transaksi/pengeluaran/pengeluaran", $data);
        $this->load->view('inc/footer');
    }

    public function tambah()
    {   
        // Ambil daftar kategori pengeluaran
        $query = $this->db->query("SELECT * FROM kategori WHERE tipe_kategori = 'pengeluaran' ORDER BY nama_kategori ASC");
        $data['kategori'] = $query->result();
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view("transaksi/pengeluaran/tambah", $data);
        $this->load->view('inc/footer');
    }

    public function simpan()
    {
        $tanggal = $this->input->post('tanggal');
        $id_kategori = $this->input->post('id_kategori');
        $keterangan = $this->input->post('keterangan');
        $jumlah = $this->input->post('jumlah');
        
        if($tanggal && $id_kategori && $jumlah) {
            $query = $this->db->query("
                INSERT INTO pengeluaran (tanggal, id_kategori, keterangan, jumlah) 
                VALUES (?, ?, ?, ?)", 
                array($tanggal, $id_kategori, $keterangan, $jumlah)
            );
            
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data');
            }
        } else {
            $this->session->set_flashdata('error', 'Semua field harus diisi');
        }
        
        redirect('pengeluaran');
    }

    public function edit($id)
    {
        // Ambil daftar kategori pengeluaran
        $query_kategori = $this->db->query("SELECT * FROM kategori WHERE tipe_kategori = 'pengeluaran' ORDER BY nama_kategori ASC");
        $data['kategori'] = $query_kategori->result();
        
        // Ambil data pengeluaran
        $query_pengeluaran = $this->db->query("SELECT * FROM pengeluaran WHERE id = ?", array($id));
        $data['pengeluaran'] = $query_pengeluaran->row();
        
        if(!$data['pengeluaran']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('pengeluaran');
        }
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view("transaksi/pengeluaran/edit", $data);
        $this->load->view('inc/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $id_kategori = $this->input->post('id_kategori');
        $keterangan = $this->input->post('keterangan');
        $jumlah = $this->input->post('jumlah');
        
        if($id && $tanggal && $id_kategori && $jumlah) {
            $query = $this->db->query("
                UPDATE pengeluaran 
                SET tanggal = ?, 
                    id_kategori = ?, 
                    keterangan = ?, 
                    jumlah = ? 
                WHERE id = ?", 
                array($tanggal, $id_kategori, $keterangan, $jumlah, $id)
            );
            
            if($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal update data');
            }
        } else {
            $this->session->set_flashdata('error', 'Semua field harus diisi');
        }
        
        redirect('pengeluaran');
    }

    public function hapus($id)
    {
        $query = $this->db->query("DELETE FROM pengeluaran WHERE id = ?", array($id));
        
        if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data');
        }
        redirect('pengeluaran');
    }
}