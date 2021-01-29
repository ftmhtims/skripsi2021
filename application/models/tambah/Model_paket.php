<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_paket extends CI_Model
{
	public function create()
	{
		$data = array(
			'kode_paket' => $this->input->post('kode_paket'), 'nama_penerima' => $this->input->post('nama_penerima'),
			'alamat' => $this->input->post('alamat'), 'jenis' => $this->input->post('jenis'),
			'tanggal' => $this->input->post('tanggal'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude'),
			'wilayah' => $this->input->post('wilayah')
		);
		$query = $this->db->insert('paket', $data);
		return $query;
	}
	public function semua()
	{
		return $this->db->get('paket');
	}
	public function getAll($limit, $start, $keyword)
	{
		if ($keyword) {
			$this->db->like('wilayah', $keyword);
			$this->db->or_like('jenis', $keyword);
			$this->db->or_like('tanggal', $keyword);
		}
		$this->db->select('paket.*, tujuan.id_paket as tujuan')
			->from('paket')
			->join('tujuan', 'paket.id_paket=tujuan.id_paket', 'LEFT')
			->where_not_in('nama_penerima', 'Lokasi awal (Kantor J&T)')
			->limit($limit, $start);
		return $this->db->get();
	}
	public function getAll1($limit, $start, $kunci)
	{
		if ($kunci) {
			$this->db->like('kode_paket', $kunci);
			$this->db->or_like('nama_penerima', $kunci);
			$this->db->or_like('alamat', $kunci);
			$this->db->or_like('wilayah', $kunci);
		}
		$this->db->select('*')
			->from('paket')
			->where_not_in('id_paket', '1')
			->limit($limit, $start);
		return $this->db->get();
	}
	public function totalrows()
	{
		$this->db->select('*') //mengambil semua data
			->from('paket')
			->where_not_in('id_paket', '1');
		$query = $this->db->get()->num_rows();
		return $query;
	}
	public function daftarpaket()
	{
		$this->db->select('*')
			->from('paket')
			->where_not_in('id_paket', '1');
		return $this->db->get()->result();
	}
	public function read($id)
	{
		$this->db->select('*'); //mengambil semua data
		$this->db->from('paket');
		$this->db->where('id_paket', $id);
		$query = $this->db->get();
		return $query;
	}
	public function delete($id)
	{
		$this->db->where('id_paket', $id);
		$query = $this->db->delete('paket');
		return $query;
	}
}
