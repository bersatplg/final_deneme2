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
        
        $this->load->library("form_validation");

        // Kurallar
        $this->form_validation->set_rules("ad", "Ad", "required|trim");
        $this->form_validation->set_rules("soyad", "Soyad", "required|trim");
        $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email|is_unique[Users_1.email]");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");
        $this->form_validation->set_rules("repassword", "Şifre Tekrarı", "required|trim|matches[password]");

        // Validasyonu Çalıştır
        $validation = $this->form_validation->run();

        if ($validation) {
            // --- BAŞARILI İSE BURASI ÇALIŞIR ---
            
            // 1. Verileri Hazırla
            $data = array(
                'ad'         => $this->input->post('ad'),
                'soyad'      => $this->input->post('soyad'),
                'email'      => $this->input->post('email'),
                'password'   => $this->input->post('password'), // Şifreleme kullanmıyorsan düz gider
                'repassword' => $this->input->post('repassword')
            );

            // 2. Veritabanına Ekle
            $insert = $this->User_Model->add($data);

            if ($insert) {
                echo "Kayıt Başarıyla Tamamlandı!";
                // İstersen burada tekrar view yükleyebilirsin:
                // $this->load->view('User_v'); 
            } else {
                echo "Veritabanına kayıt sırasında bir sorun oluştu.";
            }

        } else {
            // --- BAŞARISIZ İSE BURASI ÇALIŞIR ---
            
            // Hataları göstermek için sayfayı tekrar yükle
            // View dosyasında <?php echo validation_errors();
            // kodu varsa hatalar görünür.
            $this->load->view('User_v');
        } 
}
}
?> 

