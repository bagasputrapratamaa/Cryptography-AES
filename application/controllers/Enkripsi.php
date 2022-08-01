<?php defined('BASEPATH') or exit('No direct script access allowed');
include "AES.php";


class Enkripsi extends CI_Controller
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

	public function encrypt_file()
	{
		$this->form_validation->set_rules('pwdfile', 'Password', 'trim|required');
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|matches[pwdfile]|required');

		if ($this->form_validation->run() == TRUE) {
			$key                = substr(md5($this->input->post('pwdfile')), 0, 16);
			$deskripsi          = $this->input->post('desc');
			$file_tmpname       = $_FILES['file']['tmp_name'];
			//nama file url
			$file               = $_FILES['file']['name'];
			$new_file_name      = ($file);
			$final_file         = str_replace(' ', '-', $new_file_name);
			//untuk nama file
			$filename           = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
			$new_filename       = ($filename);
			$finalfile          = str_replace(' ', '-', $new_filename);
			$size               = filesize($file_tmpname);
			$size2              = (filesize($file_tmpname)) / 1024;
			$info               = pathinfo($final_file);
			$file_source        = fopen($file_tmpname, 'rb');
			$ext                = $info["extension"];

			//echo '<pre>';
			//print_r($ext);
			//exit;
			if ($ext == "docx" || $ext == "doc" || $ext == "txt" || $ext == "pdf" || $ext == "xls" || $ext == "xlsx" || $ext == "ppt" || $ext == "pptx") {
			} else {
				echo ("<script language='javascript'>
				window.location.href='index';
				window.alert('Maaf, file yang bisa dienkrip hanya word, excel, text, ppt ataupun pdf.');
				</script>");
				exit();
			}

			if ($size2 > 3084) {
				echo ("<script language='javascript'>
				window.location.href='index';
				window.alert('Maaf, file tidak bisa lebih besar dari 3MB.');
				</script>");
				exit();
			}

			// Insert Data to DB
			$this->enkripsi_m->insertEncryptData('admin', $final_file, $finalfile, $size2, $key, $deskripsi);

			// Select Data

			$this->enkripsi_m->selectEncryptData($final_file);

			$url   = $finalfile . ".rda";
			$file_url = "file_encrypt/$url";

			$file_url_upload = './file_encrypt/';

			$check_namafile_terencrypt = $file_url_upload . $url; // Check File Ter Encrypt 

			// Jika Nama.extension file belum pernah diencrypt
			if (file_exists($check_namafile_terencrypt)) {
				echo ("<script language='javascript'>
				window.location.href='index';
				window.alert('Maaf, file ini sudah ter-encrypt.');
				</script>");
				exit();
			}

			// Update Data to DB
			$this->enkripsi_m->updateEncryptData($file_url);

			$file_output  = fopen($file_url, 'wb');

			$mod    = $size % 16;
			if ($mod == 0) {
				$banyak = $size / 16;
			} else {
				$banyak = ($size - $mod) / 16;
				$banyak = $banyak + 1;
			}

			if (is_uploaded_file($file_tmpname)) {
				ini_set('max_execution_time', -1);
				ini_set('memory_limit', -1);
				$aes = new AES($key);

				for ($bawah = 0; $bawah < $banyak; $bawah++) {
					$data    = fread($file_source, 16);
					$cipher  = $aes->encrypt($data);
					fwrite($file_output, $cipher);
				}
				fclose($file_source);
				fclose($file_output);

				echo ("<script language='javascript'>
          window.location.href='index';
          window.alert('Enkripsi Berhasil..');
          </script>");
			} else {
				echo ("<script language='javascript'>
				window.location.href='index';
				window.alert('Encrypt file mengalami masalah..');
				</script>");
				exit();
			}
		} else {
			echo ("<script language='javascript'>
				window.location.href='index';
				window.alert('Tolong dicek kembali!');
				</script>");
			exit();
		}
	}
}
