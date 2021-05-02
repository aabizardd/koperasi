<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('image_lib');
        $this->load->model('login_model');
        $this->load->model('model_angsuran');
        $this->load->model('model_pinjaman');
        $this->load->model('model_simpanan');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url', 'file'));

    }

    public function index()
    {
        redirect('Laporan');
    }
    public function laporan()
    {

        $where = $this->session->id_anggota;
        $data['angsuran'] = $this->model_pinjaman->totalAngsuran($where);
        $this->db->count_all_results('angsuran');
        $data['pinjaman'] = $this->model_pinjaman->tampil_riwayatPinjaman($where);
        $data['simpanan'] = $this->model_simpanan->total_simpan($where);
        $data['simpananW'] = $this->model_simpanan->total_simpanWajib($where);
        $data['totalPinjaman'] = $this->model_pinjaman->total($where);
        $data['totalAngsuran'] = $this->model_pinjaman->totalAngsuran($where);
        $data['tampilpinjaman'] = $this->model_pinjaman->tampil_riwayatPinjaman($where);
        $data['dataangsuran'] = $this->model_angsuran->tampil_angsuran($where);
        $data['simpananpokok'] = $this->model_simpanan->tampil_simpananPokok($where);
        $data['totalSimpananWajib'] = $this->model_simpanan->total_simpanWajib($where);
        $data['totalSimpananSukarela'] = $this->model_simpanan->total_simpanSukarela($where);
        $data['cekpinjaman'] = $cekPinjaman = $this->model_pinjaman->cekPinjaman($where)->result();
        $this->load->view('v_laporan', $data);
        if ($cekPinjaman[0]->tenor < date("Y-m-d")) {
            $jml_pinjaman = $cekPinjaman[0]->jml_pinjaman * 2;
            $data = array(
                'jml_pinjaman' => $jml_pinjaman);
            $where = array('id_anggota' => $this->session->id_anggota, 'jml_pinjaman' => $cekPinjaman[0]->tenor < date("Y-m-d"));
            $this->model_pinjaman->update_pinjaman($where, $data, 'pinjaman');
            $where = $this->session->userdata('id_anggota');
            $data['totalPinjaman'] = $this->model_pinjaman->total($where);
            $data['totalAngsuran'] = $this->model_pinjaman->totalAngsuran($where);
            $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman($where);

        } else {
            $where = $this->session->userdata('id_anggota');
            $data['totalPinjaman'] = $this->model_pinjaman->total($where);
            $data['totalAngsuran'] = $this->model_pinjaman->totalAngsuran($where);
            $data['pinjaman'] = $this->model_pinjaman->tampil_pinjaman($where);

        }

    }

    public function login()
    {
        $this->load->view('login');

        # flash data untuk pesan selamat datang di dasbor
        $this->session->set_flashdata('login_status', 'ok');
    }

    public function login_petugas()
    {
        $this->load->view('login_petugas');
    }

    public function aksi_login()
    {

        if ($this->input->method(true) == 'GET') {
            $this->load->view('login');
        } else {
            $user = $this->login_model->ambil_akun(
                $this->input->post('username'),
                $this->input->post('password'));

            if ($user) {
                $this->session->set_userdata(
                    array(
                        'nama' => $user[0]->nama,
                        'status_anggota' => $user[0]->status_anggota,
                        'id_anggota' => $user[0]->id_anggota,
                        'username' => $user[0]->username,
                        'password' => $user[0]->password));
                if ($this->session->userdata['status_anggota'] == 1) {
                    redirect('/Dashboard');
                } else {
                    $this->session->set_flashdata(
                        'pesan', 'Username atau Password salah.');
                    $this->load->view('login');
                }

            } else {
                $this->session->set_flashdata(
                    'pesan', 'Username atau Password salah.');
                $this->load->view('login');
            }
        }
    }

    public function aksi_login_petugas()
    {

        if ($this->session->username) {
            redirect('Dashboard/dashboard_petugas');

        }

        if ($this->input->method(true) == 'GET') {
            $this->load->view('login');
        } else {
            $user = $this->login_model->ambil_akun_petugas(
                $this->input->post('username'),
                $this->input->post('password'));

            if ($user) {
                $this->session->set_userdata(
                    array(
                        'nama' => $user[0]->nama,
                        'id_petugas' => $user[0]->id_petugas,
                        'username' => $user[0]->username,
                        'password' => $user[0]->password));
                redirect('/Dashboard/dashboard_petugas');
            } else {
                $this->session->set_flashdata(
                    'pesan', 'Username atau Password salah.');
                $this->load->view('login_petugas');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login/login');
    }

    public function logoutPetugas()
    {
        $this->session->sess_destroy();
        redirect('Login/login_petugas');
    }

    public function register() // halaman registrasi

    {
        $this->load->view('v_register');
    }

    public function register_aksi()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required|max_length[255]|numeric');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<font color=red>Form Tidak Boleh Kosong</font>');
            $this->load->view('v_register');
        } else {
            $config['upload_path'] = './asset/foto/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = true; //nama yang terupload nantinya

            $this->upload->initialize($config);
            if ($this->form_validation->run() != false) {
                if (!empty($_FILES['ktp']['name'])) {
                    if ($this->upload->do_upload('ktp')) {
                        $gbr = $this->upload->data();
                        //Compress Image
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './asset/foto/' . $gbr['file_name'];
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = false;
                        $config['width'] = 500;
                        $config['height'] = 325;
                        $config['new_image'] = './asset/foto/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        //$gbr  =    $gbr['file_name'];
                        $gbr = $gbr['file_name'];
                        $post = $this->input->post();
                        $nama = $post['nama'];
                        $nik = $post['nik'];
                        $jenis_kelamin = $post['jenis_kelamin'];
                        $email = $post['email'];
                        $alamat = $post['alamat'];
                        $username = $post['username'];
                        $password = $post['password'];
                        $no_hp = $post['no_hp'];
                        $status = 2;

                        $data = array(
                            'nama' => $nama,
                            'nik' => $nik,
                            'jenis_kelamin' => $jenis_kelamin,
                            'email' => $email,
                            'username' => $username,
                            'password' => $password,
                            'no_hp' => $no_hp,
                            'ktp' => $gbr,
                            'alamat' => $alamat,
                            'status_anggota' => $status,

                        );
                        $this->login_model->input_data($data, 'anggota');
                        $this->session->set_flashdata('pesan', '<font color=green>Sukses Mendaftar</font>');
                        $this->load->view("login");
                    } else {
                        redirect('Login/register');
                    }

                }
            } else {
                //$this->load->view('admin/kegiatan/input_kegiatan');
            }
        }
    }

    public function BPKB_aksi()
    {
        $config['upload_path'] = './asset/foto/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = true; //nama yang terupload nantinya

        $this->upload->initialize($config);

        if (!empty($_FILES['bpkb']['name'])) {
            if ($this->upload->do_upload('bpkb')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './asset/foto/' . $gbr['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['width'] = 500;
                $config['height'] = 325;
                $config['new_image'] = './asset/foto/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                //$gbr  =   $gbr['file_name'];
                $gbr = $gbr['file_name'];
                $data = array(
                    'bpkb' => $gbr,
                );
                $where = array(
                    'id_anggota' => $this->session->id_anggota,
                );
                $this->login_model->update_data($where, $data, 'anggota');
                $this->session->set_flashdata('pesan', '<font color=green>Sukses</font>');
                $this->load->view("v_regisSTNK", $where);
            } else {
                #redirect();
            }

        } else {
            //$this->load->view('admin/kegiatan/input_kegiatan');
        }
    }

    public function v_bukti()
    {
        $where = array(
            'id_anggota' => $this->session->id_anggota,
        );
        $this->load->view("v_regisBPKB", $where);
    }

    public function STNK_aksi()
    {
        $config['upload_path'] = './asset/foto/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = true; //nama yang terupload nantinya

        $this->upload->initialize($config);

        if (!empty($_FILES['stnk']['name'])) {
            if ($this->upload->do_upload('stnk')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './asset/foto/' . $gbr['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['width'] = 500;
                $config['height'] = 325;
                $config['new_image'] = './asset/foto/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                //$gbr  =   $gbr['file_name'];
                $gbr = $gbr['file_name'];
                $data = array(
                    'stnk' => $gbr,
                );
                $where = array(
                    'id_anggota' => $this->session->id_anggota,
                );
                $this->login_model->update_data($where, $data, 'anggota');
                $this->session->set_flashdata('pesan', '<font color=green>Sukses</font>');
                redirect("Dashboard");
            } else {
                //redirect('Login/register');
            }

        } else {
            //$this->load->view('admin/kegiatan/input_kegiatan');
        }
    }

    public function lihat_akun()
    {
        $user = $this->login_model->ambil_akun2($this->session->id_anggota)->row();
        $data = array(
            'id_anggota' => $user->id_anggota,
            'username' => $user->username,
            'nama' => $user->nama,
            'alamat' => $user->alamat,
            'no_hp' => $user->no_hp,
            'email' => $user->email,
            'nik' => $user->nik,
            'jenis_kelamin' => $user->jenis_kelamin,
        );
        $this->load->view('lihat_akun', $data);
    }

    public function edit_akun()
    {
        $user = $this->login_model->edit_data($this->session->id_anggota)->row();
        $data = array(
            'id_anggota' => $user->id_anggota,
            'nama' => $user->nama,
            'password' => $user->password,
            'username' => $user->username,
            'no_hp' => $user->no_hp,
            'email' => $user->email,
            'nik' => $user->nik,
            'alamat' => $user->alamat,
        );
        $this->load->view('edit_akun', $data);
    }

    public function update_akun()
    {
        $post = $this->input->post();
        $id_anggota = $post['id_anggota'];
        $nama = $post['nama'];
        $nik = $post['nik'];
        $email = $post['email'];
        $alamat = $post['alamat'];
        $username = $post['username'];
        $password = $post['password'];
        $no_hp = $post['no_hp'];

        $data = array(
            'nama' => $nama,
            'password' => $password,
            'username' => $username,
            'no_hp' => $no_hp,
            'email' => $email,
            'nik' => $nik,
            'alamat' => $alamat,
        );

        $where = array(
            'id_anggota' => $id_anggota,
        );

        $this->login_model->update_data($where, $data, 'anggota');
        redirect('Login/lihat_akun');
    }

    public function lihat_akun_petugas()
    {
        $user = $this->login_model->ambil_akun3($this->session->id_petugas)->row();
        $data = array(
            'id_petugas' => $user->id_petugas,
            'username' => $user->username,
            'nama' => $user->nama,
        );
        $this->load->view('lihat_akun_petugas', $data);
    }

    public function edit_akun_petugas()
    {
        $user = $this->login_model->edit_data_petugas($this->session->id_petugas)->row();
        $data = array(
            'id_petugas' => $user->id_petugas,
            'nama' => $user->nama,
            'password' => $user->password,
            'username' => $user->username,
        );
        $this->load->view('edit_akun_petugas', $data);
    }

    public function update_akun_petugas()
    {
        $post = $this->input->post();
        $id_petugas = $post['id_petugas'];
        $nama = $post['nama'];
        $username = $post['username'];
        $password = $post['password'];

        $data = array(
            'nama' => $nama,
            'password' => $password,
            'username' => $username,
        );

        $where = array(
            'id_petugas' => $id_petugas,
        );

        $this->login_model->update_data($where, $data, 'petugas');
        redirect('Login/lihat_akun_petugas');
    }

    public function searchAnggota()
    {
        $keyword = $this->input->post('search');
        $data['totalAnggota'] = $this->model_simpanan->laporan_anggota_petugas();
        $data['anggota'] = $this->login_model->searchAnggota($keyword);
        $this->load->view('v_anggota', $data);
    }

    public function searchStatusAnggota()
    {
        $keyword = $this->input->post('search');
        $data['anggota'] = $this->login_model->searchstatusAnggota($keyword);
        $this->load->view('v_statusAnggota', $data);
    }

    public function tentang()
    {
        $this->load->view('v_tentang');
    }

    public function tentangPetugas()
    {
        $this->load->view('v_tentangPetugas');
    }

}
