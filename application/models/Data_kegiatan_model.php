<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kegiatan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function get_pic_list() {
        // Memilih semua kolom dari tabel users
        $this->db->select('*');
        $this->db->from('users');
        // Menyaring berdasarkan level_users yang bernilai 2
        $this->db->where('level_users', '2');  
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();  // Mengembalikan hasilnya jika ada data
        } else {
            return [];  // Mengembalikan array kosong jika tidak ada data
        }
    }
    public function get_program_list() {
        $query = $this->db->get('program');
        return $query->result(); 
    }

    public function get_kegiatan() {
        $query = $this->db->get('data_kegiatan');
        return $query->result(); 
    }
    public function get_all_kegiatan()
    {
        $this->db->select('data_kegiatan.*, users.first_name, users.last_name, users.phone, program.nama_program');
        $this->db->from('data_kegiatan');
        $this->db->join('users', 'data_kegiatan.user_id = users.id');
        $this->db->join('program', 'data_kegiatan.program_id = program.id');
        $query = $this->db->get();
        return $query->result();  // pastikan ini mengembalikan data yang sesuai
    }

    public function insert_kegiatan($data)
    {
        if ($this->db->insert('data_kegiatan', $data)) {
            return true;
        } else {
        return false; // Jika insert gagal
        }
    }

    public function get_kegiatan_by_id($id)
    {
        return $this->db->get_where('data_kegiatan', ['id' => $id])->row();
    }

    public function update_kegiatan($id, $data)
    {
        return $this->db->update('data_kegiatan', $data, ['id' => $id]);
    }

    public function delete_kegiatan($id)
    {
        return $this->db->delete('data_kegiatan', ['id' => $id]);
    }
}
