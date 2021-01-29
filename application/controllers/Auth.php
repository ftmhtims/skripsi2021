<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'User', 'trim|required');
        $this->form_validation->set_rules('password', 'Pass', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login User';
            $this->load->view('templates/auth/auth_header', $data);
            $this->load->view('login');
            $this->load->view('templates/auth/auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('kurir');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username belum diaktifkan!</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
            redirect('Auth');
        }
    }
    public function regis()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[user.username]', ['is_unique' => 'Username ini telah digunakan, silahkan masukkan username lain!']);
        $this->form_validation->set_rules('pass1', 'Pass1', 'required|trim|min_length[6]|matches[pass2]', ['matches' => 'Password tidak sama!', 'min_length' => 'Password minimal 6 karakter']);
        $this->form_validation->set_rules('pass2', 'Pass2', 'required|trim|matches[pass1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi User';
            $this->load->view('templates/auth/auth_header', $data);
            $this->load->view('registrasi');
            $this->load->view('templates/auth/auth_footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi berhasil! Silahkan login.</div>');
            redirect('Auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logout Berhasil!</div>');
        redirect('Auth');
    }
}
