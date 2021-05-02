<?php

class Pinjaman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session', 'mpdf');
        $this->load->model('model_pinjaman');
        // $this->load->model('model_angsuran');
        $this->load->helper(array('form', 'url', 'file'));
    }

    public function pinjaman()
    {
        $this->load->view('form_pinjaman');
    }

    public function simpan_pinjaman()
    {

        $this->form_validation->set_rules('jml_pinjaman', 'Jumlah Pinjaman', 'trim|required|max_length[255]|numeric');
        $this->form_validation->set_rules('tgl_pinjaman', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('tenor', 'Lama Pinjaman', 'required');
        $this->form_validation->set_rules('jaminan', 'Jaminan', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<font color=red>Harus Menggunakan Angka</font>');
            $this->session->set_flashdata('pesan', '<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('form_pinjaman');
        } else {
            //upload foto
            if (!empty($_FILES['foto_barang']['name'])) {
                // Set preference
                $config['upload_path'] = './storage/upload_jaminan/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|pdf';
                $config['max_size'] = '256000'; // max_size in kb
                $config['file_name'] = time() . '-' . $_FILES['foto_barang']['name'];

                // Load upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // File upload
                if ($this->upload->do_upload('foto_barang')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $jaminan_foto = $uploadData['file_name'];
                    $data['response'] = 'successfully uploaded ' . $jaminan_foto;
                } else {
                    $data['response'] = 'error_upload' . $this->upload->display_errors();
                    $this->load->view('form_pinjaman', $data);
                }
            } else {
                $jaminan_foto = null;
            }

            //upload stnk
            if (!empty($_FILES['f_stnk']['name'])) {
                // Set preference
                $config['upload_path'] = './storage/upload_jaminan/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|pdf';
                $config['max_size'] = '256000'; // max_size in kb
                $config['file_name'] = time() . '-' . $_FILES['f_stnk']['name'];

                // Load upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // File upload
                if ($this->upload->do_upload('f_stnk')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $jaminan_stnk = $uploadData['file_name'];
                    $data['response'] = 'successfully uploaded ' . $jaminan_stnk;
                } else {
                    $data['response'] = 'error_upload' . $this->upload->display_errors();
                    $this->load->view('form_pinjaman', $data);
                }
            } else {
                $jaminan_stnk = null;
            }

            //upload pajak
            if (!empty($_FILES['f_pajak']['name'])) {
                // Set preference
                $config['upload_path'] = './storage/upload_jaminan/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|pdf';
                $config['max_size'] = '256000'; // max_size in kb
                $config['file_name'] = time() . '-' . $_FILES['f_pajak']['name'];

                // Load upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // File upload
                if ($this->upload->do_upload('f_pajak')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $jaminan_pajak = $uploadData['file_name'];
                    $data['response'] = 'successfully uploaded ' . $jaminan_pajak;
                } else {
                    $data['response'] = 'error_upload' . $this->upload->display_errors();
                    $this->load->view('form_pinjaman', $data);
                }
            } else {
                $jaminan_pajak = null;
            }

            //upload ktp
            if (!empty($_FILES['f_ktp']['name'])) {
                // Set preference
                $config['upload_path'] = './storage/upload_jaminan/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|pdf';
                $config['max_size'] = '256000'; // max_size in kb
                $config['file_name'] = time() . '-' . $_FILES['f_ktp']['name'];

                // Load upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // File upload
                if ($this->upload->do_upload('f_ktp')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $jaminan_ktp = $uploadData['file_name'];
                    $data['response'] = 'successfully uploaded ' . $jaminan_ktp;
                } else {
                    $data['response'] = 'error_upload' . $this->upload->display_errors();
                    $this->load->view('form_pinjaman', $data);
                }
            } else {
                $data['response'] = 'file ktp tidak ada';
                $this->load->view('form_pinjaman', $data);
            }

            //upload surat
            if (!empty($_FILES['f_surat']['name'])) {
                // Set preference
                $config['upload_path'] = './storage/upload_jaminan/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|pdf';
                $config['max_size'] = '256000'; // max_size in kb
                $config['file_name'] = time() . '-' . $_FILES['f_surat']['name'];

                // Load upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // File upload
                if ($this->upload->do_upload('f_surat')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                    $jaminan_surat = $uploadData['file_name'];
                    $data['response'] = 'successfully uploaded ' . $jaminan_surat;

                    $post = $this->input->post();
                    $jml_pinjaman = $post['jml_pinjaman'];
                    $tenor = $post['tenor'];
                    $plafon = 0;
                    // $angsuran = 2 / 100 * $jml_pinjaman;

                    $bunga = 2;
                    $tgl_pinjaman = $post['tgl_pinjaman'];
                    $id_anggota = $post['id_anggota'];
                    $jenis_jaminan = $post['jaminan'];
                    $status = "On Going";

                    $tenorr = date("Y-m-d", strtotime("+$tenor month", strtotime($tgl_pinjaman)));

                    $getlastdata = $this->model_pinjaman->getLastTransaction($id_anggota)->row_array();

                    $tgl_mulai = $tgl_pinjaman;
                    $tgl_selesai = $tenorr;

                    //convert
                    $timeStart = strtotime($tgl_mulai);
                    $timeEnd = strtotime($tgl_selesai);

                    // Menambah bulan ini + semua bulan pada tahun sebelumnya
                    $numBulan = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;

                    // hitung selisih bulan
                    $numBulan += date("m", $timeEnd) - date("m", $timeStart);

                    $jml_bulan = $numBulan - 1;

                    $jml_bunga = 0;

                    $angsuran = round($jml_pinjaman / $jml_bulan, 0);
                    $bungaaa = 0;
                    $sisa_pinjaman = $jml_pinjaman;
                    // $angsuranbulan = 0;

                    for ($i = 0; $i < $jml_bulan; $i++) {

                        $bungaaa = round($sisa_pinjaman * 2 / 100, 0);
                        // $angsuranbulan = $bungaaa + $angsuran;
                        $sisa_pinjaman = $sisa_pinjaman - $angsuran;

                        $jml_bunga = round($jml_bunga + $bungaaa, 0);

                    }

                    if ($getlastdata) {
                        $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Maaf!</strong> Anda belum meneylesaikan peminjaman sebelumnnya, silahkan lakukan setoran terlebih dahulu!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>');
                        redirect('Pinjaman/pinjaman');
                    } else {

                        $data = array(
                            'jml_pinjaman' => $jml_pinjaman,
                            'tenor' => $tenorr,
                            'plafon' => $plafon,
                            'angsuran' => round($jml_bunga + $jml_pinjaman, 0),
                            'bunga' => $bunga,
                            'tgl_pinjaman' => $tgl_pinjaman,
                            'id_anggota' => $id_anggota,
                            'status' => $status,
                            'jenis_jaminan' => $jenis_jaminan,
                            'jaminan_ktp' => $jaminan_ktp,
                            'jaminan_surat' => $jaminan_surat,
                            'jaminan_pajak' => $jaminan_pajak,
                            'jaminan_stnk' => $jaminan_stnk,
                            'jaminan_foto' => $jaminan_foto,
                        );

                        $this->model_pinjaman->insert($data, 'pinjaman');
                        //$this->model_pinjaman->insert($data, 'histori_pinjaman');
                        $this->session->set_flashdata('sukses', '<font color=green>Berhasil Menambahkan Pinjaman</font>');
                        redirect('Pinjaman/pinjaman');
                    }
                } else {
                    $data['response'] = 'error_upload' . $this->upload->display_errors();
                    $this->load->view('form_pinjaman', $data);
                }
            } else {
                $data['response'] = 'file surat tidak ada';
                $this->load->view('form_pinjaman', $data);
            }
        }
    }

    public function riwayatPinjaman($where)
    {
        $where = $this->session->id_anggota;
        $data['pinjaman'] = $this->model_pinjaman->tampil_riwayatPinjaman($where);
        $this->load->view('v_riwayatPinjaman', $data);
    }

    public function show_pinjaman($where)
    {
        $where = $this->session->id_anggota;
        $cekPinjaman = $this->model_pinjaman->cekPinjaman($where)->result();

        $cek_angsuran = $this->model_pinjaman->getLastTransaction($where)->row_array();

        if ($cek_angsuran) {
            if ($cek_angsuran['angsuran'] == 0) {

                $set_upd = [
                    'status' => 'Cleared',
                ];

                $set_upd2 = [
                    'status' => 'Cleared',
                ];

                $this->db->update('pinjaman', $set_upd, ['id_anggota' => $where]);
                $this->db->update('histori_pinjaman', $set_upd2, ['id_pinjaman' => $cek_angsuran['id_pinjaman']]);
            }
        }

        // $cek_angsuran['angsuran']

        if ($cekPinjaman) {
            if ($cekPinjaman[0]->tenor < date("Y-m-d")) {
                $jml_pinjaman = $cekPinjaman[0]->jml_pinjaman * 2;
                $data = array(
                    'jml_pinjaman' => $jml_pinjaman,
                );
                $where = array('id_anggota' => $this->session->id_anggota, 'jml_pinjaman' => $cekPinjaman[0]->tenor < date("Y-m-d"));
                $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
                $where = $this->session->id_anggota;
                $data['totalPinjaman'] = $this->model_pinjaman->total($where);
                $data['totalAngsuran'] = $this->model_pinjaman->totalAngsuran($where);
                $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman($where);
                $this->load->view('v_daftarPinjaman', $data);
            } else {
                $where = $this->session->id_anggota;
                $data['totalPinjaman'] = $this->model_pinjaman->total($where);
                $data['totalAngsuran'] = $this->model_pinjaman->totalAngsuran($where);
                $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman($where);
                $this->load->view('v_daftarPinjaman', $data);
            }
        } else {
            $where = $this->session->id_anggota;
            $data['totalPinjaman'] = $this->model_pinjaman->total($where);
            $data['totalAngsuran'] = $this->model_pinjaman->totalAngsuran($where);
            $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman($where);
            $this->load->view('v_daftarPinjaman', $data);
        }
    }

    public function daftarPinjaman($id_anggota)
    {
        #$where = array('id_anggota' => $id_anggota);
        $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman($id_anggota);
        $this->load->view('v_daftarPinjaman_pengurus', $data);
    }

    public function acc_pinjaman()
    {
        $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman_petugas();
        $this->load->view('acc_pinjaman', $data);
    }

    public function laporan_pinjaman()
    {
        // $year = 'all';
        // $data['pinjaman'] = $this->model_pinjaman->laporan_pinjaman($year);
        // $this->load->view('laporan_pinjaman', $data);
        $data['tahun'] = $this->model_pinjaman->selectTahun();
        $this->load->view('laporan_pinjaman', $data);
    }

    public function getLaporan($year = null)
    {
        $data = $this->model_pinjaman->laporan_pinjaman($year);
        echo json_encode($data);
        // return $data;
    }

    public function denda($id_pinjaman)
    {
        $where = array('id_pinjaman' => $id_pinjaman);
        $data['pinjaman'] = $this->model_pinjaman->edit_pinjaman($where, 'pinjaman')->result();
        $this->load->view('v_denda', $data);
    }

    public function simpan_denda()
    {
        $post = $this->input->post();
        $jml_pinjaman = $post['jml_pinjaman'];
        $tenor = $post['tenor'];
        $plafon = 0;
        $bunga = 2;
        $tgl_pinjaman = $post['tgl_pinjaman'];
        $id_anggota = $post['id_anggota'];
        $id_pinjaman = $post['id_pinjaman'];
        $status = $post['status'];
        $denda = $post['denda'];

        $data = array(
            'jml_pinjaman' => $jml_pinjaman,
            'tenor' => $tenor,
            'plafon' => $plafon,
            'bunga' => $bunga,
            'tgl_pinjaman' => $tgl_pinjaman,
            'id_anggota' => $id_anggota,
            'id_pinjaman' => $id_pinjaman,
            'status' => $status,
            'denda' => $denda,
        );

        $where = array('id_pinjaman' => $id_pinjaman);
        $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
        redirect('Pinjaman/daftarPinjaman/' . $id_anggota);
    }
    public function editPinjaman($id_pinjaman)
    {
        $where = array('id_pinjaman' => $id_pinjaman);
        $data['pinjaman'] = $this->model_pinjaman->edit_pinjaman($where, 'pinjaman')->result();
        $this->load->view('v_edit_pinjaman', $data);
    }

    public function updatePinjaman()
    {
        $id_pinjaman = $this->input->post('id_pinjaman');
        $jml_pinjaman = $this->input->post('jml_pinjaman');
        $tenor = $this->input->post('tenor');
        $tgl_pinjaman = $this->input->post('tgl_pinjaman');
        $bunga = $this->input->post('bunga');
        $angsuran = 2 / 100 * $jml_pinjaman;

        $data = array(
            'jml_pinjaman' => $jml_pinjaman,
            'tenor' => $tenor,
            'tgl_pinjaman' => $tgl_pinjaman,
            'angsuran' => $angsuran + $jml_pinjaman,
            'bunga' => $bunga,
        );

        $where = array(
            'id_pinjaman' => $id_pinjaman,
        );
        $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
        redirect('Pinjaman/show_pinjaman/' . $this->session->id_anggota);
    }

    public function update_taksiran($id)
    {
        $taksiran = $this->input->post('taksiran');
        $data = array(
            'taksiran_jaminan' => $taksiran,
        );
        $where = array(
            'id_pinjaman' => $id,
        );
        $query = $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
        redirect('Pinjaman/acc_pinjaman/');
    }

    public function approval($id_pinjaman)
    {
        $post = $this->input->post();
        $jml_pinjaman = $post['jml_pinjaman'];
        $tenor = $post['tenor'];
        $plafon = 0;
        $bunga = 2;
        $tgl_pinjaman = $post['tgl_pinjaman'];
        $id_anggota = $post['id_anggota'];
        $id_pinjaman = $post['id_pinjaman'];
        $status = "Accepted";

        $data = array(
            'status' => $status,
        );

        $data2 = array(
            'jml_pinjaman' => $jml_pinjaman,
            'tenor' => $tenor,
            'plafon' => $plafon,
            'bunga' => $bunga,
            'tgl_pinjaman' => $tgl_pinjaman,
            'id_anggota' => $id_anggota,
            'id_pinjaman' => $id_pinjaman,
            'status' => $status,
        );

        $where = array(
            'id_pinjaman' => $id_pinjaman,
        );
        $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
        $this->model_pinjaman->insert($data2, 'histori_pinjaman');
        redirect('Pinjaman/acc_pinjaman');
    }

    public function hapusPinjaman($id_pinjaman)
    {
        $where = array('id_pinjaman' => $id_pinjaman);
        $this->model_pinjaman->hapus_pinjaman($where, 'pinjaman');
        redirect('Pinjaman/show_pinjaman/' . $this->session->id_anggota);
    }

    public function tolak($id_pinjaman)
    {
        $data = array(
            'status' => 'Declined',
        );
        $where = array('id_pinjaman' => $id_pinjaman);

        $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');

        $this->model_pinjaman->update_pinjaman($where, $data, 'histori_pinjaman');

        redirect('Pinjaman/acc_pinjaman/');
    }

    public function searchAcc()
    {
        $keyword = $this->input->post('search');
        $data['pinjaman'] = $this->model_pinjaman->searchAcc($keyword);
        $this->load->view('acc_pinjaman', $data);
    }

    public function cetak_resi($id_pinjaman)
    {
        //$where = array('id_pinjaman' => $id_pinjaman);
        $data['pinjaman'] = $this->model_pinjaman->resi($id_pinjaman)->result();
        $this->load->library('pdf');
        $this->load->view('resi', $data);
    }

    public function bungaMenurun()
    {

        $id_anggota = $this->session->userdata('id_anggota');
        $getLastPinjaman = $this->model_pinjaman->getLastTransaction($id_anggota)->row_array();

        $tgl_mulai = '';
        $tgl_selesai = '';
        if (!$getLastPinjaman) {
            $tgl_mulai = '0000-00-00';
            $tgl_selesai = '0000-00-00';
        } else {
            $tgl_mulai = $getLastPinjaman['tgl_pinjaman'];
            $tgl_selesai = $getLastPinjaman['tenor'];
        }

        //convert
        $timeStart = strtotime($tgl_mulai);
        $timeEnd = strtotime($tgl_selesai);

        // Menambah bulan ini + semua bulan pada tahun sebelumnya
        $numBulan = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;

        // hitung selisih bulan
        $numBulan += date("m", $timeEnd) - date("m", $timeStart);

        $data['bulann'] = $numBulan;
        $data['jml_pinjaman'] = 0;
        if (!$getLastPinjaman) {
            $data['jml_pinjaman'] = 0;
        } else {
            $data['jml_pinjaman'] = $getLastPinjaman['jml_pinjaman'];
        }

        $this->load->view('bungaMenurun', $data);
    }
}