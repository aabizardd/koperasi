<?php
class model_pinjaman extends CI_Model
{

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function tampil_pinjaman($where)
    {
        $this->db->select("id_pinjaman, a.nama, jml_pinjaman, status, tgl_pinjaman, tenor, bunga, angsuran, denda");
        $this->db->from('pinjaman p');
        $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
        $this->db->where('a.id_anggota', $where);
        $this->db->where('status', 'Accepted');
        $this->db->or_where('status', 'On Going');
        $this->db->order_by('tgl_pinjaman', 'ASC');
        return $this->db->get()->result();
        // $query = $this->db->query("SELECT id_pinjaman, a.nama, jml_pinjaman, status, tgl_pinjaman, tenor, bunga, angsuran, denda From pinjaman p JOIN anggota a on p.id_anggota=a.id_anggota WHERE status='Cleared' AND p.id_anggota='$where' order by tgl_pinjaman asc");
        // return $query->result();
    }

    public function tampil_riwayatPinjaman($where)
    {
        $this->db->select("id_pinjaman,jml_pinjaman, status, tgl_pinjaman, tenor, bunga, (jml_pinjaman*bunga/100) as pengembalian");
        $this->db->from('histori_pinjaman');
        $this->db->where('id_anggota', $where);
        $this->db->where('status', 'Cleared');
        $this->db->or_where('status', 'Declined');
        $this->db->order_by('tgl_pinjaman', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function tampil_pinjaman_petugas()
    {
        $this->db->select("p.id_anggota,id_pinjaman,a.nama,jml_pinjaman, status, tgl_pinjaman, tenor,plafon, bunga,denda, jenis_jaminan, jaminan_ktp, jaminan_surat, jaminan_stnk, jaminan_pajak, jaminan_foto, taksiran_jaminan");
        $this->db->from('pinjaman p');
        $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
        $this->db->order_by('status', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function laporan_pinjaman($year)
    {
        if ($year == 'all') {
            $this->db->select("p.id_anggota,id_pinjaman,a.nama,count(a.nama) as totalpinjam,sum(jml_pinjaman) as jml_pinjaman, status, tgl_pinjaman, tenor, bunga, sum(angsuran) as angsuran");
            $this->db->from('pinjaman p');
            $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
            $this->db->group_by('a.nama');
            return $this->db->get()->result();
        } else {
            $this->db->select("p.id_anggota,id_pinjaman,a.nama,count(a.nama) as totalpinjam,sum(jml_pinjaman) as jml_pinjaman, status, tgl_pinjaman, tenor, bunga, sum(angsuran) as angsuran");
            $this->db->from('pinjaman p');
            $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
            $this->db->group_by('a.nama');
            // $this->db->where('status', 'Accepted');
            $this->db->where('year(tgl_pinjaman)', $year);
            return $this->db->get()->result();
        }
    }

    public function selectTahun()
    {
        $this->db->select("YEAR(tgl_pinjaman) as tahun");
        $this->db->from('pinjaman');
        $this->db->group_by('YEAR(tgl_pinjaman)');
        return $this->db->get()->result();
    }

    public function laporan_pinjaman2($where)
    {
        $this->db->select("p.id_anggota,id_pinjaman,a.nama,count(a.nama) as totalpinjam,sum(jml_pinjaman) as jml_pinjaman, status, tgl_pinjaman, tenor, bunga");
        $this->db->from('pinjaman p');
        $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
        $this->db->where('status', 'Accepted');
        $this->db->where('p.id_anggota', $where);
        $query = $this->db->get();
        return $query->result();
    }

    public function laporan_pinjaman_petugas()
    {
        $query = $this->db->query("SELECT SUM(angsuran) as total From pinjaman WHERE status='Accepted'");
        //$query = $this->db->get();
        return $query->result();
    }

    public function total($where)
    {
        $query = $this->db->query("SELECT SUM(jml_pinjaman) as total From pinjaman WHERE status='Accepted' AND id_anggota='$where'");
        //$this->db->where('namaLengkap',$nama);
        return $query->result();
    }

    public function totalAngsuran($where)
    {
        $query = $this->db->query("SELECT SUM(angsuran) as total From pinjaman WHERE status='Accepted' AND id_anggota='$where'");
        //            $this->db->select_sum('angsuran');
        //            $this->db->where('status','=','Accepted');
        //            $this->db->where('id_anggota','=','$where');
        //            $this->db->from('pinjaman');
        //            $query = $this->db->get();
        //            //$this->db->where('namaLengkap',$nama);
        return $query->result();
    }

    public function pinjaman()
    {
        $this->db->select('*');
        $this->db->from('pinjaman');
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_pinjaman($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_pinjaman($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_pinjaman($where, $table)
    {
        $this->db->delete($table, $where);
    }

    public function searchAcc($keyword)
    {
        $this->db->select("p.id_anggota,p.id_pinjaman,a.nama, jml_pinjaman, p.status, p.tgl_pinjaman, p.tenor, p.bunga,p.plafon");
        $this->db->from('pinjaman p');
        $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
        $this->db->like('a.nama', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

    public function resi($id_pinjaman)
    {
        $this->db->select("p.id_anggota,id_pinjaman,a.nama,sum(jml_pinjaman) as jml_pinjaman, status, tgl_pinjaman, tenor, bunga");
        $this->db->from('pinjaman p');
        $this->db->join('anggota a', 'p.id_anggota = a.id_anggota');
        $this->db->where('id_pinjaman', $id_pinjaman);
        $query = $this->db->get();
        return $query;
    }

    public function cekPinjaman($where)
    {
        $sql = "SELECT tenor, jml_pinjaman FROM pinjaman WHERE id_anggota = '$where'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getLastTransaction($id_anggota)
    {
        $this->db->select("*");
        $this->db->from('pinjaman ');
        $this->db->where('id_anggota', $id_anggota);
        $this->db->where('status', "On Going");
        $this->db->or_where('status', "Accepted");
        $this->db->order_by('id_pinjaman', "DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }
}