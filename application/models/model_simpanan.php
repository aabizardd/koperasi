<?php 
    class model_simpanan extends CI_Model{

        public function insert($data,$table){
            $this->db->insert($table,$data);
        }

        public function tampil_simpanan($where){
    		$this->db->select("id_simpanan,nominal, tanggal_simpanan");
    		$this->db->from('simpanan');
            $this->db->where('id_anggota',$where);
            $this->db->where('id_tipeSimpanan', 2);
            $this->db->order_by('tanggal_simpanan','ASC');
    		$query = $this->db->get();
    		return $query->result();
    	}

        public function tampil_simpananPokok($where){
            $this->db->select("id_simpanan,sum(nominal) as nominal, tanggal_simpanan");
            $this->db->from('simpanan');
            $this->db->where('id_anggota',$where);
           // $this->db->where('id_tipeSimpanan', 3);
            $this->db->order_by('tanggal_simpanan','ASC'); 
            $query = $this->db->get();
            return $query->result();
        }

        public function tampil_simpananWajib($where){
            $this->db->select("id_simpanan,nominal, tanggal_simpanan");
            $this->db->from('simpanan');
            $this->db->where('id_anggota',$where);
            $this->db->where('id_tipeSimpanan', 1);
            $this->db->order_by('tanggal_simpanan','ASC');
            $query = $this->db->get();
            return $query->result();
        }

        public function tipe_simpanan(){
            $this->db->select("id_tipeSimpanan, tipe");
            $this->db->from('tipe_simpanan');
            $query = $this->db->get();
            return $query->result();
        }

        public function ambil_simpanan($where){
            $this->db->select("t.tipe, a.id_anggota, id_riwayatSimpanan,nominal, tanggal_ambil, a.nama");
            $this->db->from('riwayat_simpanan r');
            $this->db->join('anggota a', 'r.id_anggota = a.id_anggota');
            $this->db->join('tipe_simpanan t','r.id_tipeSimpanan = t.id_tipeSimpanan');
            $this->db->where('a.id_anggota',$where);
            $this->db->order_by('tanggal_ambil','ASC');
            $query = $this->db->get();
            return $query->result();
        }

        // public function riwayat_simpanan(){
        //     $this->db->select("t.tipe, p.id_anggota,id_simpanan,a.nama,nominal as jml_simpanan,tanggal_simpanan");
        //     $this->db->from('simpanan p');
        //     $this->db->join('anggota a','p.id_anggota = a.id_anggota');
        //     $this->db->join('tipe_simpanan t','p.id_tipeSimpanan = t.id_tipeSimpanan');
        //     $this->db->order_by('tanggal_simpanan','desc');
        //     $query = $this->db->get();
        //     return $query->result();
        // }

        public function ambil_simpananPetugas(){
            $this->db->select("t.tipe, nama, id_riwayatSimpanan, nominal, tanggal_ambil, a.id_anggota");
            $this->db->from('riwayat_simpanan r');
            $this->db->join('anggota a','r.id_anggota = a.id_anggota');
            $this->db->join('tipe_simpanan t','r.id_tipeSimpanan = t.id_tipeSimpanan');
            $this->db->order_by('tanggal_ambil','ASC');
            $query = $this->db->get();
            return $query->result();
        }

        public function riwayat_simpanan(){
            $this->db->select("t.tipe, p.id_anggota,id_simpanan,a.nama,nominal as jml_simpanan,tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->join('tipe_simpanan t','p.id_tipeSimpanan = t.id_tipeSimpanan');
            $this->db->order_by('tanggal_simpanan','desc');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_simpanan($where){
            $this->db->select("p.id_anggota,id_simpanan,a.nama,count(a.nama) as totalsimpan,sum(nominal) as jml_simpanan,tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->where('p.id_anggota',$where);
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_simpanan2(){
            $this->db->select("t.tipe, p.id_anggota,id_simpanan,a.nama,count(a.nama) as totalsimpan,sum(nominal) as jml_simpanan,tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->join('tipe_simpanan t','p.id_tipeSimpanan = t.id_tipeSimpanan');
            $this->db->where('p.id_tipeSimpanan',2);
            $this->db->group_by('a.nama');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_simpananWajib(){
            $this->db->select("t.tipe, p.id_anggota,id_simpanan,a.nama,count(a.nama) as totalsimpan,sum(nominal) as jml_simpanan,tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->join('tipe_simpanan t','p.id_tipeSimpanan = t.id_tipeSimpanan');
            $this->db->where('p.id_tipeSimpanan',1);
            $this->db->group_by('a.nama');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_simpananPokok(){
            $this->db->select("t.tipe, p.id_anggota,id_simpanan,a.nama,sum(nominal) as jml_simpanan,tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->join('tipe_simpanan t','p.id_tipeSimpanan = t.id_tipeSimpanan');
            $this->db->where('p.id_tipeSimpanan',3);
            #$this->db->where()
            $this->db->group_by('p.id_anggota');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_simpanan_petugas(){
            $query = $this->db->query("SELECT ((SELECT SUM(simpanan.nominal) FROM simpanan)-SUM(riwayat_simpanan.nominal)) jml_simpanan FROM riwayat_simpanan JOIN anggota 
                    ON riwayat_simpanan.id_anggota = anggota.id_anggota");
            return $query->result();
        }

        public function total_simpan($where){
            $query = $this->db->query("SELECT ((SELECT SUM(nominal) FROM simpanan WHERE id_anggota = '$where' and id_tipeSimpanan=2)-SUM(riwayat_simpanan.nominal)) jml_simpanan FROM riwayat_simpanan JOIN anggota 
                    ON riwayat_simpanan.id_anggota = anggota.id_anggota
                    WHERE anggota.id_anggota = '$where'");
            //$this->db->where('namaLengkap',$nama);
            return $query->result();
        }


        public function total_simpanWajib($where){
            $query = $this->db->query("SELECT SUM(nominal) as jml_simpanan FROM simpanan WHERE id_anggota = '$where' AND id_tipeSimpanan=1");

            $this->db->where('id_anggota',$where);
            return $query->result();
        }
		public function total_simpanSukarela($where){
			$query = $this->db->query("SELECT SUM(nominal) as jml_simpanansukarela FROM simpanan WHERE id_anggota = '$where' AND id_tipeSimpanan=2");

			$this->db->where('id_anggota',$where);
			return $query->result();
		}

        public function total($where){
            $query = $this->db->query("SELECT SUM(nominal) as total From simpanan WHERE id_anggota='$where'");
            //$this->db->where('namaLengkap',$nama);
            return $query->result();
        }

        public function simpanan(){
            $this->db->select('*');
            $this->db->from('simpanan');
            $query = $this->db->get();
            return $query->result();
        }

    	public function edit_simpanan($where,$table){      
        	return $this->db->get_where($table,$where);
    	}

    	public function update_simpanan($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

    	public function hapus_simpanan($where,$table){
        	$this->db->delete($table,$where);
    	}

        public function tampil_anggota(){
            $this->db->select("a.id_anggota,nama,jenis_kelamin, alamat, nik, no_hp, email, s.statusnya");
            $this->db->from('anggota a');
            $this->db->join('status_anggota s','a.status_anggota = s.status_anggota');
            $this->db->where('a.status_anggota',1);
            $this->db->order_by('nama',"ASC");
            $query = $this->db->get();
            return $query->result();
        }

        public function tampil_statusanggota(){
            $this->db->select("*");
            $this->db->from('anggota a');
            $this->db->join('status_anggota s','a.status_anggota = s.status_anggota');
            $this->db->order_by('statusnya',"DESC");
            $query = $this->db->get();
            return $query->result();
        }

        public function jaminan_anggota($where){
            $this->db->select("id_anggota,nama,ktp,bpkb,stnk");
            $this->db->from('anggota');
            $this->db->where('id_anggota',$where);
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_anggota_petugas(){
            $this->db->select("count(id_anggota) as jumlahAnggota");
            $this->db->from('anggota');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_anggota_petugas2(){
            $this->db->select("count(id_anggota) as jumlahAnggota, jenis_kelamin");
            $this->db->from('anggota');
            $this->db->where('jenis_kelamin','Laki-laki');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_anggota_petugas3(){
            $this->db->select("count(id_anggota) as jumlahAnggota, jenis_kelamin");
            $this->db->from('anggota');
            $this->db->where('jenis_kelamin','Perempuan');
            $query = $this->db->get();
            return $query->result();
        }

        public function bukti($id_simpanan){
            $this->db->select("p.id_anggota,id_simpanan,a.nama,sum(nominal) as simpanan, tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->where('id_simpanan',$id_simpanan);
            $query = $this->db->get();
            return $query;
        }

        public function searchRiwayat_Pengambilan($keyword){
            $this->db->select("nama, id_riwayatSimpanan, nominal, tanggal_ambil, a.id_anggota");
            $this->db->from('riwayat_simpanan r');
            $this->db->join('anggota a','r.id_anggota = a.id_anggota');
            $this->db->like('nama',$keyword);
            $this->db->order_by('tanggal_ambil','ASC');
            $query = $this->db->get();
            return $query->result();
        }

        public function searchRiwayat_simpanan($keyword){
            $this->db->select("p.id_anggota,id_simpanan,a.nama,nominal as jml_simpanan,tanggal_simpanan");
            $this->db->from('simpanan p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->like('nama',$keyword);
            $this->db->order_by('tanggal_simpanan','desc');
            $query = $this->db->get();
            return $query->result();
        }

        public function ambil_akun($id_anggota){
            return $this->db->get_where('anggota',array('id_anggota'=>$id_anggota),1);
        }
    }
?>
