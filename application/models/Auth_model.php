<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function login($username, $password)
    {
        $user = $this->db->get_where('users', ['username' => $username, 'is_active' => 1], 1)->row_array();
        if ($user && password_verify($password, $user['password'])) {
            return [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'username' => $user['username'],
                'role' => $user['role'],
            ];
        }
        return null;
    }
}
