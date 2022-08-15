<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Editprofile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
        $this->auth->cek_login();
    }

    public function index()
    {
        $this->load->view('vw_editprofile');
    }

    public function updating()
    {
        $this->form_validation->set_rules('name', 'name', 'required|min_length[1]|max_length[250]');
        $this->form_validation->set_rules('username', 'username', 'required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('email', 'email', 'required|min_length[1]|max_length[100]');
        $id = $this->session->userdata('id');
        $data = array(
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        );
        if ($this->form_validation->run() == true) {
            if ($this->auth->check_uname($data['username'])) {
                $result = $this->auth->update($data, $id);
                if ($result > 0) {
                    $this->session->unset_userdata('name');
                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('email');
                    $this->session->set_userdata($data);
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('error_editProfile', validation_errors());
                    redirect('editprofile');
                }
            } else {
                $_data = array(
                    'username' => $this->session->userdata('username'),
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email')
                );
                $result = $this->auth->update($_data, $id);
                if ($result > 0) {
                    $this->session->unset_userdata('name');
                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('email');
                    $this->session->set_userdata($_data);
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('error_editProfile', validation_errors());
                    redirect('editprofile');
                }
                redirect('profile');
            }
        } else {
            $this->session->set_flashdata('error_editProfile', validation_errors());
            redirect('editprofile');
        }
    }


    public function updatePhoto()
    {
        $id = $this->session->userdata('id');
        $config['upload_path']          = 'assets/uploads/';
        $config['allowed_types']        = 'png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['overwrite']            = true;
        $config['file_name']            = $this->session->userdata('username');

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('fileToUpload')) {
            $this->session->set_flashdata('error_editProfile', $this->upload->display_errors());
            redirect('editprofile');
        } else {
            $data = array(
                'profpic' => $this->session->userdata('username')
            );
            $result = $this->auth->update($data, $id);
            if ($result > 0) {
                $this->session->unset_userdata('profpic');
                $this->session->set_userdata($data);
                redirect('editprofile');
            } else {
                $this->session->set_flashdata('error_editProfile', validation_errors());
                redirect('editprofile');
            }
        }
    }
}
