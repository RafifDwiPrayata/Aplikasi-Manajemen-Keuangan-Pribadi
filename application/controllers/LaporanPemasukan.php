<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPemasukan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        // Ambil parameter filter
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun') ?: date('Y');
        $id_kategori = $this->input->get('kategori');
        
        // Base query
        $where = array();
        $params = array();
        
        // Filter bulan jika ada
        if ($bulan) {
            $where[] = "DATE_FORMAT(tanggal, '%m') = ?";
            $params[] = sprintf("%02d", $bulan);
        }
        
        // Filter tahun
        $where[] = "DATE_FORMAT(tanggal, '%Y') = ?";
        $params[] = $tahun;
        
        // Filter kategori jika ada
        if ($id_kategori) {
            $where[] = "p.id_kategori = ?";
            $params[] = $id_kategori;
        }
        
        // Gabungkan where clause
        $where_clause = $where ? "WHERE " . implode(" AND ", $where) : "";
        
        // Query untuk mendapatkan ringkasan pemasukan per bulan
        $query = $this->db->query("
            SELECT 
                DATE_FORMAT(tanggal, '%Y-%m') as bulan,
                COUNT(*) as jumlah_transaksi,
                SUM(jumlah) as total_pemasukan,
                GROUP_CONCAT(DISTINCT k.nama_kategori SEPARATOR ', ') as kategori
            FROM 
                pemasukan p
                LEFT JOIN kategori k ON p.id_kategori = k.id
            $where_clause
            GROUP BY 
                DATE_FORMAT(tanggal, '%Y-%m')
            ORDER BY 
                bulan DESC
        ", $params);
        
        $data['laporan'] = $query->result();
        
        // Ambil daftar kategori untuk dropdown
        $query_kategori = $this->db->query("
            SELECT * FROM kategori 
            WHERE tipe_kategori = 'pemasukan'
            ORDER BY nama_kategori ASC
        ");
        $data['kategori'] = $query_kategori->result();
        
        // Data untuk filter
        $data['bulan_terpilih'] = $bulan;
        $data['tahun_terpilih'] = $tahun;
        $data['kategori_terpilih'] = $id_kategori;
        
        // Array nama bulan
        $data['daftar_bulan'] = array(
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
        );
        
        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view('laporan/pemasukan', $data);
        $this->load->view('inc/footer');
    }
}