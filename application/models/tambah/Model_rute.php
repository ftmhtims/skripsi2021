<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_rute extends CI_Model
{
	public function ambiltujuan()
	{
		$this->db->select('tujuan.*,  paket.id_paket as id_paket, paket.latitude as latitude,paket.longitude as longitude, 
							paket.kode_paket as kode_paket, paket.nama_penerima as nama_penerima, paket.alamat as alamat');
		$this->db->from('tujuan');
		$this->db->join('paket', 'paket.id_paket=tujuan.id_paket');
		$query = $this->db->get();
		return $query;
	}
	public function titikpeta()
	{
		$this->db->select('tujuan.*,  paket.id_paket as id_paket, paket.latitude as latitude,paket.longitude as longitude, 
							paket.kode_paket as kode_paket, paket.nama_penerima as nama_penerima, paket.alamat as alamat');
		$this->db->from('tujuan');
		$this->db->join('paket', 'paket.id_paket=tujuan.id_paket');
		return $this->db->get()->result();
	}
	public function ambil()
	{
		$this->db->select('tujuan.*,paket.kode_paket as kode_paket, paket.jenis as jenis,paket.tanggal as tanggal')
			->from('tujuan')
			->join('paket', 'paket.id_paket=tujuan.id_paket')
			->where_not_in('nama_penerima', 'Lokasi awal (Kantor J&T)');
		$query = $this->db->get();
		return $query;
	}
	public function ambil1()
	{
		$this->db->select('tujuan.*,paket.kode_paket as kode_paket, paket.nama_penerima as nama, paket.alamat as alamat, paket.jenis as jenis, paket.wilayah as wilayah,
		paket.tanggal as tanggal')
			->from('tujuan')
			->join('paket', 'paket.id_paket=tujuan.id_paket')
			->where_not_in('nama_penerima', 'Lokasi awal (Kantor J&T)');
		$query = $this->db->get();
		return $query;
	}
	public function getAll()
	{
		$this->db->select('*'); //mengambil semua data
		$this->db->from('paket');
		return $this->db->get()->result();
	}
	public function delete($id)
	{
		$this->db->where('id_tujuan', $id);
		$query = $this->db->delete('tujuan');
		return $query;
	}
	public function matriks()
	{
		return $this->db->query("SELECT a.id_paket as paket1, b.id_paket as paket2 FROM tujuan AS a INNER join tujuan AS b on b.id_paket >= a.id_paket*0 ORDER BY a.id_paket ASC");
	}
	public function getdistance($lat1, $lat2, $long1, $long2)
	{
		$url = "https://api.mapbox.com/directions/v5/mapbox/driving/$long1,$lat1;$long2,$lat2.json?access_token=pk.eyJ1Ijoic3VyeW9hdG0iLCJhIjoiY2pjb2NwcmdqMDE0NzJ4b2MwYXNxZjl4aiJ9.GslBgWjg1GJhkemepRGCBQ&steps=true&geometries=geojson";
		$response = file_get_contents($url);
		$response_a = json_decode($response, true);
		$dist = $response_a['routes'][0]['distance'];
		return array('distance' => $dist, 'url' => $url);
	}
	public function hitungjarak()
	{
		$this->db->select('a.id_jarak, b.latitude as lt1, c.latitude as lt2, b.longitude as lg1, c.longitude as lg2')
			->from('distance as a')
			->join('paket as b', 'a.paket1=b.id_paket', 'LEFT')
			->join('paket as c', 'a.paket2=c.id_paket', 'LEFT')
			->where('jarak = 0 AND paket1 <> paket2');
		$query = $this->db->get();
		return $query;
	}
	public function get_tujuan($awal, $pengecualian, $baris = 'jarak')
	{
		$kecuali = "";
		$temp = explode(";", $pengecualian);
		for ($i = 0; $i < count($temp); $i++) {
			$kecuali = $kecuali . ' and paket2 != ' . $temp[$i] . '';
		}
		$query = $this->db->query("SELECT * FROM distance WHERE paket1 = " . $awal . "" . $kecuali . " order by jarak asc limit 1");

		$jarak = $query->row_array();
		return $jarak[$baris];
	}
	public function distinct()
	{
		$akhir = '1';
		return $this->db->query('SELECT DISTINCT (paket1) FROM distance WHERE paket1 != "' . $akhir . '"');
	}
	public function algo()
	{
		$awal = "1";
		$akhir = "1";
		$a = $awal . ";" . $akhir;
		$b = "";
		$x = 0;
		$result = $this->model_rute->distinct();
		$total = $this->model_rute->distinct()->num_rows();
		while ($row = $result->result_array() and $x <= $total - 1) {
			$x += 1;
			$b = $this->model_rute->get_tujuan($awal, $a, 'paket2');

			$data[] = array(
				'b' => $b
			);
			$a = $a . ';' . $b;
			$awal = $b;
		}
		return $data;
	}
	public function get_jarak($awal, $pengecualian, $row = 'jarak')
	{
		$kecuali = "";
		$temp = explode(";", $pengecualian);
		for ($i = 0; $i < count($temp); $i++) {
			$kecuali = $kecuali . ' and paket2 = ' . $temp[$i] . '';
		}
		$query = $this->db->query("SELECT *FROM distance WHERE paket1 = " . $awal . " " . $kecuali . "");
		$jarak = $query->row_array();
		return $jarak[$row];
	}
	public function jarak()
	{
		$awal = "1";
		$akhir = "1";
		$a = $awal . ';' . $akhir;
		$b = "";
		$x = 0;
		$jarak = "";
		$totaljarak = 0;
		$result = $this->model_rute->distinct();
		$total = $this->model_rute->distinct()->num_rows();
		while ($row = $result->result_array() and $x <= $total - 1) {
			$x += 1;
			$b = $this->model_rute->get_tujuan($awal, $a, 'paket2');
			$jarak = $jarak . ';' . $this->model_rute->get_jarak($awal, $a);

			$totaljarak += $this->model_rute->get_jarak($awal, $a);
			$tujuan[] = array(
				'b' => $b
			);
			$a = $a . ';' . $b;
			$awal = $b;
		}
		$jarak = $jarak . ";" . $this->model_rute->get_jarak($b, $akhir);


		$data[] = array(
			'i' => $jarak,
			'j' => $totaljarak
		);
		return $data;
	}
	public function jrk()
	{
		return $this->db->get('distance')->num_rows();
	}
	public function dis()
	{
		$this->db->select('*')
			->from('distance')
			->where('jarak=0 AND paket1 <> paket2');
		return $this->db->get()->num_rows();
	}
	public function mtrks()
	{
		$this->db->select('*')
			->from('tujuan')
			->where_not_in('id_paket', '1');
		return $this->db->get()->num_rows();
	}
}
