<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_wilayah extends CI_Model
{
	public function getAll()
	{
		$query = $this->db->get('wilayah'); //mengambil semua data jalan
		return $query;
	}
	public function wil1()
	{
		$this->db->select('*')
			->from('paket')
			->where('wilayah', 'wilayah 1');
		$query = $this->db->get();
		return $query;
	}
	public function wil2()
	{
		$this->db->select('*')
			->from('paket')
			->where('wilayah', 'wilayah 2');
		$query = $this->db->get();
		return $query;
	}
	public function wil3()
	{
		$this->db->select('*')
			->from('paket')
			->where('wilayah', 'wilayah 3');
		$query = $this->db->get();
		return $query;
	}
	public function wil4()
	{
		$this->db->select('*')
			->from('paket')
			->where('wilayah', 'wilayah 4');
		$query = $this->db->get();
		return $query;
	}
}
