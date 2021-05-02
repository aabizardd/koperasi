<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model 
{
	// Mengambil semua data di database
	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	// Mengambil data akun sesuai username dan password
	public function ambil_akun($username, $password){
		$query = $this->db->get_where('anggota',
			array(
				'username' => $username,
				'password' => $password),
				1);
		return $query->result();
	}

	public function ambil_akun_petugas($username, $password){
		$query = $this->db->get_where('petugas',
			array(
				'username' => $username,
				'password' => $password),
				1);
		return $query->result();
	}

	public function view_where($table,$where){
  		return $this->db->get_where($table,$where);
 	}

 	public function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	// update akun pengurus
	public function update()
	{

		$this->db->update($this->_table, $this, array('id_anggota' => $id_anggota));
	}

	// hapus akun pengurus
	public function delete($nim)
	{
		return $this->db->delete($this->_table, array('id_anggota' => $id_anggota));
	}

	public function ambil_akun2($id_anggota){
        return $this->db->get_where('anggota',array('id_anggota'=>$id_anggota),1);
    }

    public function ambil_akun3($id_petugas){
        return $this->db->get_where('petugas',array('id_petugas'=>$id_petugas),1);
    }

    public function edit_data($id_anggota){      
        return $this->db->get_where('anggota',array('id_anggota'=>$id_anggota),1);
    }
    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function edit_data_petugas($id_petugas){      
        return $this->db->get_where('petugas',array('id_petugas'=>$id_petugas),1);
    }

    public function searchAnggota($search){
        $this->db->like('nama',$search);
        $query = $this->db->get('anggota');
        return $query->result();
    }

    public function searchstatusAnggota($search){
        $this->db->select("a.id_anggota,nama, s.statusnya");
        $this->db->from('anggota a');
        $this->db->join('status_anggota s','a.status_anggota = s.status_anggota');
        $this->db->like('nama',$search);
        $this->db->order_by('nama',"ASC");
        $query = $this->db->get();
        return $query->result();    }
}
