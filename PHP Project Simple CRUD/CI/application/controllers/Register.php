<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
    }

    public function index()
    {
        $this->load->view('vw_register');
    }

    public function proses()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[1]|max_length[250]');
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[100]');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            if ($this->auth->check_uname($username)) {
                $name = $this->input->post('name');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $this->auth->register($name, $username, $password, $email);
                redirect('login');
            } else {
                $this->session->set_flashdata('failed_register', 'Username has been registered');
                redirect('register');
            }
        } else {
            $this->session->set_flashdata('failed_register', validation_errors());
            redirect('register');
        }
    }
}
