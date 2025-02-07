<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Ci_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if ($this->ion_auth->logged_in() == FALSE) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        // Ambil data untuk bulan ini
        $bulan_ini = date('Y-m');
        
        // Hitung total pemasukan bulan ini
        $query_pemasukan = $this->db->query("
            SELECT COALESCE(SUM(jumlah), 0) as total
            FROM pemasukan 
            WHERE DATE_FORMAT(tanggal, '%Y-%m') = ?
        ", array($bulan_ini));
        $data['total_pemasukan'] = $query_pemasukan->row()->total;

        // Hitung total pengeluaran bulan ini
        $query_pengeluaran = $this->db->query("
            SELECT COALESCE(SUM(jumlah), 0) as total
            FROM pengeluaran 
            WHERE DATE_FORMAT(tanggal, '%Y-%m') = ?
        ", array($bulan_ini));
        $data['total_pengeluaran'] = $query_pengeluaran->row()->total;

        // Hitung saldo (pemasukan - pengeluaran)
        $data['saldo'] = $data['total_pemasukan'] - $data['total_pengeluaran'];

        // Ambil 5 data pemasukan terbaru
        $data['pemasukan'] = $this->db->query("
            SELECT 
                p.tanggal,
                p.keterangan,
                p.jumlah,
                k.nama_kategori
            FROM 
                pemasukan p
                LEFT JOIN kategori k ON p.id_kategori = k.id
            ORDER BY 
                p.tanggal DESC, 
                p.id DESC
            LIMIT 5
        ")->result();

        // Ambil 5 data pengeluaran terbaru
        $data['pengeluaran'] = $this->db->query("
            SELECT 
                p.tanggal,
                p.keterangan,
                p.jumlah,
                k.nama_kategori
            FROM 
                pengeluaran p
                LEFT JOIN kategori k ON p.id_kategori = k.id
            ORDER BY 
                p.tanggal DESC,
                p.id DESC
            LIMIT 5
        ")->result();

        // Tambahkan informasi bulan dan tahun untuk tampilan
        $data['bulan'] = date('F Y');

        $this->load->view('inc/header');
        $this->load->view('inc/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('inc/footer');
    }
}