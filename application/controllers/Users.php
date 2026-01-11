<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct(); // Burası __construct olmalı
        $this->load->model('User_Model');
    }

    public function index() {
        $this->load->view('User_v');
    }

    public function save() {
        $data = array(
            'ad'    => $this->input->post('ad'),
            'soyad' => $this->input->post('soyad'),
            'email' => $this->input->post('email')
        );

        $insert = $this->User_Model->add($data);
        echo "Kaydetme fonksiyonu çalıştı";
    }
}