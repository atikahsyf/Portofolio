<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Editpw extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
    }

    public function index()
    {
        $this->load->view('vw_editpw');
    }

    public function updatePassword()
    {
        $this->form_validation->set_rules('current', 'current', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('new', 'new', 'trim|required|min_length[1]|max_length[255]');

        $id = $this->session->userdata('id');
        $current = $this->input->post('current');
        $new = $this->input->post('new');
        if ($this->form_validation->run()) {
            if (password_verify($current, $this->session->userdata('password'))) {
                $hash = password_hash($new, PASSWORD_DEFAULT);
                $data = array(
                    'password' => $hash
                );
                $result = $this->auth->update($data, $id);
                if ($result > 0) {
                    redirect('editprofile');
                } else {
                    $this->session->set_flashdata('error_editPw', validation_errors());
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('error_editPw', 'Current password is incorrect');
                redirect('editpw');
            }
        } else {
            $this->session->set_flashdata('error_editPw', validation_errors());
            redirect('profile');
        }
    }
}
