<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('enkripsi_m');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->template->load('template', 'enkripsi/enkripsi_data');
    }

    public function UploadFile()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|matches[password]|required');


        if ($this->form_validation->run() == TRUE) {

            $fileTmpName   = $_FILES['file']['tmp_name'];
            $file          = $_FILES['file']['name'];
            $newFileName   = ($file);
            $finalFile1    = str_replace(' ', '-', $newFileName);

            $fileName      = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $newFileName   = ($fileName);
            $finalFile     = str_replace(' ', '-', $newFileName);
            $finalFileRda  = str_replace('', '-', $newFileName . ".rda");

            //echo '<pre>'; print_r($finalFileRda);exit;

            $size          = filesize($fileTmpName);
            $size2         = (filesize($fileTmpName)) / 1024;
            //echo '<pre>'; print_r($finalFile);exit;
            $config['upload_path']          = './file_encrypt/';
            $config['allowed_types']        = 'gif|jpg|png|pdf|docx|doc|word|xlsx|rda';
            $config['max_size']             = 99999;
            $config['max_width']            = 99999;
            $config['max_height']           = 99999;
            $config['file_name']            = $finalFileRda;
            //echo '<pre>'; print_r($config['file_name']); exit;


            $check_namafile_terencrypt = $config['upload_path'] . $config['file_name']; // Check File Ter Encrypt 

            // Jika Nama.extension file belum pernah diencrypt
            if (!file_exists($check_namafile_terencrypt)) {

                $this->load->library('upload', $config);

                // echo '<pre>';print_r(! $this->upload->do_upload('file'));exit;
                if (!$this->upload->do_upload('file', FALSE)) {
                    $error = array('error' => $this->upload->display_errors());
                    echo ("<script language='javascript'>
					window.location.href='index';
					window.alert('Encrypt file mengalami masalah. Format wajib gif/jpg/png/word/xlsx ..');
					</script>");
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    // $user       = $_SESSION['username'];
                    $date       = $this->input->post('datenow');
                    $file       = $this->input->post('file');
                    $pass       = md5($this->input->post('password'));
                    $desc       = $this->input->post('desc');

                    $this->enkripsi_m->insertEncryptData('admin', $finalFile1, $finalFile, $size2, $pass, $desc);
                    echo ("<script language='javascript'>
					window.location.href='index';
					window.alert('Enkripsi Berhasil..');
					</script>");
                }
            } else {
                echo ("<script language='javascript'>
					window.location.href='index';
					window.alert('Encrypt file mengalami masalah! File ini sudah pernah di Encrypt!');
					</script>");
            }
        } else {
            echo ("<script language='javascript'>
					window.location.href='index';
					window.alert('Tolong diperiksa kembali!');
					</script>");
        }
    }
}
