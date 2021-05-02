<?php 
    class model_angsuran extends CI_Model{

        public function insert($data,$table){
            $this->db->insert($table,$data);
        }

        public function tampil_angsuran($where){
    		$this->db->select("id_angsuran, ap.id_pinjaman,nominal,tanggal_angsuran,ang.id_anggota, tgl_pinjaman, jml_pinjaman, tenor, ap.angsuran");
            $this->db->from('angsuran a');
            $this->db->join('pinjaman ap','a.id_pinjaman = ap.id_pinjaman');
            $this->db->join('anggota ang','ap.id_anggota = ang.id_anggota');
            $this->db->where('ang.id_anggota',$where);
            $query = $this->db->get();
            return $query->result();
    	}

         public function tampil_angsuranPetugas($where){
            $this->db->select("nama,id_angsuran,ap.id_pinjaman,nominal,tanggal_angsuran,ang.id_anggota");
            $this->db->from('angsuran a');
            $this->db->join('pinjaman ap','a.id_pinjaman = ap.id_pinjaman');
            $this->db->join('anggota ang','ap.id_anggota = ang.id_anggota');
            $this->db->where('ang.id_anggota',$where);
            $query = $this->db->get();
            return $query->result();
        }

        public function riwayat_angsuran(){
            $this->db->select("p.id_anggota,id_angsuran,a.nama,nominal as jml_angsuran,tanggal_angsuran");
            $this->db->from('angsuran p');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->order_by('tanggal_angsuran','desc');
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_angsuran($where){
            $this->db->select("p.id_anggota,id_angsuran,a.nama,count(a.nama) as totalangsuran,sum(nominal) as jml_angsuran,tanggal_angsuran");
            $this->db->from('angsuran p');
            $this->db->join('pinjaman a','p.id_pinjaman = a.id_pinjaman');
            $this->db->join('anggota a','p.id_anggota = a.id_anggota');
            $this->db->where('p.id_anggota',$where);
            $query = $this->db->get();
            return $query->result();
        }

        public function laporan_angsuran2($where){
            $this->db->select("id_angsuran,ap.id_pinjaman,(sum(ap.jml_pinjaman) - sum(a.nominal))  as utang,tanggal_angsuran,ang.id_anggota");
            $this->db->from('angsuran a');
            $this->db->join('pinjaman ap','a.id_pinjaman = ap.id_pinjaman');
            $this->db->join('anggota ang','ap.id_anggota = ang.id_anggota');
            $this->db->where('ang.id_anggota',$where);
            $this->db->where('ap.status','Accepted');
            $query = $this->db->get();
            return $query->result();
        }


        public function laporan_angsuran_petugas(){
            $this->db->select("id_angsuran,sum(nominal) as jml_angsuran");
            $this->db->from('angsuran');
            $query = $this->db->get();
            return $query->result();
        }

        public function total($where){
            $query = $this->db->query("SELECT SUM(nominal) as total From angsuran WHERE id_anggota='$where'");
            //$this->db->where('namaLengkap',$nama);
            return $query->result();
        }
		public function count($where){
			$query = $this->db->query("SELECT count (nominal) as total From angsuran WHERE id_anggota='$where'");
			//$this->db->where('namaLengkap',$nama);
			return $query->result();
		}

    	public function edit_angsuran($where,$table){      
        	return $this->db->get_where($table,$where);
    	}

    	public function update_angsuran($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

    	public function hapus_angsuran($where,$table){
        	$this->db->delete($table,$where);
    	}

    }
?>
