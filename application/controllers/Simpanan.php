<?php

class Simpanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->model('model_simpanan');

    }

    public function simpanan()
    {
        $data['simpanan'] = $this->model_simpanan->tipe_simpanan();
        $this->load->view('form_simpanan', $data);
    }

    public function ambilSimpanan()
    {
        $this->load->view('form_ambilSimpanan');
    }

    public function ambilSimpananW()
    {
        $this->load->view('form_ambilSimpananW');
    }

    public function simpan_simpanan()
    {
        $this->form_validation->set_rules('nominal', 'Jumlah Simpanan', 'trim|required|max_length[255]|numeric');
        $this->form_validation->set_rules('tanggal_simpanan', 'Tanggal Simpan', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<font color=red>Harus Menggunakan Angka</font>');
            $this->session->set_flashdata('pesan', '<font color=red>Form Tidak Boleh Kosong</font>');
            $data['simpanan'] = $this->model_simpanan->tipe_simpanan();
            $this->load->view('form_simpanan', $data);
        } else {
            $post = $this->input->post();
            $nominal = $post['nominal'];
            $tanggal_simpanan = $post['tanggal_simpanan'];
            $id_anggota = $post['id_anggota'];
            $id_tipeSimpanan = $post['id_tipeSimpanan'];

            $data = array(
                'nominal' => $nominal,
                'tanggal_simpanan' => $tanggal_simpanan,
                'id_anggota' => $id_anggota,
                'id_tipeSimpanan' => $id_tipeSimpanan,
            );

            $this->model_simpanan->insert($data, 'simpanan');
            $this->session->set_flashdata('sukses', '<h4><font color=green>Berhasil Menambahkan Data Simpanan !</font></h4>');
            redirect('Simpanan/simpanan');
        }
    }

    public function simpan_ambil()
    {
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|max_length[255]|numeric');
        $this->form_validation->set_rules('tanggal_ambil', 'Tanggal Ambil', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<font color=red>Harus Menggunakan Angka</font>');
            $this->session->set_flashdata('pesan', '<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('form_simpanan');
        } else {
            $post = $this->input->post();
            $nominal = $post['nominal'];
            $tanggal_ambil = $post['tanggal_ambil'];
            $id_anggota = $post['id_anggota'];

            $data = array(
                'nominal' => $nominal,
                'tanggal_ambil' => $tanggal_ambil,
                'id_anggota' => $id_anggota,
                'id_tipeSimpanan' => 2,
            );

            $this->model_simpanan->insert($data, 'riwayat_simpanan');
            $this->session->set_flashdata('sukses', '<font color=green>Berhasil Mengambil Simpanan</font>');
            redirect('Simpanan/ambil_simpanan/' . $this->session->id_anggota);
        }
    }

    public function simpan_ambilWajib()
    {
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|max_length[255]|numeric');
        $this->form_validation->set_rules('tanggal_ambil', 'Tanggal Ambil', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<font color=red>Harus Menggunakan Angka</font>');
            $this->session->set_flashdata('pesan', '<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('form_simpanan');
        } else {
            $post = $this->input->post();
            $nominal = $post['nominal'];
            $tanggal_ambil = $post['tanggal_ambil'];
            $id_anggota = $post['id_anggota'];

            $data = array(
                'nominal' => $nominal,
                'tanggal_ambil' => $tanggal_ambil,
                'id_anggota' => $id_anggota,
                'id_tipeSimpanan' => 1,
            );

            $this->model_simpanan->insert($data, 'riwayat_simpanan');
            $this->session->set_flashdata('sukses', '<font color=green>Berhasil Mengambil Simpanan</font>');
            redirect('Simpanan/ambil_simpanan/' . $this->session->id_anggota);
        }
    }

    public function ambil_simpanan($where)
    {
        $where = $this->session->id_anggota;
        $data['simpanan'] = $this->model_simpanan->ambil_simpanan($where);
        $this->load->view('v_ambilSimpanan', $data);
    }

    public function show_simpanan($where)
    {
        $where = $this->session->id_anggota;
        $data['totalSimpanan'] = $this->model_simpanan->total($where);
        $data['simpanan'] = $this->model_simpanan->tampil_simpanan($where);
        $this->load->view('v_daftarsimpanan', $data);
    }

    public function show_simpananPokok($where)
    {
        $where = $this->session->id_anggota;
        $data['simpanan'] = $this->model_simpanan->tampil_simpananPokok($where);
        $this->load->view('v_simpananPokok', $data);
    }

    public function show_simpananWajib($where)
    {
        $where = $this->session->id_anggota;
        $data['totalSimpanan'] = $this->model_simpanan->total($where);
        $data['simpanan'] = $this->model_simpanan->tampil_simpananWajib($where);
        $this->load->view('v_daftarsimpananWajib', $data);
    }

    public function laporan_simpanan()
    {
        $data['simpanan'] = $this->model_simpanan->laporan_simpanan2();
        $this->load->view('laporan_simpanan', $data);
    }

    public function laporan_simpananWajib()
    {
        $data['simpanan'] = $this->model_simpanan->laporan_simpananWajib();
        $this->load->view('laporan_simpananWajib', $data);
    }

    public function laporan_simpananPokok()
    {
        $data['simpanan'] = $this->model_simpanan->laporan_simpananPokok();
        $this->load->view('laporan_simpananPokok', $data);
    }

    public function riwayat_simpanan()
    {
        $data['simpanan'] = $this->model_simpanan->riwayat_simpanan();
        $this->load->view('riwayat_simpanan', $data);
    }

    public function riwayat_pengambilan()
    {
        $data['simpanan'] = $this->model_simpanan->ambil_simpananPetugas();
        $this->load->view('v_riwayat_pengambilan', $data);
    }

    public function editsimpanan($id_simpanan)
    {
        $where = array('id_simpanan' => $id_simpanan);
        $data['simpanan'] = $this->model_simpanan->edit_simpanan($where, 'simpanan')->result();
        $this->load->view('v_edit_simpanan', $data);
    }

    public function editsimpananWajib($id_simpanan)
    {
        $where = array('id_simpanan' => $id_simpanan);
        $data['simpanan'] = $this->model_simpanan->edit_simpanan($where, 'simpanan')->result();
        $this->load->view('v_edit_simpananWajib', $data);
    }

    public function updatesimpanan()
    {
        $id_simpanan = $this->input->post('id_simpanan');
        $nominal = $this->input->post('nominal');
        $tanggal_simpanan = $this->input->post('tanggal_simpanan');

        $data = array(
            'nominal' => $nominal,
            'tanggal_simpanan' => $tanggal_simpanan,
        );

        $where = array(
            'id_simpanan' => $id_simpanan,
        );
        $this->model_simpanan->update_simpanan($where, $data, 'simpanan');
        redirect('simpanan/show_simpanan/' . $this->session->id_anggota);
    }

    public function updatesimpananWajib()
    {
        $id_simpanan = $this->input->post('id_simpanan');
        $nominal = $this->input->post('nominal');
        $tanggal_simpanan = $this->input->post('tanggal_simpanan');

        $data = array(
            'nominal' => $nominal,
            'tanggal_simpanan' => $tanggal_simpanan,
        );

        $where = array(
            'id_simpanan' => $id_simpanan,
        );
        $this->model_simpanan->update_simpanan($where, $data, 'simpanan');
        redirect('simpanan/show_simpananWajib/' . $this->session->id_anggota);
    }

    public function hapussimpanan($id_simpanan)
    {
        $where = array('id_simpanan' => $id_simpanan);
        $this->model_simpanan->hapus_simpanan($where, 'simpanan');
        redirect('simpanan/show_simpanan/' . $this->session->id_anggota);
    }

    public function hapussimpananWajib($id_simpanan)
    {
        $where = array('id_simpanan' => $id_simpanan);
        $this->model_simpanan->hapus_simpanan($where, 'simpanan');
        redirect('simpanan/show_simpananWajib/' . $this->session->id_anggota);
    }

    public function lihat_anggota()
    {
        $data['totalAnggota'] = $this->model_simpanan->laporan_anggota_petugas();
        $data['anggota'] = $this->model_simpanan->tampil_anggota();
        $this->load->view('v_anggota', $data);
    }

    public function hapusAnggota($id_anggota)
    {
        $where = array('id_anggota' => $id_anggota);
        $this->model_simpanan->hapus_simpanan($where, 'anggota');
        redirect('Simpanan/lihat_anggota');
    }

    public function bukti_simpanan($id_simpanan)
    {
        $data['simpanan'] = $this->model_simpanan->bukti($id_simpanan)->result();
        $this->load->library('pdf');
        $this->load->view('bukti_simpanan', $data);
    }

    public function searchRiwayat_Pengambilan()
    {
        $keyword = $this->input->post('search');
        $data['simpanan'] = $this->model_simpanan->searchRiwayat_Pengambilan($keyword);
        $this->load->view('v_riwayat_pengambilan', $data);
    }

    public function searchRiwayat_simpanan()
    {
        $keyword = $this->input->post('search');
        $data['simpanan'] = $this->model_simpanan->searchRiwayat_simpanan($keyword);
        $this->load->view('riwayat_simpanan', $data);
    }

    public function jaminan_anggota($id_anggota)
    {
        //$where = array('id_anggota' => $id_anggota);
        $data['jaminan'] = $this->model_simpanan->jaminan_anggota($id_anggota);
        $this->load->view('v_jaminan_anggota', $data);
    }

    public function lihat_statusanggota()
    {
        $data['anggota'] = $this->model_simpanan->tampil_statusanggota();
        $this->load->view('v_statusanggota', $data);
    }

    public function aktifkan($id_anggota)
    {
        $status_anggota = 1;
        $data = array(
            'status_anggota' => $status_anggota,
        );

        $where = array(
            'id_anggota' => $id_anggota,
        );

        $data_anggota = $this->db->get_where('anggota', $where)->row_array();

        $this->model_simpanan->update_simpanan($where, $data, 'anggota');

        $this->_sendEmail('Akun anda telah aktif, <a href=' . base_url() . '>Klik disini</a> untuk login', $data_anggota['email']);

        redirect('Simpanan/lihat_statusanggota');
    }

    public function nonaktifkan($id_anggota)
    {
        $status_anggota = 2;
        $data = array(
            'status_anggota' => $status_anggota,
        );

        $where = array(
            'id_anggota' => $id_anggota,
        );

        $data_anggota = $this->db->get_where('anggota', $where)->row_array();

        $this->model_simpanan->update_simpanan($where, $data, 'anggota');

        $this->_sendEmail('Mohon maaf, akun anda dinonaktifkan, <a href=' . base_url() . '>Klik disini</a> untuk login', $data_anggota['email']);

        redirect('Simpanan/lihat_statusanggota');
    }

    private function _sendEmail($pesan, $email)
    {

        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'unregistered30@gmail.com',
            'smtp_pass' => 'Medellincartel13!',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        // $pesan = "asdasdas";

        $this->email->initialize($config);
        $this->email->from('admin@gmail.com', 'Admin Aplikasi');
        $this->email->to($email);

        $this->email->subject('Perhatian!!');
        $this->email->message($pesan);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}