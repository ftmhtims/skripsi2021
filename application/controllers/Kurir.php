<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kurir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('tambah/model_paket'));
        $this->load->model(array('tambah/model_rute'));
    }
    function index()
    {
        $data = array(
            'judul' => 'Selamat Datang',
            'content' => 'kurir/home',
            'itemdaftar' => $this->model_paket->daftarpaket(),
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view('templates/Kurir/template', $data);
    }
    function daftar()
    {
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $this->db->like('kode_paket',  $data['keyword'])
            ->or_like('tanggal',  $data['keyword'])
            ->or_like('jenis', $data['keyword'])
            ->or_like('wilayah', $data['keyword'])
            ->from('paket');
        $config['base_url'] = 'http://localhost/skripsi/index.php?/kurir/daftar';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = array(
            'judul' => 'Daftar Paket',
            'content' => 'kurir/peta',
            'total_rows' => $config['total_rows'],
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'start' => $this->uri->segment(3),
            'itempaket' => $this->model_paket->getAll($config['per_page'], $data['start'], $data['keyword']),
            'itemdaftar' => $this->model_paket->daftarpaket()
        );
        $this->load->view('templates/Kurir/template', $data);
    }
    function tabel()
    {
        $data = array(
            'judul' => 'Pencarian Rute',
            'content'   => 'kurir/formpencarian',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'itemtujuan'  => $this->model_rute->ambil1(),
            'itemrute' => $this->model_rute->titikpeta()
        );
        $this->load->view('templates/Kurir/template', $data);
    }
    function hasil()
    {
        $matriks = $this->model_rute->dis();
        if ($matriks) {
            $this->session->set_flashdata('gagal', "Rute tidak ditemukan!");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            return redirect('kurir/tabel');
        } else {
            $data = array(
                'judul' => 'Hasil Rute',
                'content'   => 'kurir/hasilrute',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'algo' => $this->model_rute->algo(),
                'ritma' => $this->model_rute->jarak(),
                'titiktujuan' => $this->model_rute->ambiltujuan(),
                'marker' => $this->model_rute->titikpeta()
            );
            $this->load->view('templates/Kurir/template', $data);
        }
    }
    function konfirmasi()
    {
        //$this->db->query("delete from tujuan where id_paket NOT IN('1')");
        $this->db->empty_table('distance');
        $this->session->set_flashdata('konfirmasi', "Konfirmasi berhasil!");
        $this->session->set_flashdata('msg_class', 'alert-danger');
        return redirect('kurir/tabel');
    }
}
