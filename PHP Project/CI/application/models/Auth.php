<?php
class Auth extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function register($name, $username, $password, $email)
    {
        $data_user = array(
            'name' => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email
        );
        $this->db->insert('accounts', $data_user);
    }

    function login_user($username, $password)
    {
        $query = $this->db->get_where('accounts', array('username' => $username));
        if ($query->num_rows() > 0) {
            $data_user = $query->row();
            if (password_verify($password, $data_user->password)) {
                $this->session->set_userdata('id', $data_user->id);
                $this->session->set_userdata('name', $data_user->name);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('password', $data_user->password);
                $this->session->set_userdata('email', $data_user->email);
                $this->session->set_userdata('profpic', $data_user->profpic);
                $this->session->set_userdata('is_login', TRUE);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function check_uname($username)
    {
        $query = $this->db->get_where('accounts', array('username' => $username));
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function cek_login()
    {
        if (empty($this->session->userdata('is_login'))) {
            redirect('login');
        }
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('accounts', $data);
        return $this->db->affected_rows();
    }


    public function hashing_pass($current, $new, $id)
    {
        if (password_verify($current, $this->session->userdata('password'))) {
            $hashed = password_hash($new, PASSWORD_DEFAULT);
            $data = array(
                'password' => $hashed
            );
            $this->db->where('id', $id);
            $this->db->update('accounts', $data);
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }
}
