<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('tambah/model_paket')); /* load model yang dibutuhkan */
        $this->load->model(array('tambah/model_wilayah'));
        $this->load->model(array('tambah/model_rute'));
    }
    function index()
    {
        $matriks = $this->model_rute->jrk();
        if ($matriks == 0) {
            $this->session->set_flashdata('konfir', "Kurir telah melihat rute yang terakhir kali ditambahkan!");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            $data = array(
                'judul' => 'Selamat Datang',
                'content' => 'admin/tambah/home',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'itemdaftar' => $this->model_paket->daftarpaket()
            );
            $this->load->view('templates/Admin/template', $data);
        } else {
            $data = array(
                'judul' => 'Selamat Datang',
                'content' => 'admin/tambah/home',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'itemdaftar' => $this->model_paket->daftarpaket()
            );
            $this->load->view('templates/Admin/template', $data);
        }
    }
    function paket()
    {
        $data = array(
            'judul' => 'Form Paket',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'content' => 'admin/tambah/formpaket',
            'itemwilayah' => $this->model_wilayah->getAll()
        );
        $this->load->view('templates/Admin/template', $data);
    }
    function daftar()
    {
        if ($this->input->post('submit')) {
            $data['kunci'] = $this->input->post('kunci');
            $this->session->set_userdata('kunci', $data['kunci']);
        } else {
            $data['kunci'] = $this->session->userdata('kunci');
        }
        $this->db->like('nama_penerima',  $data['kunci'])
            ->or_like('kode_paket',  $data['kunci'])
            ->or_like('alamat',  $data['kunci'])
            ->or_like('wilayah',  $data['kunci'])
            ->from('paket')
            ->where_not_in('id_paket', '65');
        $config['base_url'] = 'http://localhost/skripsi/index.php?/admin/daftar';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 8;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = array(
            'judul' => 'Daftar Paket',
            'content' => 'admin/tambah/tabelpaket',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'start' => $this->uri->segment(3),
            'total_rows' => $config['total_rows'],
            'itempaket' => $this->model_paket->getAll1($config['per_page'], $data['start'], $data['kunci']),
            'itemdaftar' => $this->model_paket->daftarpaket()
        );
        $this->load->view('templates/Admin/template', $data);
    }
    function tambah()
    {

        $kode_paket = $this->input->post('kode_paket');
        $nama_penerima = $this->input->post('nama_penerima');
        $alamat = $this->input->post('alamat');
        $jenis = $this->input->post('jenis');
        $tanggal = $this->input->post('tanggal');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $wilayah = $this->input->post('wilayah');

        $data = array(
            'kode_paket' => $kode_paket,
            'nama_penerima' => $nama_penerima,
            'alamat' => $alamat,
            'jenis' => $jenis,
            'tanggal' => $tanggal,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'wilayah' => $wilayah,
        );
        $this->model_paket->create($data, 'paket');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data paket berhasil ditambahkan!</div>');
        redirect('admin/paket');
    }
    function edit($id)
    {
        $data['paket'] = $this->model_paket->read($id)->row();
        $data = array(
            'judul' => 'Form Edit Paket',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'content' => 'admin/edit/paket',
            'itempaket' => $this->model_paket->read($id),
            'itemwilayah' => $this->model_wilayah->getAll()
        );
        $this->load->view('templates/Admin/template', $data);
    }
    function update()
    {
        $kode_paket = $this->input->post('kode_paket');
        $nama_penerima = $this->input->post('nama_penerima');
        $alamat = $this->input->post('alamat');
        $jenis = $this->input->post('jenis');
        $tanggal = $this->input->post('tanggal');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $wilayah = $this->input->post('wilayah');

        $data = array(
            'kode_paket' => $kode_paket,
            'nama_penerima' => $nama_penerima,
            'alamat' => $alamat,
            'jenis' => $jenis,
            'tanggal' => $tanggal,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'wilayah' => $wilayah,
        );
        $this->db->where('kode_paket', $this->input->post('kode_paket'));
        $this->db->update('paket', $data);
        $this->session->set_flashdata('message', "Data paket berhasil diupdate!");
        $this->session->set_flashdata('msg_class', 'alert-success');
        redirect('admin/daftar');
    }
    function delete($id)
    {
        $this->model_paket->delete($id);
        $this->session->set_flashdata('hapus', "Data paket berhasil dihapus!");
        $this->session->set_flashdata('msg_class', 'alert-danger');
        redirect('admin/daftar');
    }
    function wilayah()
    {
        $data = array(
            'judul' => 'Form Wilayah',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'content' => 'admin/tambah/formwilayah',
            'itemwilayah' => $this->model_wilayah->getAll(),
            'satu' => $this->model_wilayah->wil1(),
            'dua' => $this->model_wilayah->wil2(),
            'tiga' => $this->model_wilayah->wil3(),
            'empat' => $this->model_wilayah->wil4(),
            'itemdaftar' => $this->model_paket->daftarpaket()
        );
        $this->load->view('templates/Admin/template', $data);
    }
    function rute()
    {
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $this->db->like('wilayah',  $data['keyword'])
            ->or_like('tanggal',  $data['keyword'])
            ->or_like('jenis', $data['keyword'])
            ->from('paket');
        $config['base_url'] = 'http://localhost/skripsi/index.php?/admin/rute';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = array(
            'judul' => 'Pencarian Rute',
            'content'   => 'admin/tambah/formrute',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'total_rows' => $config['total_rows'],
            'itempaket' => $this->model_paket->getAll($config['per_page'], $data['start'], $data['keyword']),
            'itemtujuan'  => $this->model_rute->ambil(),
            'marker' => $this->model_rute->titikpeta()
        );
        $this->load->view('templates/Admin/template', $data);
    }
    function tambahin()
    {
        $id_paket = $this->input->post('id_paket');
        for ($i = 0; $i < sizeof($id_paket); $i++) {

            $data = array(
                'id_paket' => $id_paket[$i],
            );
            $this->db->insert('tujuan', $data);
        }
        $this->session->set_flashdata('msg', "tujuan ditambahkan!");
        $this->session->set_flashdata('msg_class', 'alert-success');
        return redirect('admin/rute');
    }
    function hapuscek()
    {
        foreach ($_POST['id_tujuan'] as $id) {
            $this->model_rute->delete($id);
        }
        $this->db->empty_table('distance');
        $this->session->set_flashdata('hapus', "paket telah dihapus");
        $this->session->set_flashdata('msg_class', 'alert-success');
        return redirect('admin/rute');
    }
    function cekhapus()
    {
        foreach ($_POST['id_paket'] as $id) {
            $this->model_paket->delete($id);
        }
        $this->session->set_flashdata('hps', "tujuan telah dihapus");
        $this->session->set_flashdata('msg_class', 'alert-success');
        return redirect('admin/daftar');
    }
    function hasil()
    {
        $matriks = $this->model_rute->jrk();
        if ($matriks == 0) {
            $this->session->set_flashdata('gagal', "Buat Matriks Terlebih Dahulu!");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            return redirect('admin/rute');
        } else {
            $result = $this->model_rute->hitungjarak();
            foreach ($result->result_array() as $key) {
                $dist = $this->model_rute->getdistance(
                    $key['lt1'],
                    $key['lt2'],
                    $key['lg1'],
                    $key['lg2']
                );

                $this->db->query("UPDATE distance SET distance.jarak = " . $dist['distance'] . "
            WHERE id_jarak = " . $key["id_jarak"] . "");
            }
            $data = array(
                'judul' => 'Hasil Pencarian Rute',
                'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
                'content'   => 'admin/tambah/algoritma',
                'algo' => $this->model_rute->algo(),
                'ritma' => $this->model_rute->jarak(),
                'titiktujuan' => $this->model_rute->ambiltujuan(),
                'marker' => $this->model_rute->titikpeta()
            );
            $this->load->view('templates/Admin/template', $data);
        }
    }
    function pecahjarak()
    {
        $matriks = $this->model_rute->mtrks();
        $distance = $this->model_rute->jrk();
        if ($matriks == 0) {
            $this->session->set_flashdata('ggl', "Pilih Tujuan Terlebih Dahulu!");
            $this->session->set_flashdata('msg_class', 'alert-danger');
            return redirect('admin/rute');
        } else if ($distance != 0) {
            $this->session->set_flashdata('matriks', "Tabel matriks telah dibuat");
            $this->session->set_flashdata('msg_class', 'alert-success');
            return redirect('admin/rute');
        } else {
            $result = $this->model_rute->matriks();
            $data = array();
            foreach ($result->result_array() as $key) {
                array_push($data, array(
                    'paket1' => $key['paket1'],
                    'paket2' => $key['paket2'],
                    'jarak' => 0
                ));
            }
            $this->db->insert_batch('distance', $data);
            $this->session->set_flashdata('jrk', "Berhasil");
            $this->session->set_flashdata('msg_class', 'alert-success');
            return redirect('admin/rute');
        }
    }
}
