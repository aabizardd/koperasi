<?php

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('image_lib');
        $this->load->model('login_model');
        $this->load->model('model_simpanan');
        $this->load->model('model_pinjaman');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url', 'file'));

    }
    public function laporan()
    {
        $this->load->view('v_tentang');
    }
    public function index()
    {
        $where = $this->session->id_anggota;
        $data['angsuran'] = $this->model_pinjaman->totalAngsuran($where);
        $this->db->count_all_results('angsuran');
        $data['pinjaman'] = $this->model_pinjaman->laporan_pinjaman2($where);
        $data['simpanan'] = $this->model_simpanan->total_simpan($where);
        $data['simpananW'] = $this->model_simpanan->total_simpanWajib($where);
        $this->load->view('v_laporan', $data);
    }

}