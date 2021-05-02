<?php

class Angsuran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session', 'mpdf');
        $this->load->model('model_angsuran');
        $this->load->model('model_pinjaman');
        $this->load->helper(array('form', 'url', 'file'));

    }

    public function angsuran()
    {
        $this->load->view('form_angsuran');
    }

    public function bayar($id_pinjaman)
    {
        $where = array('id_pinjaman' => $id_pinjaman);
        $where2 = $this->session->id_anggota;
        $data['pinjaman'] = $this->model_pinjaman->edit_pinjaman($where, 'pinjaman')->result();
        $data['pinjaman2'] = $this->model_pinjaman->tampil_pinjaman($where2);
        $this->load->view('v_angsuran', $data);
    }

    public function aksi_bayar()
    {
        $nominal = $this->input->post('nominal');
        $id_pinjaman = $this->input->post('id_pinjaman');
        $angsuran = $this->input->post('angsuran');
        $tanggal_angsuran = $this->input->post('tanggal_angsuran');

        $data = array(
            'angsuran' => $angsuran - $nominal,
        );

        $where = array(
            'id_pinjaman' => $id_pinjaman,
        );
        $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
        $data2 = array(
            'id_pinjaman' => $id_pinjaman,
            'nominal' => $nominal,
            'tanggal_angsuran' => $tanggal_angsuran,
        );

        $this->model_angsuran->insert($data2, 'angsuran');
        redirect('Pinjaman/show_pinjaman/' . $this->session->id_anggota);
    }

    public function simpan_angsuran()
    {
        $post = $this->input->post();
        $nominal = $post['nominal'];
        $tanggal_angsuran = $post['tanggal_angsuran'];
        $id_pinjaman = $post['id_pinjaman'];

        $data = array(
            'nominal' => $nominal,
            'tanggal_angsuran' => $tanggal_angsuran,
            'id_pinjaman' => $id_pinjaman,
        );

        $this->model_angsuran->insert($data, 'angsuran');
        redirect('Angsuran/angsuran');
    }

    public function show_angsuran($where)
    {
        $where = $this->session->id_anggota;
        $data['angsuran'] = $this->model_angsuran->tampil_angsuran($where);

        $this->load->view('v_daftarangsuran', $data);
    }

    public function lihatAngsuran($id_anggota)
    {
        //$where = $this->session->id_anggota;
        $data['angsuran'] = $this->model_angsuran->tampil_angsuranPetugas($id_anggota);
        $this->load->view('v_daftarAngsuran_petugas', $data);
    }

    public function laporan_angsuran()
    {
        $data['angsuran'] = $this->model_angsuran->laporan_angsuran();
        $this->load->view('laporan_angsuran', $data);
    }

    public function editangsuran($id_angsuran)
    {
        $where = array('id_angsuran' => $id_angsuran);
        $data['angsuran'] = $this->model_angsuran->edit_angsuran($where, 'angsuran')->result();
        $this->load->view('v_edit_angsuran', $data);
    }

    public function updateangsuran()
    {
        $id_angsuran = $this->input->post('id_angsuran');
        $nominal = $this->input->post('nominal');
        $tanggal_angsuran = $this->input->post('tanggal_angsuran');

        $data = array(
            'nominal' => $nominal,
            'tanggal_angsuran' => $tanggal_angsuran,
        );

        $where = array(
            'id_angsuran' => $id_angsuran,
        );
        $this->model_angsuran->update_angsuran($where, $data, 'angsuran');
        redirect('angsuran/show_angsuran/' . $this->session->id_anggota);
    }

    public function hapusangsuran($id_angsuran)
    {
        $where = array('id_angsuran' => $id_angsuran);
        $this->model_angsuran->hapus_angsuran($where, 'angsuran');
        redirect('angsuran/show_angsuran/' . $this->session->id_anggota);
    }
}