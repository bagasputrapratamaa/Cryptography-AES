<?php defined('BASEPATH') or exit('No direct script access allowed');
include "AES.php";

class Deskripsi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('deskripsi_m');
        //$this->load->helper('encrypt_helper');
    }

    public function index()
    {
        $data['row'] = $this->deskripsi_m->get();
        $this->template->load('template', 'deskripsi/deskripsi_data', $data);
    }

    public function show($id)
    {
        $data['row'] = $this->deskripsi_m->get($id);

        $this->template->load('template', 'deskripsi/deskripsi_file', $data);
    }

    public function decrypt_file()
    {

        $this->load->library('encryption');
        $idfile             = $this->input->post('fileid');
        $pwdfile            = substr(md5($this->input->post('pwdfile')), 0, 16);

        $file_data_password = $this->deskripsi_m->getDataFileByPassword($idfile, $pwdfile);
        // echo $this->db->last_query();exit;    
        if (!empty($file_data_password[0])) {

            $data       = $this->deskripsi_m->get2($idfile);
            $key        = substr(md5($this->input->post('pwdfile')), 0, 16);
            $file_path  = $data[0]->file_url;
            $file_name  = $data[0]->file_name_source;
            if (file_exists($file_path)) {

                $this->deskripsi_m->updateStatusFile($idfile);

                $fopen1     = fopen($file_path, "rb");
                $cache      = "file_decrypt/$file_name";
                $fopen2     = fopen($cache, "wb");

                $file_size  = filesize($file_path);
                $mod        = $file_size % 16;
                $aes        = new AES($key);

                if ($mod == 0) {
                    $banyak = $file_size / 16;
                } else {
                    $banyak = ($file_size - $mod) / 16;
                    $banyak = $banyak + 1;
                }
                for ($bawah = 0; $bawah < $banyak; $bawah++) {

                    $filedata    = fread($fopen1, 16);
                    $plain       = $aes->decrypt($filedata);
                    fwrite($fopen2, $plain);
                }

                //write_file($fopen2, $plain);
                $_SESSION["download"] = $cache;
                $redirect_url = site_url('daftar');
                echo ("<script language='javascript'>
                   window.alert('Berhasil mendekripsi file.');
                   window.location.href = '$redirect_url';
                   </script>
                   ");
            } else {
                $redirect_url = site_url('deskripsi/show/' . $idfile);
                echo ("<script language='javascript'>
                window.alert('Maaf, File tidak ditemukan.');
                window.location.href = '$redirect_url';
                </script>");
            }
        } else {
            $redirect_url = site_url('deskripsi/show/' . $idfile);
            echo ("<script language='javascript'>
            window.alert('Maaf, Password tidak sesuai.');
            window.location.href = '$redirect_url';
            </script>");
        }
    }
}
